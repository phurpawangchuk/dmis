<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\sendMail;
use App\Models\Calendar;

class MailController extends Controller
{

    public function __construct() {
        //$this->middleware(['auth']);
     }

    public function sendmail(Request $request){

        $to = 'webdesignerw@gmail.com';//$request['to'];
        $details = [
                    'title' => 'Title of the email',
                    'body' => 'Body of the email using smtp'
                ];
               
        Mail::to($to)->send(new sendMail($details));
        // \Mail::to($to)->send(new \App\Mail\sendMail($details));
        
        return response()->json([
            'message' => "Successfully sent an email.",
            'success' => true
        ], 200);
    }

    public function notification(Request $request){

        $calanders_data = Calendar::whereRaw('event_date = SUBSTRING(DATE_ADD(NOW(), INTERVAL 2 DAY),1,10)')->get();
             
        for($i=0; $i< count($calanders_data); $i++){
           
            $to = 'phurpawangchuk20@gmail.com';
            $two = 'sonamchoden.it@rtc.bt';
        
            $details = [
                        'title' => 'Admin Notification for Event - '.$calanders_data[$i]['event_name'],
                        'body' => 'There is to notify that there is an event on '.$calanders_data[$i]['event_date']." for your necessary action and greeting to be sent to the donors"
                    ];
                
            Mail::to($to)->send(new sendMail($details));
            Mail::to($two)->send(new sendMail($details));

            return response()->json([
                'message' => "Successfully sent an email.",
                'success' => true
            ], 200);
        }
    }
}