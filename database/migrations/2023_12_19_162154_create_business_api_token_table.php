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
        Schema::create('business_api_token', function (Blueprint $table) {
            $table->id();
            $table->string('issuer');
            $table->dateTime('expiration_date');
            $table->timestamps();
            $table->unsignedInteger('times_used')->default(0);
            $table->boolean('invalidated')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_api_token');
    }
};