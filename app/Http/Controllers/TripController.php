<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Bus;
use App\Models\OriginalTrip;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class TripController extends BaseController
{
    public function postOriginalTrips2(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        // $filename = pathinfo($file, PATHINFO_FILENAME);
        // $filename = $file->getClientOriginalName();
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>> 5 \n", FILE_APPEND);
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($filename) . "\n", FILE_APPEND);
        return response()->json([
            'result' => 1
        ], 200);
    }

    public function postOriginalTrips(Request $request)
    {
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . 'hhhh' . "\n", FILE_APPEND);
        $file = $request->file('file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
            //Check for file extension and size
            // $this->checkUploadedFileProperties($extension, $fileSize);
            //Where uploaded file will be stored on the server
            $location = 'uploads'; //Created an "uploads" folder for that
            // Upload file
            $file->move($location, $filename);
            // In case the uploaded file path is to be stored in the database
            $filepath = public_path($location . "/" . $filename);
            file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($filepath) . "\n", FILE_APPEND);
            // Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;
            //Read the contents of the uploaded file
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0;
            foreach ($importData_arr as $importData) {
                // file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($importData) . "\n", FILE_APPEND);
                // $name = $importData[1]; //Get user names
                // $email = $importData[3]; //Get the user emails
                $j++;
                // Trip::create([
                //     'Booking_Ref' => $importData[1],
                //     'Lead_Surname' => $importData[5],
                //     // 'email' => $importData[3],
                //     // 'position' => $importData[4],
                //     // 'age' => $importData[5],
                //     // 'salary' => $importData[6]
                // ]);
                $hash_original_trip = substr(md5(join([
                    $importData[0],
                    $importData[8],
                    $importData[10],
                    $importData[12],
                    $importData[20],
                    $importData[23],
                    $importData[25],
                    $importData[28],
                    $importData[31],
                    $importData[33],
                ])), 0, 8);

                DB::table('original_trips')->insert([


                    'hash1' => substr(md5($importData[0] . $importData[8]), 0, 8),
                    // 'hash2' => $importData[],
                    // 'hash3' => $importData[],
                    'hash4' => $hash_original_trip,
                    'resort_region' => 'Como',
                    'booking_ref' => $importData[0],
                    'brand' => $importData[1],
                    'lead_title' => $importData[2],
                    'lead_forename' => $importData[3],
                    'lead_surname' => $importData[4],
                    'pax' => $importData[5],
                    'infant_pax' => $importData[6],
                    'holiday_arrival_date' => $importData[7],
                    'individual_name' => $importData[8],
                    'individual_age' => $importData[9],
                    'resort_arrival_date' => $importData[10],
                    'resort_name' => $importData[11],

                    'accom_name' => $importData[12],
                    'accom_duration' => $importData[13],
                    'stay_room_numbers' => $importData[14],
                    'room_number' => $importData[15],
                    'board_basis' => $importData[16],
                    'dietary_request' => $importData[17],
                    'outbound_flight' => $importData[18],
                    'outbound_departure_gateway' => $importData[19],
                    'outbound_arrival_gateway' => $importData[20],
                    'outbound_via_gateway' => $importData[21],
                    'outbound_departure_time' => $importData[22],
                    'outbound_arrival_time' => $importData[23],

                    'product_code' => $importData[24],

                    'resort_departure_date' => $importData[25],
                    'holiday_return_date' => $importData[26],
                    'return_flight' => $importData[27],
                    'return_departure_gateway' => $importData[28],

                    'return_arrival_gateway' => $importData[29],

                    'return_via_gateway' => $importData[30],
                    'return_departure_time' => $importData[31],
                    'special_requests' => $importData[32],
                    'private_transfer' => $importData[33],
                    'additional_info' => $importData[34],
                    'skicar' => $importData[35],
                    'package_info' => $importData[36],
                    'xref' => $importData[37],


                ]);
                // try {
                //     DB::beginTransaction();
                //     Trip::create([
                //         'Booking_Ref' => $importData[1],
                //         'Lead_Surname' => $importData[5],
                //         // 'email' => $importData[3],
                //         // 'position' => $importData[4],
                //         // 'age' => $importData[5],
                //         // 'salary' => $importData[6]
                //     ]);
                //     //Send Email
                //     // $this->sendEmail($email, $name);
                //     DB::commit();
                // } catch (\Exception $e) {
                //     //throw $th;
                //     DB::rollBack();
                // }
            }
            $this->processData();
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
            //no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function processData()
    {
        while (OriginalTrip::where('processed', 0)->exists()) {
            $originalTrips = OriginalTrip::where('processed', 0)->limit('50')->get();
            foreach ($originalTrips as $originalTrip) {
                $originalTrip->processed = 1;
                $originalTrip->save();
                Trip::create([
                    'origin1' => $originalTrip->outbound_arrival_gateway,
                    'destination1' => $originalTrip->resort_region,
                    'origin2' => $originalTrip->outbound_departure_gateway,
                    'destination2' => $originalTrip->resort_name,
                    'origin3' => $originalTrip->outbound_departure_gateway . '-' . $originalTrip->outbound_flight,
                    'destination3' => $originalTrip->accom_name,
                    'origin_date' => $originalTrip->resort_arrival_date,
                    'destination_date' => $originalTrip->resort_arrival_date,
                    'origin_time' => $originalTrip->outbound_arrival_time,
                    // 'destination_time' => $originalTrip->x,
                    // 'intermediate_origin' => $originalTrip->x,
                    // 'intermediate_destination' => $originalTrip->x,
                    // 'intermediate_origin_time' => $originalTrip->x,
                    // 'intermediate_destination_time' => $originalTrip->x,
                    // 'date' => $originalTrip->resort_arrival_date,
                    'type' => 'flight_arrival',
                    // 'bus_id' => $originalTrip->x,
                    // 'checked_rep' => $originalTrip->x,
                    // 'checked_driver' => $originalTrip->x,
                    // 'checked_bus' => $originalTrip->x,
                    'original_trip_hash4' => $originalTrip->hash4,
                ]);
                Trip::create([
                    'origin1' => $originalTrip->resort_region,
                    'destination1' =>  $originalTrip->return_departure_gateway,
                    'origin2' => $originalTrip->resort_name,
                    'destination2' => $originalTrip->return_arrival_gateway,
                    'origin3' => $originalTrip->accom_name,
                    'destination3' => $originalTrip->outbound_departure_gateway . '-' . $originalTrip->outbound_flight,
                    'origin_date' => $originalTrip->resort_departure_date,
                    'destination_date' => $originalTrip->resort_departure_date,
                    // 'origin_time' => $originalTrip->outbound_arrival_time,
                    'destination_time' => $originalTrip->return_departure_time,
                    // 'intermediate_origin' => $originalTrip->x,
                    // 'intermediate_destination' => $originalTrip->x,
                    // 'intermediate_origin_time' => $originalTrip->x,
                    // 'intermediate_destination_time' => $originalTrip->x,
                    // 'date' => $originalTrip->resort_arrival_date,
                    'type' => 'flight_departure',
                    // 'bus_id' => $originalTrip->x,
                    // 'checked_rep' => $originalTrip->x,
                    // 'checked_driver' => $originalTrip->x,
                    // 'checked_bus' => $originalTrip->x,
                    'original_trip_hash4' => $originalTrip->hash4,
                ]);
            }
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (!in_array(strtolower($extension), $valid_extension)) {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }

        if ($fileSize > $maxFileSize) {
            throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
        }
    }

    // public function sendEmail($email, $name)
    // {
    //     $data = array(
    //         'email' => $email,
    //         'name' => $name,
    //         'subject' => 'Welcome Message',
    //     );
    //     Mail::send('welcomeEmail', $data, function ($message) use ($data) {
    //         $message->from('welcome@myapp.com');
    //         $message->to($data['email']);
    //         $message->subject($data['subject']);
    //     });
    // }

    public function getTransferDates(Request $request)
    {
        $all = $request->all();
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($all) . "\n", FILE_APPEND);
        $tripType = $request->input('type');
        // $tripType = json_decode($tripType, true);
        // $tripType = $tripType['transferType'];
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($tripType) . "\n", FILE_APPEND);
        $nbDates = Trip::where('bus_id', null)
            ->where('type', $tripType)->groupBy('origin_date')->pluck('origin_date');
        $trDates = Trip::where('type', $tripType)->orderBy('origin_date')->groupBy('origin_date')->pluck('origin_date');
        $transferDates = [
            'nonBusedDates' => $nbDates,
            'allTransferDates' => $trDates
        ];
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($transferDates) . "\n", FILE_APPEND);
        return response()->json([
            'result' => $transferDates
        ]);
    }

    public function getGatewaysByDateByType(Request $request)
    {
        $all = $request->all();
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($all) . "\n", FILE_APPEND);

        $tripType = $request->input('type');
        $transferDate = $request->input('transferDate');

        // $tripType = 'flight_arrival';
        // $tripType = 'flight_departure';
        // $transferDate = '08 Jun 2022';


        if ($tripType == 'flight_arrival') {
            $gateways = Trip::where('origin_date', $transferDate)->where('type', $tripType)->groupBy('origin1')->pluck('origin1');
        } else {
            $gateways = Trip::where('origin_date', $transferDate)->where('type', $tripType)->groupBy('destination1')->pluck('destination1');
        }
        return response()->json([
            'result' => $gateways
        ]);
    }

    public function getTripsForPlanning(Request $request)
    {
        $tripType = $request->input('type');
        $transferDate = $request->input('transferDate');
        $gateway = $request->input('gateway');

        $tripType = 'flight_arrival';
        // $tripType = 'flight_departure';
        $transferDate = '01 Jun 2022';
        $gateway = 'MXP';

        if ($tripType == 'flight_arrival') {
            $trips = Trip::where('origin_date', $transferDate)
                ->where('origin1', $gateway)
                ->select('origin3', 'destination1', 'bus_id', DB::raw('count(*) as total, ANY_VALUE(origin1) as origin1, ANY_VALUE(origin_date) as origin_date, ANY_VALUE(origin_time) as origin_time'))
                ->groupBy('origin3')
                ->groupBy('destination1')
                ->groupBy('bus_id')
                ->get();



            // $trips = Trip::where('origin_date', $transferDate)
            //     // ->addSelect(DB::raw('count(*) as total'))
            //     ->selectRaw('ANY_VALUE(origin1)')
            //     ->groupBy('origin3')
            //     ->get();
        } else {
            $trips = Trip::where('origin_date', $transferDate)
                ->where('destination1', $gateway)
                ->select('destination3', 'origin1', 'bus_id', DB::raw('ANY_VALUE(destination1) as destination1, count(*) as total, ANY_VALUE(origin_date) as origin_date, ANY_VALUE(origin_time) as origin_time'))
                ->groupBy('destination3')
                ->groupBy('origin1')
                ->groupBy('bus_id')
                ->get();
        }
        return response()->json([
            'result' => $trips
        ]);
        // return response()->json([
        //     'result' => []
        // ]);
    }

    public function postAssignBus(Request $request)
    {
        $params = $request->all();
        $q1 = $params['origin_date'];
        file_put_contents('/var/www/html/challenge-kriptomat/kriptomat/storage/logs/mylog.log', date("Y-m-d H:i:s ")  . " >>>" . json_encode($q1) . "\n", FILE_APPEND);
        $bus =  Bus::create([
            'identifier' => $params['busRef'],
            'size' => $params['busSize'],
            'supplier' => $params['busSupplier'],
        ]);

        Trip::where('origin_date', $params['origin_date'])
        ->where('origin_date', $params['origin_date'])
        ->where('origin3', $params['origin3'])
        ->where('destination1', $params['destination1'])
        ->update(['bus_id' => $bus->id]);
        return response()->json([
            'result' => ['success' => 1]
        ]);
    }
}
