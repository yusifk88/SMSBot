<?php

namespace App\Http\Controllers;

use App\Services\GPT;
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

                $response = GPT::ask($message);

                $choices = $response['choices'];

                if ($choices) {

                    $reply = $choices[0]['message']['content'];
                    $res = HttpSMS::send($from, $to, $reply);
                    return response($res);

                }

                HttpSMS::send($from, $to, "sorry, i reply cannot help you today");

            }
        }
    }


}
