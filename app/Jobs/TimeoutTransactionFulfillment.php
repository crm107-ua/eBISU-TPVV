<?php

namespace App\Jobs;

use App\Enums\FinalizeReason;
use App\Services\ApiPaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TimeoutTransactionFulfillment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transactionId;

    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function handle(): void
    {
        $service = new ApiPaymentService();
        $service->finalizePendingTransaction($this->transactionId, null, FinalizeReason::TIMEOUT);
    }
}
