<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model{
    use HasFactory;

    protected $fillable = [
        'group_name',
        'group_amount',
        'description',
        'meneger_id',
        'status',
    ];

    protected $casts = [
        'group_amount' => 'decimal:0',
    ];

    public function manager(): BelongsTo{
        return $this->belongsTo(User::class, 'meneger_id');
    }
}
