<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For PostgreSQL, use ALTER COLUMN to change type
        DB::statement('ALTER TABLE propreties ALTER COLUMN description TYPE TEXT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the change
        DB::statement('ALTER TABLE propreties ALTER COLUMN description TYPE VARCHAR(255)');
    }
};
