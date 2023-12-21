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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supervisor_user_id')->references('user_id')->on('users');
            $table->foreignId('user_shift_id')->nullable()->references('id')->on('user_shifts');
            $table->string('street')->default('');
            $table->string('building_number', 16)->nullable();
            $table->string('city', 32)->default('');
            $table->string('zip', 10)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
