<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
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
            die();
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
                // $name = $importData[1]; //Get user names
                // $email = $importData[3]; //Get the user emails
                $j++;
                Trip::create([
                    'Booking_Ref' => $importData[1],
                    'Lead_Surname' => $importData[5],
                    // 'email' => $importData[3],
                    // 'position' => $importData[4],
                    // 'age' => $importData[5],
                    // 'salary' => $importData[6]
                ]);
                try {
                    DB::beginTransaction();
                    Trip::create([
                        'Booking_Ref' => $importData[1],
                        'Lead_Surname' => $importData[5],
                        // 'email' => $importData[3],
                        // 'position' => $importData[4],
                        // 'age' => $importData[5],
                        // 'salary' => $importData[6]
                    ]);
                    //Send Email
                    // $this->sendEmail($email, $name);
                    DB::commit();
                } catch (\Exception $e) {
                    //throw $th;
                    DB::rollBack();
                }
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
            //no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
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
}
