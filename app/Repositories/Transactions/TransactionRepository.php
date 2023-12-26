<?php

namespace App\Repositories\Transactions;

use App\Models\Accounts\Account;
use App\Models\Transaction\Transaction;
use App\Models\User;

class TransactionRepository
{

    public function deposit($data): bool
    {
        try {
            $account = $this->account();
            $this->makeTransaction($data, $account, 'Credit');
            $this->updateMainBalance($data->amount, $account,'deposit');

            return true;

        } catch (\Exception $error) {
            return false;
        }

    }


    public function withdraw($data): bool
    {
        try {
            $account = $this->account();
            $this->makeTransaction($data, $account, 'Debit');
            $this->updateMainBalance($data->amount, $account,'withdraw');

            return true;

        } catch (\Exception $error) {
            return false;
        }
    }

    public function transfer($data): bool
    {
        try {
            // Withdraw money
            $this->withdraw($data);

            // Deposit money
            $toAccount = $this->findAccountByEmail($data->email);
            $this->makeTransaction($data, $toAccount, 'Credit');
            $this->updateMainBalance($data->amount, $toAccount,'deposit');


            return true;

        } catch (\Exception $error) {

            return false;

        }
    }

    public function statement()
    {
        $account = $this->account();
        return Transaction::where('account_id', $account->id)
            ->orderBy('id')
            ->paginate(10);
    }

    public function makeTransaction($data, $account, $type): bool
    {
        try {
            $transaction = Transaction::create([
                'account_id' => $account->id,
                'amount' => $data->amount,
                'type' => $type,
                'details' => $data['remarks'],
                'balance' => $type === 'Credit'? $account->balance + $data->amount : $account->balance - $data->amount,
            ]);

            return true;

        } catch (\Exception $error) {
            return false;
        }
    }

    public function updateMainBalance($amount, $account, $operation)
    {
        try {
            $account->update([
                'balance' => $operation === 'deposit' ? $account->balance + $amount : $account->balance - $amount
            ]);

            return $account;
        } catch (\Exception $error) {

            return false;
        }

    }

    public function account()
    {
        return Account::where('user_id', auth()->user()->id)->first();
    }

    public function findAccountByEmail($email)
    {
        $user = User::where('email', $email)->first();

        return Account::where('user_id', $user->id)->first();
    }


}
