<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Transaction;
use App\Models\User;

class CreateTransactionService
{
    public function execute(array $data){

        $userPayer = User::find($data['payer']);

        if ($userPayer->type === 'SELLER') {
            throw new AppError('Invalid user type', 403);
        }

        if ($userPayer->balance < $data['value']) {
            throw new AppError('insufficient funds', 403);

        }

        $userPayee = $this->findUser($data['payee']);

        $userPayer->balance -= $data['value'];
        $userPayee->balance += $data['value'];

        $userPayer->save();
        $userPayee->save();

        if (is_null($userPayee)) {
           throw new AppError('Payee not found', 404);
        }

        return Transaction::create([
            'payee_id' => $userPayee->id,
            'payer_id' => $userPayer->id,
            'value' => $data['value']
        ]);
    }

    private function findUser(string $id) {
        $user = User::find($id);

        if(is_null($user)) {
            throw new AppError("User {$id} not found", 404);
        }

        return $user;
    }
}
