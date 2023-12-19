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
        Schema::create('business_info', function (Blueprint $table) {
            $table->id();
            $table->string('cif')->unique();
            $table->string('social_reason');
            $table->string('contact_info_name')->nullable();
            $table->string('contact_info_phone_number')->nullable();
            $table->string('contact_info_email');
            $table->dateTime('registration_date');
            $table->decimal('balance', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_info');
    }
};