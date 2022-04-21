<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('origin1')->nullable();
            $table->string('destination1')->nullable();
            $table->string('origin2')->nullable();
            $table->string('destination2')->nullable();
            $table->string('origin3')->nullable();
            $table->string('destination3')->nullable();
            $table->string('origin_date')->nullable();
            $table->string('destination_date')->nullable();
            $table->string('origin_time')->nullable();
            $table->string('destination_time')->nullable();
            $table->string('intermediate_origin')->nullable();
            $table->string('intermediate_destination')->nullable();
            $table->string('intermediate_origin_time')->nullable();
            $table->string('intermediate_destination_time')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('transfer_nr')->nullable();
            $table->string('checked_rep')->nullable();
            $table->string('checked_driver')->nullable();
            $table->string('checked_bus')->nullable();
            $table->string('original_trip_hash4')->nullable();
            $table->timestamps();
            $table->index('original_trip_hash4');
            $table->foreign('original_trip_hash4')->references('hash4')->on('original_trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
