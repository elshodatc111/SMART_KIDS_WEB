<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HodimDavomad extends Model{
    use HasFactory;
    protected $table = 'hodim_davomads';
    protected $fillable = [
        'user_id',
        'attendance_date',
        'status',
        'created_id',
    ];
    protected $casts = [
        'attendance_date' => 'date',
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, 'created_id');
    }
    public function getStatusClassAttribute(){
        return match($this->status) {
            'keldi' => 'success',
            'kelmadi' => 'danger',
            'kechikdi' => 'warning text-dark',
            default => 'secondary',
        };
    }
}
