<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send()
    {
       Mail::send(['text'=>'mail'], ['name'=>'ContactForm'], function($message){
           $message->to('svetotek@ukr.net', 'To Valentin')->subject('Test');
           $message->from('contactform@ukr.net', 'From ContactForm');
       }) ;
    }
}
