<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiPaymentService;
use App\Http\Controllers\Controller;
use App\Services\ClientTokenService;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    private $paymentService;

    public function __construct() {
        $this->paymentService = new ApiPaymentService();
    }

    public function createNewTransaction(Request $request) {

    }

    public function getPaginatedTransactionList(Request $request) {

    }

    public function fulfillPendingTransaction(Request $request, $id) {

    }

    public function getTransactionDetails(Request $request, $id) {

    }

    public function refoundTransaction(Request $request, $id) {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = new ClientTokenService();
        $token = $service->createNewToken(4);
        return response()->json($token, 201);
    }

}
