<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function login(array $credentials){
        $user = User::where('phone', $credentials['phone'])
            ->select('id', 'name', 'phone', 'address', 'birthday', 'passport_number', 'type', 'status', 'password')
            ->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return [
                'status' => false,
                'code' => 401,
                'message' => 'Telefon raqami yoki parol xato.'
            ];
        }
        if ($user->status !== 'active') {
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Profilingiz faol emas. Ma\'muriyatga murojaat qiling.'
            ];
        }
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'status' => true,
            'code' => 200,
            'message' => 'Xush kelibsiz!',
            'token' => $token,
            'user' => $user->makeHidden('password')
        ];
    }

    public function logout($user){
        return $user->currentAccessToken()->delete();
    }

    public function getProfile($user){
        return $user->makeHidden(['password', 'remember_token']);
    }

    public function updateProfile($user, array $data){
        $user->update($data);
        return $user->fresh();
    }

    public function changePassword($user, array $data){
        if (!Hash::check($data['current_password'], $user->password)) {
            return [
                'status' => false,
                'message' => 'Amaldagi parol noto\'g\'ri kiritildi.'
            ];
        }
        $user->update([
            'password' => $data['new_password']
        ]);
        $user->tokens()->delete(); 
        return [
            'status' => true,
            'message' => 'Parol muvaffaqiyatli o\'zgartirildi.'
        ];
    }


}