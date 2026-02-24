<?php

use App\Http\Controllers\api\Lead\LeadEmploesController;
use App\Http\Controllers\api\Lead\LeadKidController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\Emploes\EmploesDavomadController;
use App\Http\Controllers\EmploesController;
use App\Http\Controllers\KassaController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\MoliyaController;
use App\Http\Controllers\ProfileController;

Route::get('lang/{locale}', function ($locale) {if (in_array($locale, ['uz', 'ru'])) {session()->put('locale', $locale);}return redirect()->back();})->name('changeLang');

Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');  // Login page
Route::post('/login', [AuthWebController::class, 'login']); // Login Post

Route::middleware('auth')->group(function () {
    Route::get('/', function () { return view('index'); })->name('home'); // Bosh sahifa
    Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout'); // Logindan chiqish
    Route::get('/emploes', [EmploesController::class, 'index'])->name('emploes');  // Barcha hodimlar
    Route::get('/emploes/davomad', [EmploesDavomadController::class, 'showDavomad'])->name('emploes_davomad'); // Xodimlar davomadi
    Route::post('/davomad/saqlash', [EmploesDavomadController::class, 'store'])->name('davomad_store');  // Hodimlar davomadini saqlash
    Route::post('/emploes/create', [EmploesController::class, 'store'])->name('emploes_create'); // Yangi hodim qo'shish
    Route::get('/emploes/leads', [LeadEmploesController::class, 'allLead'])->name('emploes_lead'); // Lead barcha Hodim leadlari
    Route::post('/lead/emploes/create', [LeadEmploesController::class, 'createLeadWebEmploes'])->name('emploes_lead_create'); // Yangi xodim lead qo'shish
    Route::get('/child/leads', [LeadKidController::class, 'allLead'])->name('child_lead'); // Barcha Child Lead
    Route::post('/lead/child/create', [LeadKidController::class, 'createWeb'])->name('child_lead_create'); // Yangi child create lead
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');  // Profile Page
    Route::post('/profile/password/update', [ProfileController::class, 'update'])->name('profile_password_update'); // Passport Update Post
    Route::get('/kassa', [KassaController::class, 'kassa'])->name('kassa'); // Kassa Page
    Route::get('/kids', [KidController::class, 'kids'])->name('kids'); // Barcha bolalar
    Route::post('/kids/create', [KidController::class, 'store'])->name('kids_create'); // Yangi bola qo'shish
    Route::post('/kids/update', [KidController::class, 'kidUpdate'])->name('kids_update'); // Yangi bola qo'shish
    Route::post('/kids/note/create', [KidController::class, 'noteCreate'])->name('kids_note_create'); // Yangi izoh qoldirish
    Route::post('/kids/payment/create', [KidController::class, 'createPayment'])->name('kids_payment_create'); // To'lov qilish
    Route::get('/kid/{id}', [KidController::class, 'show'])->name('kid_show'); // Bola haqida
    Route::get('/moliya', [MoliyaController::class, 'moliya'])->name('moliya'); // Moliya Page
    Route::post('/kids/payment/cancel/{id}', [KidController::class, 'cancelPayment'])->name('kids_payment_cancel'); // To'lov bekor qilish

    
});