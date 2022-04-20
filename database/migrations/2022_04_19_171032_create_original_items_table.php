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
            $table->string('ref_person')->nullable();
            $table->string('booking_ref')->nullable();
            $table->string('lead_forename')->nullable();
            $table->string('lead_surname')->nullable();
            $table->string('pax')->nullable();
            $table->string('holiday_arrival_date')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            // $table->string('name')->nullable();
            $table->timestamps();
        });

        // {
        //     ref_person: { type: String, default: 'none' },
        //     Booking_Ref: { type: String, default: 'none' },
        //     Brand_Name: { type: String, default: 'none' },
        //     Lead_Title: { type: String, default: 'none' },
        //     Lead_Forename: { type: String, default: 'none' },
        //     Lead_Surname: { type: String, default: 'none' },
        //     Pax: { type: String, default: 'none' },
        //     Infant_Pax: { type: String, default: 'none' },
        //     Holiday_Arrival_Date: { type: String, default: 'none' },
        //     Individual_Name: { type: String, default: 'none' },
        //     Individual_Age: { type: String, default: 'none' },
        //     Resort_Arrival_Date: { type: String, default: 'none' },
        //     Resort_Name: { type: String, default: 'none' },
        //     Accom_Name: { type: String, default: 'none' },
        //     Accom_Duration: { type: String, default: 'none' },
        //     Stay_Room_Numbers: { type: String, default: 'none' },
        //     Room_Number: { type: String, default: 'none' },
        //     Board_Basis: { type: String, default: 'none' },
        //     Dietary_Requirements: { type: String, default: 'none' },
        //     Outbound_Flight: { type: String, default: 'none' },
        //     Outbound_Departure_Gateway: { type: String, default: 'none' },
        //     Outbound_Arrival_Gateway: { type: String, default: 'none' },
        //     Outbound_Via_Gateway: { type: String, default: 'none' },
        //     Outbound_Departure_Time: { type: String, default: 'none' },
        //     Outbound_Arrival_Time: { type: String, default: 'none' },
        //     Product_Code: { type: String, default: 'none' },
        //     Resort_Departure_Date: { type: String, default: 'none' },
        //     Holiday_Return_Date: { type: String, default: 'none' },
        //     Return_Flight: { type: String, default: 'none' },
        //     Return_Departure_Gateway: { type: String, default: 'none' },
        //     Return_Arrival_Gateway: { type: String, default: 'none' },
        //     Return_Via_Gateway: { type: String, default: 'none' },
        //     Return_Departure_Time: { type: String, default: 'none' },
        //     Special_Requests: { type: String, default: 'none' },
        //     Private_Transfer: { type: String, default: 'none' },
        //     Additional_Info: { type: String, default: 'none' },
        //     SKICAR: { type: String, default: 'none' },
        //     Package_Info: { type: String, default: 'none' },
        //     Xref: { type: String, default: 'none' }
        //   }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('original_items');
    }
}
