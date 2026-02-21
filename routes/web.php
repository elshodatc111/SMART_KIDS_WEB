<?php

use App\Http\Controllers\api\Lead\LeadEmploesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\EmploesController;

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

    
    Route::get('/emploes', [EmploesController::class, 'index'])->name('emploes');
    Route::post('/emploes/create', [EmploesController::class, 'store'])->name('emploes_create');
    Route::get('/emploes/leads', [LeadEmploesController::class, 'allLead'])->name('emploes_lead');
    Route::post('/lead/emploes/create', [LeadEmploesController::class, 'createLeadWebEmploes'])->name('emploes_lead_create');
});