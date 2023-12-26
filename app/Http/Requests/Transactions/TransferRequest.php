<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['email', 'max:255', 'exists:users,email'],
            'amount' => ['required', 'numeric', 'min:10'],
            'remarks' => ['required', 'string', 'max:255'],
        ];
    }
}
