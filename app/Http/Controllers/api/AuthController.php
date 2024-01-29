<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validation->fails()) {
            $responseArr['message'] = $validation->errors();
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }

        try {
            $credential = $request->only('email', 'password');
            $token = Auth::attempt($credential);

            if (!$token) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            $user = Auth::user();

            return response()->json([
                'authorization' => [
                    'token' => $token,
                ]
            ]);
        } catch (ExceptionsJWTException $e) {
            return response()->json(['message' => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function user(): JsonResponse
    {
        try {
            $user = Auth::user();
            return response()->json(compact('user'));
        } catch (\Exception $e) {
            return response()->json(['message' => $e], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
            ]
        ]);
    }
}
