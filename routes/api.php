<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\Lead\LeadEmploesController;
use App\Http\Controllers\api\Lead\LeadKidController;
use Illuminate\Support\Facades\Route;

// CREATE LEAD KIDS AND EMPLOYES
Route::prefix('leads')->group(function () {
    Route::post('/employees', [LeadEmploesController::class, 'createLeadEmploes']); 
    Route::post('/kids', [LeadKidController::class, 'createLeadKids']);
});
    
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'me']); // Profilni olish
    Route::put('/auth/update', [AuthController::class, 'update']); // Profilni yangilash
    Route::put('/auth/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
