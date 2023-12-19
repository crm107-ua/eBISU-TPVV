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
        DB::statement("CREATE TYPE user_role AS ENUM ('Admin', 'Technician', 'Business')");
        DB::statement("ALTER TABLE users ADD role user_role");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users DROP COLUMN role");
        DB::statement("DROP TYPE IF EXISTS user_role");
    }
};