<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
        function allProductCart()
    {
        // Fetch all product carts logic here
        $carts= Cart::with('product', 'user')->get();

        return response()->json(['message' => 'Product cart retrieved successfully',
    'data'=>$carts], 200);
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
        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = $request->user_id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['message' => 'Product cart created successfully'], 201);
    }//end method
}
