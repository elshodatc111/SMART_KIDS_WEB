<?php

use App\Http\Controllers\api\Lead\LeadEmploesController;
use App\Http\Controllers\api\Lead\LeadKidController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\Emploes\EmploesDavomadController;
use App\Http\Controllers\EmploesController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KassaController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\KidDavomadController;
use App\Http\Controllers\MoliyaController;
use App\Http\Controllers\ProfileController;

Route::get('lang/{locale}', function ($locale) {if (in_array($locale, ['uz', 'ru'])) {session()->put('locale', $locale);}return redirect()->back();})->name('changeLang');

Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');  // Login page
Route::post('/login', [AuthWebController::class, 'login']); // Login Post

Route::middleware('auth')->group(function () {
    Route::get('/', function () { return view('index'); })->name('home'); // Bosh sahifa
    Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout'); // Logindan chiqish
    Route::get('/emploes', [EmploesController::class, 'index'])->name('emploes');  // Barcha hodimlar
    Route::get('/emploes/show/{id}', [EmploesController::class, 'show'])->name('emploes_show');  // Hodim haqida
    Route::post('/emploes/payment/create', [EmploesController::class, 'createPayment'])->name('emploes_payment_create'); // To'lov qo'shish
    Route::post('/emploes/eslatma/create', [EmploesController::class, 'createEslatma'])->name('emploes_eslatma_create'); // yangi eslatma
    Route::post('/emploes/update', [EmploesController::class, 'updateEmploes'])->name('emploes_update'); // Yangilash
    Route::post('/emploes/password/update', [EmploesController::class, 'updatePassword'])->name('emploes_password_update'); // Parolni yangilash
    Route::post('/emploes/delete', [EmploesController::class, 'emploesDelete'])->name('emploes_delete'); // Parolni yangilash
    Route::get('/emploes/davomad', [EmploesDavomadController::class, 'showDavomad'])->name('emploes_davomad'); // Xodimlar davomadi
    Route::post('/davomad/saqlash', [EmploesDavomadController::class, 'store'])->name('davomad_store');  // Hodimlar davomadini saqlash
    Route::post('/emploes/create', [EmploesController::class, 'store'])->name('emploes_create'); // Yangi hodim qo'shish
    Route::get('/emploes/leads', [LeadEmploesController::class, 'allLead'])->name('emploes_lead'); // Lead barcha Hodim leadlari
    Route::post('/lead/emploes/create', [LeadEmploesController::class, 'createLeadWebEmploes'])->name('emploes_lead_create'); // Yangi xodim lead qo'shish
    Route::get('/emploes/lead/{id}', [LeadEmploesController::class, 'show'])->name('emploes_lead_show'); // Lead barcha Hodim leadlari
    Route::post('/lead/emploes/create/eslatma', [LeadEmploesController::class, 'createEslatmaLeadWebEmploes'])->name('emploes_eslatma_lead_create'); // Yangi eslatma xodim lead qo'shish
    Route::post('/lead/emploes/cancel', [LeadEmploesController::class, 'emploesLeadCancel'])->name('emploes_lead_cancel'); // Arizani bekor qilish
    Route::post('/lead/emploes/success', [LeadEmploesController::class, 'emploesLeadSuccess'])->name('emploes_lead_success'); // Arizani ishga olish

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
    Route::post('/kids/payment/success/{id}', [KidController::class, 'successPayment'])->name('kids_payment_success'); // To'lov tasdiqlash
    Route::post('/moliya/balansToKassa', [MoliyaController::class, 'balansToKassa'])->name('moliya_balans_to_kassa'); // Balans To Kassa
    Route::post('/moliya/balansDaromad', [MoliyaController::class, 'balansDaromad'])->name('moliya_balans_to_daromad'); // daromad
    Route::post('/moliya/balansXarajat', [MoliyaController::class, 'balansXarajat'])->name('moliya_balans_to_xarajat'); // xarajat
    Route::post('/moliya/kassaXarajat', [MoliyaController::class, 'kassaXarajat'])->name('moliya_kassa_xarajat'); // kassa xarajat
    Route::post('/moliya/kassaChiqim', [MoliyaController::class, 'kassaChiqim'])->name('moliya_kassa_chiqim'); // kassa chiqim
    Route::post('/moliya/pending/canceled', [MoliyaController::class, 'pendingCanceled'])->name('moliya_pending_canceled'); // pending canceled
    Route::post('/moliya/pending/success', [MoliyaController::class, 'pendingSuccess'])->name('moliya_pending_success'); // pending success
    Route::get('/groups', [GroupController::class, 'groups'])->name('groups'); // Guruhlar
    Route::post('/groups/create', [GroupController::class, 'GroupStore'])->name('groups_create'); // Create Group
    Route::post('/groups/create/eslatma', [GroupController::class, 'createNote'])->name('groups_create_note'); // Create Group Note
    Route::post('/groups/update', [GroupController::class, 'update'])->name('groups_update'); // Update Group
    Route::get('/groups/show/{id}', [GroupController::class, 'show'])->name('groups_show'); // Show Group
    Route::post('/groups/add/tarbiyachi', [GroupController::class, 'addTarbiyachi'])->name('groups_add_tarbiyachi'); // Add Tarbiyachi to Group
    Route::post('/groups/delete/tarbiyachi', [GroupController::class, 'deleteTarbiyachi'])->name('groups_delete_tarbiyachi'); // Delete Tarbiyachi from Group
    Route::post('/groups/add/kid', [GroupController::class, 'addKid'])->name('groups_add_kid'); // Add Kid to Group
    Route::post('/groups/delete/kid', [GroupController::class, 'deleteKid'])->name('groups_delete_kid'); // Delete Kid from Group
    Route::post('/groups/delete', [GroupController::class, 'deleteGroup'])->name('groups_delete'); // Delete Group
    Route::get('/kids/davomad', [KidDavomadController::class, 'showAllGroups'])->name('kid_davomad_show_all_groups'); // Show All Groups for Kid Davomad
    Route::get('/kids/davomads/{id}', [KidDavomadController::class, 'show'])->name('kid_davomad_show'); // Show Group Davomad
    Route::post('/kids/davomad/store', [KidDavomadController::class, 'storeAttendance'])->name('kid_davomad_store'); // Store Attendance


    
});