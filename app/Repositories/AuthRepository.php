<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $credentials)
    {
        // Implement the login logic here
        // For example, using Laravel's Auth facade:
        return Auth::attempt($credentials);
    }

    // Implement other methods from the interface as needed
    public function logout()
    {
        // Implement the logout logic here
        return Auth::logout();
    }
}