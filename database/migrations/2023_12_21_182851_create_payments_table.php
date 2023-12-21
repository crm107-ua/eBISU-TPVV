<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['credit_card', 'paypal']);
            $table->string('paypal_user')->nullable();
            $table->string('credit_card_number')->nullable();
            $table->string('credit_card_month_of_expiration')->length(2)->nullable();
            $table->string('credit_card_year_of_expiration')->length(4)->nullable();
            $table->string('credit_card_csv')->length(3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
