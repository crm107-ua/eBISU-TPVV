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
        Schema::table('users', function (Blueprint $table) {
            $table->string('direction_direction');
            $table->string('direction_postal_code')->length(5);
            $table->string('direction_poblation');
            $table->unsignedBigInteger('direction_country_id');

            $table->foreign('direction_country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['direction_country_id']);

            $table->dropColumn('direction_direction');
            $table->dropColumn('direction_postal_code');
            $table->dropColumn('direction_poblation');
            $table->dropColumn('direction_country_id');
        });
    }
};
