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
        Schema::table('property_notifications', function (Blueprint $table) {
            $table->string('type', 20)->default('pending')->change();
            $table->foreignId('reservation_id')->nullable()->after('property_id')->constrained('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_notifications', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']);
            $table->dropColumn('reservation_id');
            $table->enum('type', ['pending', 'approved', 'rejected'])->default('pending')->change();
        });
    }
};
