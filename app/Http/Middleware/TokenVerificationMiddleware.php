<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Try to get the token from the cookie
            $token = $request->cookie('jwt_token');

            // If not in cookie, check Authorization header
            if (!$token && $request->hasHeader('Authorization')) {
                $authHeader = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $authHeader);
            }

            if (!$token) {
                return response()->json(['error' => 'Unauthorized - No token provided'], 401);
            }

            // Set the token for JWT authentication
            $request->headers->set('Authorization', 'Bearer ' . $token);

            // Authenticate user using the token
            // $user = Auth::guard('api')->setToken($token)->authenticate();
            $user = JWTAuth::setToken($token)->authenticate();
            

            if (!$user) {
                return response()->json(['error' => 'Unauthorized - Invalid token'], 401);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Unauthorized - Invalid token'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Unauthorized - Token expired'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized - ' . $e->getMessage()], 401);
        }

        // Allow request to continue
        return $next($request);
    }
}
