<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function create($data)
    {
        return User::create($data);
    }

    public function updateUser($email, $data)
    {
        return User::where('email', $email)->update($data);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}

