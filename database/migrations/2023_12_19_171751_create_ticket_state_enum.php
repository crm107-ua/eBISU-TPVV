<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE TYPE ticket_state AS ENUM ('Open', 'Resolving', 'Closed')");
        DB::statement("ALTER TABLE ticket ADD state ticket_state");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE ticket DROP COLUMN state");
        DB::statement("DROP TYPE IF EXISTS ticket_state");
    }
};
