<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class PrdouctReviewController extends Controller
{
   function allProductReview()
   {
    $reviews = ProductReview::with(['product', 'user'])->get();
       return response()->json([
        'message' => 'Product review retrieved successfully',
        'data' => $reviews
    ], 200);
   }//end method

    function storeProductReview(Request $request)
    {
         // Validate request
         $request->validate([
              'rating' => 'required|integer|min:1|max:5',
              'comment'=>'required | string',
              'user_id' => 'required|exists:users,id',
              'product_id' => 'required|exists:products,id', 
         ]);

        $review = new ProductReview();
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->product_id = $request->product_id;
        $review->user_id = $request->user_id;
        //  dd($review);
        $review->save();
         // Store product review logic here
    
         return response()->json([
            'message' => 'Product review created successfully',
            'data' => $review,
        ], 201);
    }//end method
    
}
