<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::redirect('/login', '/admin/login')->name('login');

Route::get('/lang/{lang}', function ($lang) {
    session()->put('current_lang', $lang);
    app()->setLocale($lang);

    return redirect()->back();
});

/*Route::get('/feedbackCode', function ($response) {
    dd($response);
});*/
