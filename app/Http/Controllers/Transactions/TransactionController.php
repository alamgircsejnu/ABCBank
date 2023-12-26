<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\DepositWithdrawRequest;
use App\Http\Requests\Transactions\TransferRequest;
use App\Repositories\Transactions\TransactionRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function deposit(): View
    {
        return view('transactions.deposit');
    }

    public function processDeposit(DepositWithdrawRequest $request): RedirectResponse
    {
        $deposit = $this->transactionRepository->deposit($request);

        $response = $deposit ? [
            'error' => false,
            'message' => 'Your account has been credited by ' . $request->amount . ' ' . auth()->user()->account->currency_code,
        ] : [
            'error' => true,
            'message' => 'Something went wrong to deposit your money! Please try again later...',
        ];

        return redirect()->route('deposit')->with('response', $response);
    }

    public function withdraw(): View
    {
        return view('transactions.withdraw');
    }

    public function processWithdraw(DepositWithdrawRequest $request): RedirectResponse
    {
        if ($request->amount <= auth()->user()->account->balance) {

            $withdraw = $this->transactionRepository->withdraw($request);

            $response = $withdraw ? [
                'error' => false,
                'message' => 'Your account has been debited by ' . $request->amount . ' ' . auth()->user()->account->currency_code,
            ] : [
                'error' => true,
                'message' => 'Something went wrong to withdraw your money! Please try again later...',
            ];

        } else {
            $response = [
                'error' => true,
                'message' => 'Amount should not be greater than your available balance.',
            ];

        }

        return redirect()->route('withdraw')->with('response', $response);
    }

    public function transfer(): View
    {
        return view('transactions.transfer');
    }

    public function processTransfer(TransferRequest $request): RedirectResponse
    {

        if ($request->amount <= auth()->user()->account->balance) {

            $transfer = $this->transactionRepository->transfer($request);

            $response = $transfer ? [
                'error' => false,
                'message' => $request->amount . ' ' . auth()->user()->account->currency_code . ' has been successfully transferred to ' . $request->email,
            ] : [
                'error' => true,
                'message' => 'Something went wrong to transfer your money! Please try again later...',
            ];

        } else {
            $response = [
                'error' => true,
                'message' => 'Amount should not be greater than your available balance.',
            ];

        }

        return redirect()->route('transfer')->with('response', $response);
    }

    public function statement(): View
    {
        $transactions = $this->transactionRepository->statement();

        return view('transactions.statement', compact('transactions'));
    }
}
