<?php

namespace App\Http\Controllers;

use App\Models\ProductWishe;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
       function allProductWishlist()
    {
         $wishlist = ProductWishe::with('product','user')->get();
        return response()->json(['message' => 'Product wishlist retrieved successfully',
            'data' => $wishlist
    ], 200);
    }//end method


    

    function storeProductWishlist(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Store product wishlist logic here
        $wishlist = new ProductWishe();
        $wishlist->product_id = $request->product_id;
        $wishlist->user_id = $request->user_id;
        $wishlist->save();
        // Return success response

        return response()->json(['message' => 'Product wishlist created successfully'], 201);
    }//end method


}
