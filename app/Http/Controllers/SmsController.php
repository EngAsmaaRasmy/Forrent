<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    //
    private static $sender = "";
    private static $user = "";
    private static $password = "";


    public static function sendMassage($phone, $message)
    {
        $isError = 0;
        $errorMessage = true;
        $url = "";
        $url .= "user==" . self::$user;
        $url .= "&pwd=" . self::$password;
        $url .= "&smstext=" . $message;
        $url .= "&Sender=" . self::$sender;
        $url .= "&Nums=" . $phone;

        $response = Http::get($url);

        return $response;
    }
}
