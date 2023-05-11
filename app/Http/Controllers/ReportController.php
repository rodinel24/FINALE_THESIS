<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $customerRepository;
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository , CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function reservationReport(Request $request)
    {
        $transactions = $this->transactionRepository->getTransaction($request);
        $transactionsExpired = $this->transactionRepository->getTransactionExpired($request);
        
        return view('report.reservationReport', compact('transactions', 'transactionsExpired'));
    }


   

    public function guestReport(Request $request)
    {
        
        
        $customers = $this->customerRepository->get($request);
        $transactions = $this->transactionRepository->getTransaction($request);
        $transactionsExpired = $this->transactionRepository->getTransactionExpired($request);
        return view('report.guestReport', compact('customers','transactions', 'transactionsExpired'));
    }

    public function balanceReport(Request $request)
    {
        
        $transactions = $this->transactionRepository->getTransaction($request);
        $transactionsExpired = $this->transactionRepository->getTransactionExpired($request);

        return view('report.balanceReport' , compact('transactions', 'transactionsExpired'));
    }
  
  

}
