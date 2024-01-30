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
        Schema::table('races', function (Blueprint $table) {
            $table->timestamp('race_time')->change();
            $table->integer('time_limit')->default(30)->after('race_time');
            $table->bigInteger('season_id')->after('league_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('races', function (Blueprint $table) {
            $table->date('race_time')->change();
            $table->dropColumn('time_limit');
            $table->dropColumn('season_id');
        });
    }
};
