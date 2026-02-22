<?php

use App\Http\Controllers\api\Lead\LeadEmploesController;
use App\Http\Controllers\api\Lead\LeadKidController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\EmploesController;
use App\Http\Controllers\ProfileController;

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
    Route::get('/child/leads', [LeadKidController::class, 'allLead'])->name('child_lead');
    Route::post('/lead/child/create', [LeadKidController::class, 'createWeb'])->name('child_lead_create');
    
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/password/update', [ProfileController::class, 'update'])->name('profile_password_update');

    
});