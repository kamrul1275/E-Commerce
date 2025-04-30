<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdoductSliderController extends Controller
{
    function allProductSlider()
    {
        return response()->json(['message' => 'Product slider retrieved successfully'], 200);
    }//end method


    
    function storeProductSlider(Request $request)
    {
        // Validate request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'slider_image' => 'required|string',
        ]);

        // Store product slider logic here

        return response()->json(['message' => 'Product slider created successfully'], 201);
    }//end method


}
