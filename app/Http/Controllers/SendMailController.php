<?php

namespace App\Http\Controllers;

use App\Mail\AcrtfmMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function index() {
        $content = [
            'subject' => 'This is the test mail subject',
            'body' => 'This is the email body of how to send email from ACRTFM'
        ];

        Mail::to('jesthonymorales@gmail.com')->send(new AcrtfmMailer($content));
    }
}