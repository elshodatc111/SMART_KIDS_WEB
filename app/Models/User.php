<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{

    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'phone_two',
        'address',
        'amount',
        'birthday',
        'passport_number',
        'type',
        'type_about',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'birthday' => 'date', // String emas, Date obyekti sifatida ishlash uchun
            'password' => 'hashed', // Parolni avtomat hash qilish (Laravel 10+)
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function isAdmin(): bool{
        return $this->type === 'admin';
    }

    public function isDirector(): bool{
        return $this->type === 'drektor';
    }

    public function attendances(): HasMany{
        return $this->hasMany(HodimDavomad::class, 'user_id');
    }
    
    public function todayAttendance(){
        return $this->hasOne(HodimDavomad::class, 'user_id')->where('attendance_date', now()->format('Y-m-d'));
    }
}