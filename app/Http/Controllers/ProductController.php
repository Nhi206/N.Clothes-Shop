<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'images', 'variants']);

        // Tìm kiếm
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo thương hiệu
        if ($request->has('brand') && $request->brand) {
            $query->where('brand_id', $request->brand);
        }

        // Lọc theo giá
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sắp xếp
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $products = $query->paginate(12);

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'brand', 'images', 'variants', 'reviews.user'])->findOrFail($id);

        // Gợi ý sản phẩm cùng danh mục và cùng màu sắc
        $productColors = $product->variants->pluck('color')->filter()->unique();
        $relatedProducts = collect();

        if ($productColors->isNotEmpty()) {
            $sameColorProductIds = ProductVariant::whereIn('color', $productColors)
                ->whereHas('product', function ($query) use ($product) {
                    $query->where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id);
                })
                ->pluck('product_id')
                ->unique();

            if ($sameColorProductIds->isNotEmpty()) {
                $sameColorProducts = Product::with('images')
                    ->whereIn('id', $sameColorProductIds)
                    ->get()
                    ->keyBy('id');

                $relatedProducts = $sameColorProductIds->map(fn ($id) => $sameColorProducts->get($id))->filter();
            }
        }

        if ($relatedProducts->count() < 4) {
            // Gợi ý cùng thương hiệu trong cùng danh mục
            $sameBrandProducts = Product::with('images')
                ->where('brand_id', $product->brand_id)
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->limit(4 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->concat($sameBrandProducts);
        }

        if ($relatedProducts->count() < 4) {
            // Gợi ý cùng size và cùng màu trong cùng danh mục
            $sizeColorPairs = $product->variants
                ->filter(fn ($variant) => $variant->size && $variant->color)
                ->map(fn ($variant) => ['size' => $variant->size, 'color' => $variant->color])
                ->unique();

            if ($sizeColorPairs->isNotEmpty()) {
                $sameSizeColorProductIds = ProductVariant::whereHas('product', function ($query) use ($product) {
                        $query->where('category_id', $product->category_id)
                              ->where('id', '!=', $product->id);
                    })
                    ->where(function ($query) use ($sizeColorPairs) {
                        foreach ($sizeColorPairs as $pair) {
                            $query->orWhere(function ($sub) use ($pair) {
                                $sub->where('size', $pair['size'])
                                    ->where('color', $pair['color']);
                            });
                        }
                    })
                    ->pluck('product_id')
                    ->unique();

                if ($sameSizeColorProductIds->isNotEmpty()) {
                    $sameSizeColorProducts = Product::with('images')
                        ->whereIn('id', $sameSizeColorProductIds)
                        ->whereNotIn('id', $relatedProducts->pluck('id'))
                        ->limit(4 - $relatedProducts->count())
                        ->get();

                    $relatedProducts = $relatedProducts->concat($sameSizeColorProducts);
                }
            }
        }

        if ($relatedProducts->count() < 4) {
            // Gợi ý cùng giá +/- 10% trong cùng danh mục
            $minPrice = round($product->price * 0.9, 2);
            $maxPrice = round($product->price * 1.1, 2);

            $samePriceRangeProducts = Product::with('images')
                ->where('category_id', $product->category_id)
                ->whereBetween('price', [$minPrice, $maxPrice])
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->limit(4 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->concat($samePriceRangeProducts);
        }

        if ($relatedProducts->count() < 4) {
            $boughtTogetherIds = OrderItem::whereHas('order', function ($query) use ($product) {
                $query->whereHas('orderItems', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                });
            })
            ->where('product_id', '!=', $product->id)
            ->select('product_id', DB::raw('COUNT(*) as purchase_count'))
            ->groupBy('product_id')
            ->orderByDesc('purchase_count')
            ->limit(4)
            ->pluck('product_id');

            if ($boughtTogetherIds->isNotEmpty()) {
                $remainingIds = $boughtTogetherIds->diff($relatedProducts->pluck('id'));
                if ($remainingIds->isNotEmpty()) {
                    $boughtProducts = Product::with('images')
                        ->whereIn('id', $remainingIds)
                        ->get()
                        ->keyBy('id');

                    $relatedProducts = $relatedProducts->concat(
                        $remainingIds->map(fn ($id) => $boughtProducts->get($id))->filter()
                    );
                }
            }
        }

        if ($relatedProducts->count() < 4) {
            $excludeIds = $relatedProducts->pluck('id')->push($product->id);
            $categoryProducts = Product::with('images')
                ->where('category_id', $product->category_id)
                ->whereNotIn('id', $excludeIds)
                ->limit(4 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->concat($categoryProducts);
        }

        $relatedProducts = $relatedProducts->unique('id')->values();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        $categories = Category::all();

        return view('products.category', compact('category', 'products', 'categories'));
    }
}
