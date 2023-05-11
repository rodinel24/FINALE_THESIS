<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Payment;
use Carbon\Carbon;
use App\Http\Controllers\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'room', 'customer')
            ->where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()]])
            ->orderBy('check_out', 'ASC')
            ->orderBy('id', 'DESC')->get();

            //total revenue
            $orders = Payment::all();
            $revenue = $orders->sum('price');

            //todays revenue
            $orders = Payment::whereDate('created_at', today())->get();
         $todays_revenue = $orders->sum('price');

        //  $today = now()->format('Y-m-d');
        // $orders = Payment::whereBetween('transaction_date', [$today . ' 00:00:00', $today . ' 23:59:59'])->get();
        // $todays_revenue = $orders->sum('total');

        //download function for todays guests




        //this month revenue
                
        // Get the current month and year
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        // Query the transactions table to get the revenue for the current month and year
        $revenue = Payment::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('price');

        // Format the revenue as currency
        $formattedRevenue =  number_format($revenue, 2);



        
   

        
        

        return view('dashboard.index', compact('transactions','revenue','todays_revenue' , 'formattedRevenue'));
    }

    
}
