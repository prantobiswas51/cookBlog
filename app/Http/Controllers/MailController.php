<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function sendMail() {
        $to = "prantobd320@gmail.com";
        $msg = "Body";
        $subject = "Mail Tester";

        Mail::to($to)->send(new WelcomeEmail($msg, $subject));
    }


}
