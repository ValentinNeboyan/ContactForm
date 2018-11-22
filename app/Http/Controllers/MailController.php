<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send()
    {
       Mail::send(['text'=>'mail'], ['name'=>'ContactForm'], function($message){
           $message->to('contactform@ukr.net', 'To Manager')->subject('Test');
           $message->from('contactform@ukr.net', 'From ContactForm');
       }) ;
    }
}
