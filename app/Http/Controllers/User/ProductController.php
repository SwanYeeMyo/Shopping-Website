<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*')->paginate(6);
        $categories = Category::all();
        //dd($images->toArray());
        $products->appends(request()->all());

        return view('user.Home', compact('products', 'categories'));
    }



    public function createReview(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        // Create a new review each time
        $review = ProductRating::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        // Calculate average rating
        $avg = ProductRating::where('product_id', $request->product_id)->avg('rating');

        return response()->json([
            'success' => true,
            'user' => auth()->user()->name,
            'rating' => $review->rating,
            'comment' => $review->comment,
            'average' => number_format($avg, 1)
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'review_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $review = ProductRating::where('id', $request->review_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'rating' => $review->rating,
            'comment' => $review->comment
        ]);
    }

    public function delete($id)
    {
        // Make sure the user can only delete their own review
        $review = ProductRating::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $review->delete();

        return response()->json(['success' => true]);
    }
}
