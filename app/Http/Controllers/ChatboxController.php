<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Promotion;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatboxController extends Controller
{
    public function message(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:1|max:1000',
        ]);

        $dbContext = $this->buildDatabaseContext($validated['message']);

        if ($dbContext !== null) {
            $payload = is_array($dbContext) ? $dbContext : ['reply' => $dbContext];
            if (! isset($payload['cards'])) {
                $payload['cards'] = [];
            }
            return response()->json($payload, 200);
        }

        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            return response()->json([
                'reply' => 'Hiện hệ thống hỗ trợ chưa được cấu hình API Gemini. Vui lòng liên hệ bộ phận hỗ trợ trực tiếp.',
            ], 200);
        }

        $prompt = "Bạn là nhân viên tư vấn bán hàng cho cửa hàng thời trang N.clothes. " .
            "Trả lời bằng tiếng Việt, tự nhiên, ngắn gọn và như một người bán hàng chuyên nghiệp. " .
            "Chỉ sử dụng thông tin có trong dữ liệu cửa hàng. Nếu không có thông tin, hãy trả lời: 'Xin lỗi, hiện tại tôi chưa tìm thấy thông tin này trong hệ thống.' " .
            "Nếu câu hỏi ngoài phạm vi cửa hàng, hãy lịch sự nhắc rằng bạn chỉ hỗ trợ các vấn đề liên quan đến N.clothes. " .
            "Không nói về AI, database hay prompt.\n\n" .
            "Khách hàng hỏi: {$validated['message']}";

        try {
            $response = Http::timeout(20)->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $apiKey,
                [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $prompt],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 250,
                    ],
                ]
            );

            if (! $response->successful()) {
                Log::warning('Gemini chatbox request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'reply' => 'Xin lỗi, hệ thống đang gặp sự cố. Bạn có thể thử lại sau hoặc liên hệ qua hotline hỗ trợ.',
                ], 200);
            }

            $reply = data_get($response->json(), 'candidates.0.content.parts.0.text', 'Xin lỗi, tôi chưa thể trả lời ngay lúc này.');

            return response()->json([
                'reply' => trim($reply),
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gemini chatbox exception', ['message' => $e->getMessage()]);

            return response()->json([
                'reply' => 'Xin lỗi, hệ thống đang gặp sự cố. Bạn có thể thử lại sau.',
            ], 200);
        }
    }

    private function buildDatabaseContext(string $message): array|string|null
    {
        $message = mb_strtolower($message, 'UTF-8');

        if (preg_match('/(xin chào|chào|hello|hi|cảm ơn|thanks|tạm biệt|bye|khỏe không|đang làm gì)/u', $message)) {
            return null;
        }

        if (preg_match('/(đơn hàng|order|status|trạng thái)/u', $message)) {
            $order = Order::query()->latest()->first();
            if ($order) {
                return 'Đơn hàng gần đây nhất có mã #' . $order->id . ' với trạng thái: ' . $order->status . ' và tổng tiền ' . number_format($order->total_amount, 0, ',', '.') . ' VND.';
            }

            return 'Xin lỗi, hiện tại tôi chưa tìm thấy thông tin này trong hệ thống.';
        }

        if (preg_match('/(danh mục|category|loại áo|loại sản phẩm)/u', $message)) {
            $categories = Category::query()->take(5)->get();
            if ($categories->isNotEmpty()) {
                $list = $categories->pluck('name')->implode(', ');
                return 'Hiện cửa hàng có các nhóm sản phẩm như: ' . $list . '.';
            }

            return 'Xin lỗi, hiện tại tôi chưa tìm thấy thông tin này trong hệ thống.';
        }

        if (preg_match('/(tin tức|bài viết|news|mới nhất)/u', $message)) {
            $news = News::query()->latest()->take(3)->get();
            if ($news->isNotEmpty()) {
                $titles = $news->pluck('title')->implode(', ');
                return 'Một số bài viết mới nhất hiện có: ' . $titles . '.';
            }

            return 'Xin lỗi, hiện tại tôi chưa tìm thấy thông tin này trong hệ thống.';
        }

        $productKeywords = $this->extractProductKeywords($message);
        $normalizedMessage = $this->normalizeText($message);
        $productTokens = array_values(array_unique(array_filter(array_map(function ($term) {
            $term = $this->normalizeText($term);
            return mb_strlen($term, 'UTF-8') >= 2 ? $term : null;
        }, $productKeywords), function ($term) {
            return $term !== null;
        })));
        $hasProductIntent = preg_match('/(bạn có|có những|có sản phẩm|gợi ý|đề xuất|mẫu nào|áo nào|quần nào|hoodie|shirt|áo|quần|sản phẩm|mẫu|giá|bao nhiêu|price|cost|mấy tiền|under|dưới)/u', $normalizedMessage) || ! empty($productTokens);

        if ($hasProductIntent) {
            $products = Product::query()->with('category')->where('status', 'active')->take(10)->get();

            if ($products->isNotEmpty()) {
                $matchedProducts = $products->filter(function ($product) use ($normalizedMessage, $productTokens) {
                    $candidateText = $this->normalizeText(implode(' ', array_filter([
                        $product->name,
                        $product->description,
                        optional($product->category)->name,
                    ])));

                    if ($candidateText === '') {
                        return false;
                    }

                    if ($normalizedMessage !== '' && str_contains($candidateText, $normalizedMessage)) {
                        return true;
                    }

                    foreach ($productTokens as $token) {
                        if ($token !== '' && str_contains($candidateText, $token)) {
                            return true;
                        }
                    }

                    return false;
                });

                $displayProducts = $matchedProducts->isNotEmpty() ? $matchedProducts : $products;

                if (preg_match('/(giá|bao nhiêu|price|cost|mấy tiền|under|dưới)/u', $normalizedMessage)) {
                    $product = $displayProducts->first();

                    return "Mình thấy sản phẩm phù hợp là {$product->name}. Giá hiện tại là " . number_format($product->price, 0, ',', '.') . " VND. Nếu bạn muốn, mình có thể gợi ý thêm vài mẫu tương tự.";
                }

                $lines = $displayProducts->take(3)->map(function ($product) {
                    return '- ' . $product->name . ' — ' . number_format($product->price, 0, ',', '.') . ' VND';
                })->implode("\n");

                return "Mình có một số mẫu phù hợp cho bạn:\n" . $lines;
            }

            return 'Xin lỗi, hiện tại tôi chưa tìm thấy thông tin này trong hệ thống.';
        }

        if (preg_match('/(size|chiều cao|cân nặng|fit|vừa|rộng)/u', $message)) {
            return 'Bạn có thể cho mình biết chiều cao và cân nặng để tư vấn size phù hợp hơn nhé.';
        }

        if (preg_match('/(thiết kế|màu|font|logo|slogan|bố cục|phối màu)/u', $message)) {
            return 'Mình có thể hỗ trợ gợi ý phối màu, font chữ, bố cục và slogan cho áo custom. Bạn muốn bắt đầu từ phong cách nào?';
        }

        if (preg_match('/\b(đổi trả|bảo hành|chính sách|hoàn trả|refund|return)\b/u', $message)) {
            return 'Chính sách đổi trả và bảo hành phụ thuộc vào sản phẩm cụ thể. Bạn gửi thêm thông tin đơn hàng hoặc sản phẩm để mình kiểm tra chi tiết hơn nhé.';
        }

        if (preg_match('/\b(khuyến mãi|sale|giảm giá|voucher|mã giảm|ưu đãi|promotion)\b/u', $message)) {
            $promotions = Promotion::query()
                ->where(function ($query) {
                    $query->whereNull('start_date')->orWhere('start_date', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('end_date')->orWhere('end_date', '>=', now());
                })
                ->get()
                ->filter(fn ($promotion) =>
                    $promotion->usage_limit === null
                    || $promotion->orders()->count() < $promotion->usage_limit
                );

            if ($promotions->isNotEmpty()) {
                return 'Hiện có ' . $promotions->count() . ' chương trình khuyến mãi đang áp dụng: ' . $promotions->take(3)->map(function ($promotion) {
                    $discount = $promotion->discount_type === 'percent'
                        ? $promotion->discount_value . '%'
                        : number_format($promotion->discount_value, 0, ',', '.') . ' VND';

                    return $promotion->code . ' - giảm ' . $discount
                        . ($promotion->min_order_amount ? ' cho đơn từ ' . number_format($promotion->min_order_amount, 0, ',', '.') . ' VND' : '');
                })->implode('; ') . '.';
            }

            return 'Hiện tại chưa có khuyến mãi phù hợp, mình sẽ báo lại khi có ưu đãi mới.';
        }

        if (preg_match('/\b(vận chuyển|ship|giao hàng|shipping|ship hàng|giao|nhận hàng)\b/u', $message)) {
            return 'Vận chuyển của N.clothes thường mất 1-3 ngày nội thành và 3-7 ngày cho tỉnh thành. Khi đơn hàng đã được xử lý, bạn sẽ nhận được thông tin chi tiết về vận chuyển trong trang đơn hàng.';
        }

        if (preg_match('/\b(thanh toán|payment|cash|card|thẻ|chuyển khoản|bank transfer|otp|mã otp)\b/u', $message)) {
            return 'Hệ thống hỗ trợ thanh toán bằng COD, thẻ nội địa/quốc tế và chuyển khoản ngân hàng. Với thẻ và chuyển khoản, bạn sẽ nhận mã OTP để xác nhận đơn hàng.';
        }

        if (preg_match('/\b(thiết kế|custom|customize|màu|font|logo|slogan|bố cục|phối màu|áo custom|design)\b/u', $message)) {
            return 'Chúng tôi hỗ trợ thiết kế áo custom theo phong cách riêng, kết hợp màu sắc, font chữ, logo và slogan. Bạn cho mình biết phong cách bạn muốn: tối giản, streetwear, dễ thương hay cá tính nhé.';
        }

        $normalizedMessage = $this->normalizeText($message);
        $productKeywords = $this->extractProductKeywords($message);
        $productTokens = array_values(array_unique(array_filter(array_map(function ($term) {
            $term = $this->normalizeText($term);
            return mb_strlen($term, 'UTF-8') >= 2 ? $term : null;
        }, $productKeywords), function ($term) {
            return $term !== null;
        })));
        $colorTokens = $this->extractColorTokens($message);
        $sizeTokens = $this->extractSizeTokens($message);
        $priceRange = $this->parsePriceRange($message);

        $hasProductIntent = preg_match('/\b(bạn có|có những|có sản phẩm|gợi ý|đề xuất|mẫu nào|áo nào|quần nào|hoodie|shirt|áo|quần|sản phẩm|mẫu|giá|bao nhiêu|mấy tiền|under|dưới|trên|over|còn hàng|tồn kho|hết hàng|đánh giá|review)\b/u', $normalizedMessage)
            || ! empty($productTokens)
            || ! empty($colorTokens)
            || ! empty($sizeTokens);

        if ($hasProductIntent) {
            $products = Product::query()
                ->with(['category', 'brand', 'images', 'variants'])
                ->where('status', 'active')
                ->when(! empty($priceRange['min']), fn ($query) => $query->where('price', '>=', $priceRange['min']))
                ->when(! empty($priceRange['max']), fn ($query) => $query->where('price', '<=', $priceRange['max']))
                ->when(! empty($colorTokens) || ! empty($sizeTokens), function ($query) use ($colorTokens, $sizeTokens) {
                    $query->whereHas('variants', function ($query) use ($colorTokens, $sizeTokens) {
                        if (! empty($colorTokens)) {
                            $query->where(function ($query) use ($colorTokens) {
                                foreach ($colorTokens as $token) {
                                    $query->orWhere(DB::raw('LOWER(color)'), 'like', '%' . mb_strtolower($token, 'UTF-8') . '%');
                                }
                            });
                        }

                        if (! empty($sizeTokens)) {
                            $query->where(function ($query) use ($sizeTokens) {
                                foreach ($sizeTokens as $token) {
                                    $query->orWhere(DB::raw('LOWER(size)'), '=', mb_strtolower($token, 'UTF-8'));
                                }
                            });
                        }
                    });
                })
                ->when(! empty($productTokens), function ($query) use ($productTokens) {
                    foreach ($productTokens as $token) {
                        $query->where(function ($query) use ($token) {
                            $query->where(DB::raw('LOWER(name)'), 'like', '%' . $token . '%')
                                ->orWhere(DB::raw('LOWER(description)'), 'like', '%' . $token . '%')
                                ->orWhereHas('category', function ($query) use ($token) {
                                    $query->where(DB::raw('LOWER(name)'), 'like', '%' . $token . '%');
                                })
                                ->orWhereHas('brand', function ($query) use ($token) {
                                    $query->where(DB::raw('LOWER(name)'), 'like', '%' . $token . '%');
                                });
                        });
                    }
                })
                ->take(10)
                ->get();

            if ($products->isEmpty()) {
                return ['reply' => 'Hiện tại mình chưa tìm thấy sản phẩm phù hợp. Bạn thử đổi cách mô tả hoặc cho mình biết rõ hơn về màu sắc, size hoặc tầm giá mong muốn nhé.'];
            }

            if (preg_match('/\b(đánh giá|review|rating|xếp hạng|stars|feedback)\b/u', $message)) {
                $product = $products->first();
                return $this->buildProductCardsResponse($products, 'Sản phẩm ' . $product->name . ' có đánh giá trung bình ' . round($product->getAverageRating(), 1) . '/5 từ ' . $product->getReviewCount() . ' lượt. Bạn có thể xem chi tiết đánh giá trên trang sản phẩm.');
            }

            if (preg_match('/\b(giá|bao nhiêu|price|cost|mấy tiền|under|dưới|trên|over)\b/u', $message)) {
                $product = $products->first();
                return $this->buildProductCardsResponse($products, 'Mình thấy sản phẩm phù hợp là ' . $product->name . '. Giá hiện tại là ' . number_format($product->price, 0, ',', '.') . ' VND. Nếu bạn muốn, mình có thể gợi ý thêm vài mẫu tương tự.');
            }

            if (preg_match('/\b(còn hàng|tồn kho|hết hàng|còn không|available|stock)\b/u', $message)) {
                $variant = null;

                if (! empty($colorTokens) || ! empty($sizeTokens)) {
                    $variant = ProductVariant::query()
                        ->whereHas('product', fn ($query) => $query->where('status', 'active'))
                        ->when(! empty($colorTokens), function ($query) use ($colorTokens) {
                            $query->where(function ($query) use ($colorTokens) {
                                foreach ($colorTokens as $token) {
                                    $query->orWhere(DB::raw('LOWER(color)'), 'like', '%' . mb_strtolower($token, 'UTF-8') . '%');
                                }
                            });
                        })
                        ->when(! empty($sizeTokens), function ($query) use ($sizeTokens) {
                            $query->where(function ($query) use ($sizeTokens) {
                                foreach ($sizeTokens as $token) {
                                    $query->orWhere(DB::raw('LOWER(size)'), '=', mb_strtolower($token, 'UTF-8'));
                                }
                            });
                        })
                        ->with('product')
                        ->first();
                }

                if ($variant) {
                    $response = 'Sản phẩm ' . $variant->product->name . ' màu ' . $variant->color . ' size ' . $variant->size . ' hiện còn ' . $variant->stock_quantity . ' chiếc.';
                    return $this->buildProductCardsResponse($products, $response);
                }

                $product = $products->first();
                $stock = $product->variants()->sum('stock_quantity');

                if ($stock > 0) {
                    return $this->buildProductCardsResponse($products, 'Sản phẩm ' . $product->name . ' hiện còn ' . $stock . ' chiếc ở nhiều size/màu khác nhau.');
                }

                return ['reply' => 'Rất tiếc, sản phẩm này hiện chưa có sẵn trong kho.'];
            }

            return $this->buildProductCardsResponse($products, 'Mình có một số mẫu phù hợp cho bạn.');
        }

        if (preg_match('/(size|chiều cao|cân nặng|fit|vừa|rộng)/u', $message)) {
            return 'Bạn có thể cho mình biết chiều cao và cân nặng để tư vấn size phù hợp hơn nhé.';
        }

        return null;
    }

    private function extractProductKeywords(string $message): array
    {
        $stopWords = [
            'có', 'những', 'nào', 'bao', 'nhiêu', 'giá', 'mấy', 'tiền', 'của', 'về', 'với', 'cho', 'các', 'được', 'không', 'xin', 'chào', 'bạn', 'tôi', 'mình', 'giúp', 'được', 'còn', 'là', 'thế', 'này', 'đó', 'một', 'câu', 'hỏi', 'có', 'thì', 'ở', 'trong', 'sản', 'phẩm', 'mẫu', 'áo', 'quần', 'hoodie', 'shirt', 'nhà', 'giới', 'thiệu', 'gợi', 'ý', 'đề', 'xuất', 'mấy', 'tiền'
        ];

        $tokens = preg_split('/\s+/u', preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $message));
        $tokens = array_filter(array_map('trim', $tokens), fn ($token) => mb_strlen($token, 'UTF-8') >= 2);

        return array_values(array_unique(array_filter($tokens, fn ($token) => ! in_array($token, $stopWords, true))));
    }

    private function extractColorTokens(string $message): array
    {
        $colors = [
            'đỏ', 'xanh', 'xanh dương', 'xanh lá', 'đen', 'trắng', 'hồng', 'vàng', 'nâu', 'be', 'kem', 'cam', 'tím', 'xám', 'ghi', 'nude', 'silver', 'gold', 'brown', 'purple'
        ];

        preg_match_all('/\b(' . implode('|', array_map('preg_quote', $colors)) . ')\b/iu', $message, $matches);

        return array_values(array_unique(array_filter(array_map(fn ($token) => mb_strtolower(trim($token), 'UTF-8'), $matches[0]))));
    }

    private function extractSizeTokens(string $message): array
    {
        preg_match_all('/\b(xs|s|m|l|xl|xxl|xxxl|freesize|free size)\b/iu', $message, $matches);

        return array_values(array_unique(array_filter(array_map(fn ($token) => mb_strtoupper(trim($token), 'UTF-8'), $matches[0]))));
    }

    private function buildProductCardsResponse($products, string $reply): array
    {
        $cards = $products->take(3)->map(function ($product) {
            $image = optional($product->images->first())->image_url;
            $imageUrl = $image ? asset($image) : null;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 0, ',', '.') . ' VND',
                'category' => optional($product->category)->name,
                'image' => $imageUrl,
                'url' => route('products.show', ['id' => $product->id]),
                'buy_url' => route('products.show', ['id' => $product->id]) . '?buy=1',
            ];
        })->toArray();

        return [
            'reply' => $reply,
            'cards' => $cards,
        ];
    }

    private function parsePriceRange(string $message): array
    {
        $range = ['min' => null, 'max' => null];

        if (preg_match('/\b(dưới|duoi|below)\s*([0-9.,]+)\s*(k|nghìn|vnd|dong|đồng|triệu|trieu)?\b/i', $message, $matches)) {
            $range['max'] = $this->normalizePrice($matches[2], $matches[3] ?? null);
            return $range;
        }

        if (preg_match('/\b(trên|tren|above|over)\s*([0-9.,]+)\s*(k|nghìn|vnd|dong|đồng|triệu|trieu)?\b/i', $message, $matches)) {
            $range['min'] = $this->normalizePrice($matches[2], $matches[3] ?? null);
            return $range;
        }

        if (preg_match('/\b(từ|tu|from)\s*([0-9.,]+)\s*(k|nghìn|vnd|dong|đồng|triệu|trieu)?\s*(đến|den|to|-)\s*([0-9.,]+)\s*(k|nghìn|vnd|dong|đồng|triệu|trieu)?\b/i', $message, $matches)) {
            $range['min'] = $this->normalizePrice($matches[2], $matches[3] ?? null);
            $range['max'] = $this->normalizePrice($matches[5], $matches[6] ?? null);
            return $range;
        }

        return $range;
    }

    private function normalizePrice(string $amount, ?string $unit): int
    {
        $amount = str_replace([',', '.'], ['', ''], $amount);
        $value = (int) $amount;

        if ($unit === null) {
            return $value;
        }

        $normalizedUnit = mb_strtolower($unit, 'UTF-8');

        if (str_contains($normalizedUnit, 'triệu') || str_contains($normalizedUnit, 'trieu')) {
            return $value * 1000000;
        }

        if (str_contains($normalizedUnit, 'k') || str_contains($normalizedUnit, 'nghìn') || str_contains($normalizedUnit, 'dong') || str_contains($normalizedUnit, 'đồng')) {
            return $value * 1000;
        }

        return $value;
    }

    private function normalizeText(?string $text): string
    {
        if ($text === null) {
            return '';
        }

        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[\x{0300}-\x{036f}\x{1ab0}-\x{1aff}\x{1dc0}-\x{1dff}\x{20d0}-\x{20ff}\x{fe20}-\x{fe2f}]/u', '', $text);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;

        return trim(preg_replace('/\s+/', ' ', $text) ?? $text);
    }
}
