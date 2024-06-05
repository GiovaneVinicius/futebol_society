<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->create($data);
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
            return ['token' => $token];
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
