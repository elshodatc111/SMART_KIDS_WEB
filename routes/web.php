<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['uz', 'ru'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('changeLang');

Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/', function () { return view('index'); })->name('home');
    Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');
});