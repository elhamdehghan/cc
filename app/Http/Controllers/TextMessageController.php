<?php

namespace App\Http\Controllers;

use App\TextMessage;
use Illuminate\Http\Request;

class TextMessageController extends Controller
{

    public static function send($mobile,$body)
    {
        TextMessage::create([
            'mobile' => $mobile,
            'body' => $body,
        ]);

        // TODO: send the textmessage
    }
}
