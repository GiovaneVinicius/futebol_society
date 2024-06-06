<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data)
    {
        $data['password'] = bcrypt($data['password']);

        // Criar o usuário
        $user = $this->userRepository->create($data);
        
        return $user;
    }

    public function generateToken(User $user){
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function login(array $credentials)
    {
        // Tentar autenticar o usuário
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user;
        } else {
            return false;
        }
    }

    // public function logout()
    // {
    //     // Revogar todos os tokens de acesso do usuário autenticado
    //     Auth::user()->tokens()->delete();

    //     return response()->json(['message' => 'Usuário deslogado com sucesso.']);
    // }
}
