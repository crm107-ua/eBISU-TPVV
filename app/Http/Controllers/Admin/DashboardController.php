<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $totalBusinesses = Business::count();
        $businessesLastMonth = Business::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $percentageLastMonth = ($totalBusinesses > 0) ? ($businessesLastMonth / $totalBusinesses) * 100: 0;

        $totalTransactionsAmount = Transaction::sum('amount');
        $transactionsLastMonth = Transaction::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $percentageTransactionsLastMonth = ($totalTransactionsAmount > 0) ? ($transactionsLastMonth / $totalTransactionsAmount) * 100 : 0;

        $topBusinesses = Business::select('businesses.*', DB::raw('SUM(transactions.amount) as total_amount'))
            ->join('transactions', 'businesses.id', '=', 'transactions.business_id')
            ->groupBy('businesses.id')
            ->orderBy('total_amount', 'desc')
            ->take(3)
            ->get();

        $monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
            'Junio', 'Julio', 'Agosto', 'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'];

        $transactionsPerMonth = Transaction::select(DB::raw('SUM(amount) as total_amount'),
            DB::raw('EXTRACT(MONTH FROM emision_date) as month'))
            ->groupBy(DB::raw('EXTRACT(MONTH FROM emision_date)'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM emision_date)'))
            ->get()
            ->pluck('total_amount', 'month');

        $monthLabels = array_map(function($monthNumber) use ($monthNames) {
            return $monthNames[$monthNumber - 1]; // Restamos 1 porque los arrays en PHP empiezan en 0
        }, $transactionsPerMonth->keys()->toArray());
        return view('dashboard.index',
            [
                'businessesNumber' => $totalBusinesses,
                'percentageLastMonth' => $percentageLastMonth,
                'totalTransactionsAmount' => $totalTransactionsAmount,
                'percentageTransactionsLastMonth' => $percentageTransactionsLastMonth,
                'topBusinesses' => $topBusinesses,
                'transactionsPerMonth' => $transactionsPerMonth,
                'monthLabels' => $monthLabels,
            ]);
    }
}
