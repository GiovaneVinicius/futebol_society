<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = $this->authService->register($request->all());

        $accessToken = $this->authService->generateToken($user);

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'type_user' => 'user',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = $this->authService->login($request->all());

        if(!$user){
            return response()->json(['email' => ['As credenciais fornecidas estão incorretas.']], 400);
        }

        $accessToken = $this->authService->generateToken($user);

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'type_user' => 'user',
            'user' => $user,
        ]);
    }

    // public function logout()
    // {
    //     return $this->authService->logout();
    // }
}
