<?php

namespace App\Services;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HttpSMS
{


    public static function send($from_phone_number, $to_phone_number, string $message): PromiseInterface|Response
    {


        $res = Http::withHeaders([
            "x-api-key" => self::key()
        ])->post(self::URL() . "messages/send", [
            'content' => $message,
            'from' => $from_phone_number,
            'to' => $to_phone_number
        ]);

        return $res;


    }

    private static function key()
    {
        return config("http_sms.key");

    }

    private static function URL()
    {
        return config("http_sms.url");

    }


}
