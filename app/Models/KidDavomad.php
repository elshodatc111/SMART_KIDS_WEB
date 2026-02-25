<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KidDavomad extends Model{
    use HasFactory;
    protected $table = 'kid_davomads';
    protected $fillable = [
        'group_id',
        'kid_id',
        'attendance_date',
        'status',
        'created_id',
    ];
    protected $casts = [
        'attendance_date' => 'date',
    ];
    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }
    public function kid(): BelongsTo{
        return $this->belongsTo(Kid::class);
    }
    public function creator(): BelongsTo{
        return $this->belongsTo(User::class, 'created_id');
    }
    public function scopeArrived($query){
        return $query->where('status', 'keldi');
    }
    public function scopeAbsent($query){
        return $query->where('status', 'kelmadi');
    }
}
