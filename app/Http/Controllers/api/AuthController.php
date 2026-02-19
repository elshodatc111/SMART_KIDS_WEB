<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller{
     
    protected $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    // Login function
    public function login(LoginRequest $request){
        $result = $this->authService->login($request->validated());
        if (!$result['status']) {
            return response()->json([
                'status' => $result['status'],
                'message' => $result['message']
            ], $result['code']);
        }
        return response()->json([
            'status' => true,
            'message' => $result['message'],
            'token' => $result['token'],
            'token_type' => 'Bearer',
            'user' => $result['user']
        ], 200);
    }
    // Logout funksiyasi
    public function logout(Request $request): JsonResponse{
        $this->authService->logout($request->user());
        return response()->json([
            'status' => true,
            'message' => 'Tizimdan chiqdingiz (Token bekor qilindi)'
        ], 200);
    }
    // About me function
    public function me(Request $request): JsonResponse{
        $user = $this->authService->getProfile($request->user());
        return response()->json([
            'status' => true,
            'message' => 'Profil ma\'lumotlari',
            'data' => $user
        ], 200);
    }
    // Update profile function
    public function update(UpdateProfileRequest $request): JsonResponse{
        $user = $this->authService->updateProfile($request->user(), $request->validated());
        return response()->json([
            'status' => true,
            'message' => 'Profil muvaffaqiyatli yangilandi',
            'data' => $user
        ], 200);
    }
    // Change password function
    public function changePassword(ChangePasswordRequest $request): JsonResponse{
        $result = $this->authService->changePassword($request->user(), $request->validated());
        if (!$result['status']) {
            return response()->json([
                'status' => false,
                'message' => $result['message']
            ], 422);
        }
        return response()->json([
            'status' => true,
            'message' => $result['message']
        ], 200);
    }

}
