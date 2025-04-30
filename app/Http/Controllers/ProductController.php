<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{



    public function allProduct()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }//end method




    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_des' => 'required|string',
            'discount' => 'nullable|integer|min:0|max:100',
            'price' => 'required|numeric',
            'image' => 'required|string', // or handle file upload separately
            'stock' => 'required|integer',
            'star' => 'required|numeric|min:0|max:5',
            'remark' => 'nullable|in:New,Popular,Top,Special',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create($request->all());

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }//end method




    
}
