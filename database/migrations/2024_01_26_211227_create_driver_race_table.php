<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('driver_race', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id');
            $table->integer('race_id');
            $table->timestamps();

            $table->unique(['driver_id', 'race_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver_race');
    }
};
