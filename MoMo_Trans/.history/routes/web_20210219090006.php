<?php

use App\Http\Controllers\transactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/send-money', function () {
    return view('sendMoney');
})->name('sendMoney');

Route::POST('paymomo', 'transactionsController@paymomo')->name('paymomo');

Route::get('/checkbalance', 'transactionsController@checkBalance')->name('cb');

Route::get('/testbalance', 'transactionsController@checkBalance')->name('tb');
