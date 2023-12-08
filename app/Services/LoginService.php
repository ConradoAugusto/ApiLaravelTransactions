<?php

namespace App\Services;

use App\Exceptions\AppError;

class LoginService
{
    public function execute(array $data)
    {
        if (!$token = auth()->attempt($data)) {
            throw new AppError('Email ou Senha Incorretos', 401);
        }

        return $this->responseToken($token);
    }

    private function responseToken($token)
    {
        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }
}
