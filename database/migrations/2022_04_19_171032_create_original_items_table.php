<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOriginalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('original_trips', function (Blueprint $table) {
            $table->id();
            $table->string('hash1')->nullable();
            $table->string('hash2')->nullable();
            $table->string('hash3')->nullable();
            $table->string('hash4')->nullable();
            $table->string('booking_ref')->nullable();
            $table->string('brand')->nullable();
            $table->string('lead_title')->nullable();
            $table->string('lead_forename')->nullable();
            $table->string('lead_surname')->nullable();
            $table->string('pax')->nullable();
            $table->string('infant_pax')->nullable();
            $table->string('holiday_arrival_date')->nullable();
            $table->string('individual_name')->nullable();
            $table->string('individual_age')->nullable();
            $table->string('resort_arrival_date')->nullable();
            $table->string('resort_name')->nullable();
            $table->string('resort_region')->nullable();
            $table->string('accom_name')->nullable();
            $table->string('accom_duration')->nullable();
            $table->string('stay_room_numbers')->nullable();
            $table->string('room_number')->nullable();
            $table->string('board_basis')->nullable();
            $table->string('dietary_request')->nullable();
            $table->string('outbound_flight')->nullable();
            $table->string('outbound_departure_gateway')->nullable();
            $table->string('outbound_arrival_gateway')->nullable();
            $table->string('outbound_via_gateway')->nullable();
            $table->string('outbound_departure_time')->nullable();
            $table->string('outbound_arrival_time')->nullable();
            $table->string('resort_departure_date')->nullable();
            $table->string('holiday_return_date')->nullable();
            $table->string('return_flight')->nullable();
            $table->string('return_departure_gateway')->nullable();
            $table->string('return_via_gateway')->nullable();
            $table->string('return_departure_time')->nullable();
            $table->string('special_requests')->nullable();
            $table->string('private_transfer')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('skicar')->nullable();
            $table->string('package_info')->nullable();
            $table->timestamps();
            $table->index('hash4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('original_trips');
    }
}
