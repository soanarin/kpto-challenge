<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TripsAddForeignBus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE trips CHANGE transfer_nr bus_id bigint(20)");
        DB::statement("ALTER TABLE trips MODIFY bus_id bigint(20) unsigned");
        Schema::table('trips', function (Blueprint $table) {
            $table->index('bus_id');
            $table->foreign('bus_id')->references('id')->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
