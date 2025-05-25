<?php

namespace App\Http\Controllers;

use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{



function customersProfile(){

$customers = CustomerProfile::get();

        return response()->json([
            'status' => 'succes',
            'data' => $customers
        ], 201);

}


    public function createCustomerProfile(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'cus_name' => 'required|string|max:100',
            'cus_add' => 'required|string',
            'cus_city' => 'required|string',
            'cus_state' => 'required|string',
            'cus_postcode' => 'required|string',
            'cus_country' => 'required|string',
            'cus_phone' => 'required|string',
            'ship_name' => 'required|string|max:100',
            'ship_add' => 'required|string',
            'ship_city' => 'required|string',
            'ship_state' => 'required|string',
            'ship_postcode' => 'required|string',
            'ship_country' => 'required|string',
            'ship_phone' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }


        // dd($request->all());
    
        // Update or create user
        $user = User::updateOrCreate(
            ['email' => $request->email],
            ['otp' => rand(1000, 9999)] // Generate random OTP
        );
    
        // Update or create customer profile
        $customerProfile = CustomerProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'cus_name' => $request->cus_name,
                'cus_add' => $request->cus_add,
                'cus_city' => $request->cus_city,
                'cus_state' => $request->cus_state,
                'cus_postcode' => $request->cus_postcode,
                'cus_country' => $request->cus_country,
                'cus_phone' => $request->cus_phone,
                'cus_fax' => $request->cus_fax ?? null,
                'ship_name' => $request->ship_name,
                'ship_add' => $request->ship_add,
                'ship_city' => $request->ship_city,
                'ship_state' => $request->ship_state,
                'ship_postcode' => $request->ship_postcode,
                'ship_country' => $request->ship_country,
                'ship_phone' => $request->ship_phone
            ]
        );
    
        // Determine if this was a create or update operation
        $message = $user->wasRecentlyCreated ? 'Customer created successfully' : 'Customer updated successfully';
        $statusCode = $user->wasRecentlyCreated ? 201 : 200;
    
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => [
                'user' => $user,
                'profile' => $customerProfile
            ]
        ], $statusCode);
    }
}
