<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Twilio\TwiML\MessagingResponse;

class SmsController extends Controller
{
    //

    public function receiveSms(Request $request) {
        $from = $request->input('From');
        $body = $request->input('Body');

        if(substr($from, 0, 2) === "+1") $from = substr($from, 2);
        if(substr($from, 0, 1) === "1") $from = substr($from, 1);

        $userId = User::select('id')->where('mobile_number', $from)->first()['id'];

        Message::create(array(
            "user_id" => $userId,
            "content" => $body
        ));

        $request->headers->set('content-type', 'text/xml');
        $response = new MessagingResponse();
        return $response;
    }
}
