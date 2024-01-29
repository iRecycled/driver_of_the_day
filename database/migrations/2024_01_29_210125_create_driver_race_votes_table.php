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
        Schema::create('driver_race_votes', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id');
            $table->integer('race_id');
            $table->integer('vote_id');
            $table->timestamps();

            $table->unique(['vote_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_race_votes');
    }
};
