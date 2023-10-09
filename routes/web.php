<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/pre', \LaraZeus\BoltPreset\Livewire\Preset::class);

Route::view('/', 'welcome');
Route::redirect('/login', '/admin/login')->name('login');

Route::post('/forms', function () {
    // test callbacks for bolt
    $code = \Illuminate\Support\Str::random(4, 5);

    \Illuminate\Support\Facades\DB::table('logger')->insert([
        'form_id' => request('form_id'),
        'response' => request('response'),
        'code' => $code,
    ]);

    return response()->json([
        'message' => 'your code is ' . $code,
        'state' => 'faild',
    ]);
});

Route::view('embed', 'embed');

Route::get('lang/{lang}', function ($lang) {
    if (array_key_exists($lang, config('app.locales'))) {
        session()->put('current_lang', $lang);
    } else {
        session()->put('current_lang', 'en');
    }

    return redirect(url()->previousPath());
});

Route::get('theme/{theme}', function ($theme) {
    session()->put('current_theme', $theme);

    return redirect(url()->previousPath());
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
