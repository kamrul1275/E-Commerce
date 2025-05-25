<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    function allCategory()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    } //end method


    function storelCategory(Request $request)
    {

        // Validate request
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:100|unique:categories',
            'categoryImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }


        // Handle file upload
        if ($request->hasFile('categoryImg')) {
            $image = $request->file('categoryImg');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);
            $imagePath = 'uploads/categories/' . $imageName;
        }

        // Create category
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->slug = strtolower(str_replace(' ', '-', $request->categoryName));
        $category->categoryImg = $imagePath ?? null;
        //dd($category);
        // Save category to database
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    } //end method
}
// end class
// end file