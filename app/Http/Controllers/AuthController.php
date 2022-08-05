<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request, User $user): JsonResponse {
        try {
            $token = $user->authenticate($request);
            if(!$token) {
                return response()->json([
                    'message' => config('common.loginError'),
                ], 401);
            }

            return response()->json([
                'token' => "Bearer $token",
            ], 200)->header('Authorization', $token);

        } catch (\Throwable $throw) {
            return response()->json([
                'message' => $throw->getMessage()
            ], 500);
        }
    }

    public function user(): JsonResponse {
        return response()->json(Auth::user());
    }
}
