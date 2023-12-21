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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->dateTime('sent_date');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->unsignedBigInteger('ticket_id');
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
