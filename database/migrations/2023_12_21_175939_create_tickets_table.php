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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('creation_date');
            $table->enum('state', ['open', 'resolving', 'closed'])->default('open');
            $table->integer('priority');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->unsignedBigInteger('technitian_id')->nullable();
            $table->timestamps();

            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('technitian_id')
                ->references('id')
                ->on('technicians')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
