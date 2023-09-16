<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GPT
{
    public static function ask($prompt)
    {
       $res= Http::withToken(self::Key())->post(self::URL(), [
            "model" => "gpt-3.5-turbo",
            "messages" => [["role" => "user", 'content' => $prompt]],
            "temperature" => 0.7
        ]);

       return $res->json();

    }

    private static function Key()
    {
        return config("gpt.key");
    }

    private static function URL()
    {
        return config("gpt.url");
    }


}
