<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function getUserById(int $id)
    {
        return User::where('id', $id)->first();
    }

}
