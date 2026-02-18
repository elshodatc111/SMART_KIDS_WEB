<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\Lead\LeadEmploesController;
use App\Http\Controllers\api\Lead\LeadKidController;
use Illuminate\Support\Facades\Route;

// CREATE LEAD KIDS AND EMPLOYES
Route::prefix('leads')->group(function () {
    Route::post('/employees', [LeadEmploesController::class, 'store']); 
    Route::post('/kids', [LeadKidController::class, 'store']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');