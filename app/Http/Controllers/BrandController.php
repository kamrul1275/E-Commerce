<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    //  * Display a listing of the brands.

    public function allBrand()
    {
        $brands = Brand::all();
        return response()->json([
            'status' => 'success',
            'data' => $brands
        ]);
    } //end method




    //  Store a newly created brand in storage.

    public function storeBrand(Request $request)
    {
        // dd("hello");
        // Validate request
        $validator = Validator::make($request->all(), [
            'brandName' => 'required|string|max:100|unique:brands',
            // 'slug' => 'required|string|max:100|unique:brands',
            'brandImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }
        // dd($request->all());

        // Handle file upload
        if ($request->hasFile('brandImg')) {
            $image = $request->file('brandImg');

            // dd($image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $imageName);
            $imagePath = 'uploads/brands/' . $imageName;
        }

        $brand = new Brand();
        $brand->brandName = $request->brandName;
        $brand->slug = strtolower(str_replace(' ', '-', $request->brandName));
        $brand->brandImg = $imagePath;
        // dd($brand);
        $brand->save();

        //dd($brand);

        return response()->json([
            'status' => 'success',
            'message' => 'Brand created successfully',
            'data' => $brand
        ], 201);
    } //end method


}
