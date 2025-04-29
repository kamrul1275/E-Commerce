<?php

namespace App\Http\Controllers;

use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// use factory;

class UserController extends Controller
{



    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        // $token = Auth::guard('api')->login($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            // 'token' => $this->respondWithToken($token),
        ], 201);
    }



    public function userProfile()
    {
        return response()->json([
            'user' => Auth::guard('api')->user(),
        ]);
    }




    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $response =  $this->respondWithToken($token);

            // Add the cookie to the response - secure and HTTP only
    $response->cookie(
        'jwt_token',         // Cookie name
        $token,              // Cookie value
        60,                  // Duration in minutes (adjust as needed)
        '/',                 // Path
        null,                // Domain (null = current domain)
        true,                // Secure (HTTPS only) - set to false in development
        true,                // HTTP only (not accessible via JavaScript)
        false,               // Raw
        'lax'                // SameSite policy
    );
    
    return $response;
    }


    function emailOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();
        Mail::to($user->email)->send(new OTPMail($otp));

        // // Generate token for the user
        // $token = Auth::guard('api')->login($user);

        return response()->json([
            'message' => 'OTP sent to your email',
        ]);

        // $response->cookie(
        //     'jwt_token',           // Cookie name
        //     $token,                // Cookie value (the token)
        //     60,                    // Cookie duration in minutes (60 minutes = 1 hour)
        //     '/',                   // Path
        //     null,                  // Domain (null = current domain)

        // );
    }



    function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if ($user->otp != $request->otp) {
            return response()->json(['error' => 'Invalid OTP'], 401);
        }
        $user->otp = null; // Clear the OTP after verification
        $user->email_verified_at = now(); // Set email verified timestamp
        $user->save();
          // Generate token after successful verification
    $token = Auth::guard('api')->login($user);
    
    // Create response with JSON data
    return  response()->json([
        'message' => 'Email verified successfully',
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => 60 * 5, // 1 hour in seconds
        'user' => $user
    ]);
    
    }


    //reset password


    function userResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password reset successfully',
        ]);

    }



    // Add this method to fix the error
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'expires_in' => 60 * 60, // 1 hour in seconds
            'user' => Auth::guard('api')->user(),
        ]);
    }
}
