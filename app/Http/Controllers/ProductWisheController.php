<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductWisheController extends Controller
{
    function allProductWishlist()
    {
        return response()->json(['message' => 'Product wishlist retrieved successfully'], 200);
    }//end method

    function storeProductWishlist(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Store product wishlist logic here

        return response()->json(['message' => 'Product wishlist created successfully'], 201);
    }//end method


    
}
