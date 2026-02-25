<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupKid extends Model{
    use HasFactory;
    protected $table = 'group_kids';
    protected $fillable = [
        'group_id',
        'kid_id',
        'status',
        'description',
        'start_date',
        'start_admin_id',
        'end_date',
        'end_admin_id',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
    
    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }
    
    public function kid(): BelongsTo{
        return $this->belongsTo(Kid::class);
    }

    public function startAdmin(): BelongsTo{
        return $this->belongsTo(User::class, 'start_admin_id');
    }

    public function endAdmin(): BelongsTo{
        return $this->belongsTo(User::class, 'end_admin_id');
    }


    public function scopeActive($query){
        return $query->where('status', 'active');
    }

}

