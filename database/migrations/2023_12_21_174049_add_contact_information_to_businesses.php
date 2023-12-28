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
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('contact_info_name')->nullable();
            $table->string('contact_info_phone_number')->nullable();
            $table->string('contact_info_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('contact_info_name');
            $table->dropColumn('contact_info_phone_number');
            $table->dropColumn('contact_info_email');
        });
    }
};
