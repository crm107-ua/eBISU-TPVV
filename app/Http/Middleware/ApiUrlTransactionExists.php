<?php

namespace App\Http\Middleware;

use App\Models\Transaction;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiUrlTransactionExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $transactionId = $request->route('id');

        if (!is_numeric($transactionId)) {
            return response()->json([
                'error' => 'Invalid request',
                'description' => 'The id must be an integer',
            ], 400);
        }

        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return response()->json([
                'error' => 'Transaction not found',
                'description' => "There is no transaction with id '$transactionId'",
            ], 404);
        }

        $request->attributes->add(['url_transaction' => $transaction]);

        return $next($request);
    }
}
