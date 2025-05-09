<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/success', function (Request $request) {
    return view('payment-success');
});

Route::get('/cancel', function (Request $request) {
    return view('payment-cancel');
});