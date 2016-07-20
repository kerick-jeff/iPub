<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;

class EmailController extends Controller
{
    public function send(Request $request){
            $title = $request->input('title');
            $content = $request->input('content');

            $sent = Mail::send('emails.send', ['title' => $title, 'content' => $content], function($message){
            $message->from('frukerickjeff@gmail.com', 'fru kerick');
            $message->to('sppuniversityparish@gmail.com')->cc('angwahgerard@gmail.com')->subject("test mail");
        });
        if($sent)
            return 'email sent';
        else
            return 'not sent';
        //$return->response()->json(['message' => 'request complete']);
    }


}
