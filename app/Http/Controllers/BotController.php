<?php

namespace App\Http\Controllers;

use App\Services\HttpSMS;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BotController extends Controller
{

    public function handle(Request $request)
    {


        $data = $request->all();
       if ($data) {

           $event = $data['type'];

           if ($event === 'message.phone.received') {

               $messageData = $data['data'];

               $from = $messageData['owner'];
               $to = $messageData['contact'];
               $message = Str::replace(" ", "", $messageData['content']);

               if (strtolower($message) == "hello") {

                   $response = "Hi, how can i help you?";
                   HttpSMS::send($from, $to, $response);


               }


           }
       }
    }


}
