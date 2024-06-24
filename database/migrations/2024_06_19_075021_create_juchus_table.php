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
        Schema::create('juchus', function (Blueprint $table) {
            $table->id();
            $table->integer('kyakusaki_id');
            $table->integer('bunbougu_id');
            $table->integer('kosu');
            $table->integer('joutai');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juchus');
    }
};
