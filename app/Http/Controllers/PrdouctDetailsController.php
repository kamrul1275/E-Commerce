<?php

namespace App\Http\Controllers;

use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrdouctDetailsController extends Controller
{
    public function allPrdouctDetail()
{
    $details = ProductDetails::with('product')->get();
    return response()->json($details);
}//end method



public function storePrdouctDetail(Request $request)
{
    $validator = Validator::make($request->all(), [
        'img1' => 'required|string',
        'img2' => 'nullable|string',
        'img3' => 'nullable|string',
        'color' => 'required|string',
        'size' => 'required|string',
        'des' => 'required|string',
        'product_id' => 'required|exists:products,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $detail = ProductDetails::create($request->all());

    return response()->json(['message' => 'Product detail created successfully', 'detail' => $detail], 201);
}//end method


}
