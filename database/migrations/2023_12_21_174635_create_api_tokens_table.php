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
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('issuer');
            $table->dateTime('expiration_date')->nullable();
            $table->unsignedInteger('times_used')->default(0);
            $table->boolean('invalidated')->default(false);
            $table->unsignedBigInteger('business_id');
            $table->timestamps();

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_tokens');
    }
};
