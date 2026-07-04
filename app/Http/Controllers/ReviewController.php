<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new review or update existing review
     */
    public function store(ReviewRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Check if user has purchased product
        $hasPurchased = Order::where('user_id', Auth::id())
                              ->where('status', 'completed')
                              ->whereHas('orderItems', function ($q) use ($productId) {
                                   $q->where('product_id', $productId);
                              })
                              ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua');
        }

        // Check if already reviewed
        $existingReview = Review::where('user_id', Auth::id())
                                ->where('product_id', $productId)
                                ->first();

        if ($existingReview) {
            // Update existing review
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = 'Đánh giá đã được cập nhật';
        } else {
            // Create new review
            Review::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = 'Cảm ơn bạn đã đánh giá sản phẩm';
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get reviews for a product with pagination
     */
    public function get($productId)
    {
        $product = Product::findOrFail($productId);
        $reviews = $product->reviews()
                          ->with('user')
                          ->orderBy('created_at', 'desc')
                          ->paginate(5);

        return response()->json([
            'reviews' => $reviews,
            'average_rating' => Review::getAverageRating($productId),
            'total_reviews' => Review::getReviewCount($productId),
        ]);
    }

    /**
     * Get average rating for a product
     */
    public function getAverageRating($productId)
    {
        $product = Product::findOrFail($productId);
        $averageRating = Review::getAverageRating($productId);
        $reviewCount = Review::getReviewCount($productId);

        return response()->json([
            'average_rating' => round($averageRating, 1),
            'total_reviews' => $reviewCount,
            'product_name' => $product->name,
        ]);
    }

    /**
     * Delete user's own review
     */
    public function destroy($productId)
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->firstOrFail();

        $review->delete();

        return redirect()->back()->with('success', 'Đánh giá đã được xóa');
    }

    /**
     * Get user's review for a product
     */
    public function getUserReview($productId)
    {
        $review = Review::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if (!$review) {
            return response()->json(['review' => null]);
        }

        return response()->json([
            'review' => [
                'id' => $review->id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'created_at' => $review->created_at->format('d/m/Y H:i'),
            ]
        ]);
    }

    /**
     * Get rating distribution for a product
     */
    public function getRatingDistribution($productId)
    {
        $product = Product::findOrFail($productId);
        
        $distribution = [
            '5' => Review::where('product_id', $productId)->where('rating', 5)->count(),
            '4' => Review::where('product_id', $productId)->where('rating', 4)->count(),
            '3' => Review::where('product_id', $productId)->where('rating', 3)->count(),
            '2' => Review::where('product_id', $productId)->where('rating', 2)->count(),
            '1' => Review::where('product_id', $productId)->where('rating', 1)->count(),
        ];

        $total = array_sum($distribution);

        // Calculate percentages
        $percentages = [];
        foreach ($distribution as $rating => $count) {
            $percentages[$rating] = $total > 0 ? round(($count / $total) * 100) : 0;
        }

        return response()->json([
            'distribution' => $distribution,
            'percentages' => $percentages,
            'total_reviews' => $total,
            'average_rating' => round(Review::getAverageRating($productId), 1),
        ]);
    }
}
