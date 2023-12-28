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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('concept')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('state', ['waiting', 'accepted', 'cancelled'])->default('waiting');
            $table->string('receipt_number')->nullable();
            $table->dateTime('emision_date');
            $table->dateTime('finished_date')->nullable();
            $table->integer('finalize_reason')->nullable();
            $table->unsignedBigInteger('refounds_id')->nullable()->unique(); // Unique since a transaction can only be refounded by one transaction
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();

            $table->foreign('refounds_id')
                ->references('id')
                ->on('transactions')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
