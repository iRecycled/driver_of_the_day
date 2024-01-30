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
        Schema::table('votes', function (Blueprint $table) {
            # Remove the unneeded league and session columns
            $table->dropColumn(['driver_name', 'league_id', 'session_id']);

            # Add race model relation
            $table->unsignedBigInteger('race_id')->after('driver_id');
            
            # Match the datatype of the driver_id column in the drivers table
            $table->unsignedBigInteger('driver_id')->change();
 
            # Add foreign key constraint
            $table->foreign('race_id')->references('id')->on('races')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            # Revert the foreign key constraints
            $table->dropForeign(['race_id']);
            $table->dropForeign(['driver_id']);
            $table->dropIndex('votes_driver_id_foreign');

            # Drop the new column
            $table->dropColumn('race_id');
    
            # Add back the league and session columns in the right order
            $table->string('driver_name')->after('id');
            $table->unsignedBigInteger('league_id')->after('driver_id');
            $table->unsignedBigInteger('session_id')->after('league_id');

            # Set driver_id back to an INT from BIGINT
        });

        # Not sure why, but this needs to be in a separate operation
        Schema::table('votes', function (Blueprint $table) {
            $table->unsignedInteger('driver_id')->change();
        });
    }
};
