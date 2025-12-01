<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test-mail', function () {
    Mail::raw('Test Invoice Reminder Email', function ($message) {
        $message->to('helmi@bapconstruction.co.id')
                ->subject('Test Email');
    });

    return "Email sent!";
});

