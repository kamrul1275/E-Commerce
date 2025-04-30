<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    function allPolicy()
    {
        return response()->json(['message' => 'Policy retrieved successfully'], 200);
    }//end method

    function storePolicy(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Store policy logic here

        return response()->json(['message' => 'Policy created successfully'], 201);
    }//end method
}
