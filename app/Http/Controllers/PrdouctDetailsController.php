<?php

namespace App\Http\Controllers;

use App\Models\ProductDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PrdouctDetailsController extends Controller
{
    public function allPrdouctDetail()
{
    $details = ProductDetails::with('product')->get();
    return response()->json($details);
}//end method















public function storeProductDetail(Request $request)
{
    // Validation
    $validator = Validator::make($request->all(), [
        'img1' => 'required|image|max:2048',
        'img2' => 'nullable|image|max:2048',
        'img3' => 'nullable|image|max:2048',
        'color' => 'required|string|max:100',
        'size' => 'required|string|max:50',
        'des' => 'required|string',
        'product_id' => 'required|exists:products,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $uploadedFiles = [];
        
        // Upload images
        foreach (['img1', 'img2', 'img3'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = 'uploads/products/'. '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/product_details', $fileName, 'public');
                $uploadedFiles[$field] = $fileName;
            } else {
                $uploadedFiles[$field] = null;
            }
        }

        // Create record using object approach
        $productDetails = new ProductDetails();
        $productDetails->img1 = $uploadedFiles['img1'];
        $productDetails->img2 = $uploadedFiles['img2'];
        $productDetails->img3 = $uploadedFiles['img3'];
        $productDetails->color = $request->color;
        $productDetails->size = $request->size;
        $productDetails->des = $request->des;
        $productDetails->product_id = $request->product_id;
        $productDetails->save();

        return response()->json([
            'message' => 'Product details created successfully',
            'data' => $productDetails
        ], 201);

    } catch (Exception $e) {
        // Clean up uploaded files on error
        foreach ($uploadedFiles ?? [] as $fileName) {
            if ($fileName) {
                Storage::disk('public')->delete('uploads/product_details/' . $fileName);
            }
        }

        return response()->json([
            'message' => 'Failed to create product details: ' . $e->getMessage()
        ], 500);
    }
}


}
