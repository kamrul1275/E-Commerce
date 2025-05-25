<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{



    public function allProduct()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    } //end method

    public function storeProduct(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|integer|min:0|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'stock_quantity' => 'required|integer|min:0',
            // 'status' => 'required|boolean',
            'remark' => 'nullable|in:New,Popular,Top,Special',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Handle image upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'uploads/products/'.time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Store image in storage/app/public/uploads/products
                $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
                
                if (!$imagePath) {
                    throw new Exception('Failed to upload image');
                }
            }

            // Create new product
  
             
            $product = new  Product();
            $product ->title = $request->title;
            $product->slug = strtolower(str_replace(' ', '-', $request->title));
            $product->description = $request->description;
            $product->discount_price = $request->discount_price ?? 0;
            $product->price = $request->price;
            $product->image = $imageName;
            $product->stock_quantity = $request->stock_quantity;
            $product->status = $request->status;
            $product->remark = $request->remark;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->save();
            
            
        

            // dd($product);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => [
                    'product' => $product,
                    'image_url' => $imageName ? asset('storage/uploads/products/' . $imageName) : null
                ]
            ], 201);

        } catch (Exception $e) {
            // Clean up uploaded file if product creation fails
            if (isset($imageName) && $imageName) {
                Storage::disk('public')->delete('uploads/products/' . $imageName);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to create product: ' . $e->getMessage()
            ], 500);
        }
    }
}