<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrdouctReviewController extends Controller
{
   function allProductReview()
   {
       return response()->json(['message' => 'Product review retrieved successfully'], 200);
   }//end method

    function storeProductReview(Request $request)
    {
         // Validate request
         $request->validate([
              'product_id' => 'required|exists:products,id',
              'review' => 'required|string',
              'rating' => 'required|integer|min:1|max:5',
         ]);
    
         // Store product review logic here
    
         return response()->json(['message' => 'Product review created successfully'], 201);
    }//end method
    
}
