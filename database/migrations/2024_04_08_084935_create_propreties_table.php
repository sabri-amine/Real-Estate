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
        Schema::create('propreties', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('city');
            $table->string('address');
            $table->double('price');
            $table->double('size');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->text('description');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('listing_type_id')->constrained();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propreties');
    }
};
