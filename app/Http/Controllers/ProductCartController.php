<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    function allProductCart()
    {
        return response()->json(['message' => 'Product cart retrieved successfully'], 200);
    }//end method


    function storeProductCart(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Store product cart logic here

        return response()->json(['message' => 'Product cart created successfully'], 201);
    }//end method
    
}
