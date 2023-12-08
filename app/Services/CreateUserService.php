<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class CreateUserService
{
    public function execute(array $data)
    {
        $userFound = User::firstWhere('email', $data['email']);

        if (!is_null($userFound)) {
            throw new AppError('Email já existe', 400);
        }

        $userFound = User::firstWhere('cpf', $data['cpf']);

        if (!is_null($userFound)) {
            throw new AppError('Cpf já existe', 400);
        }

        return User::create($data);
    }
}
