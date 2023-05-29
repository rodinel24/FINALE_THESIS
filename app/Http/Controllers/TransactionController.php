<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Payment;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index(Request $request)
    {
        $transactions = $this->transactionRepository->getTransaction($request);
        $transactionsExpired = $this->transactionRepository->getTransactionExpired($request);
        
        return view('transaction.index', compact('transactions', 'transactionsExpired'));
    }
 
    public function destroy(Request $request, $id)
{
    $transaction = Transaction::find($id);
    $customer = Customer::find($id);

    if ($transaction) {
        // Delete the transaction and related payments
        $transaction->payments()->delete();
        $transaction->delete();

        // Additional actions or redirects
    } else {
        // Handle case when the transaction doesn't exist
        // Display an error message or perform alternative actions
    }
}


}
