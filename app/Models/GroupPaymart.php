<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupPaymart extends Model{

    use HasFactory;
    protected $fillable = [
        'kid_id',
        'group_id',
        'monch',
        'amount',
    ];
    protected function casts(): array{
        return [
            'monch' => 'datetime:Y-m', 
            'amount' => 'decimal:0',
        ];
    }
    public function kid(): BelongsTo{
        return $this->belongsTo(Kid::class);
    }
    public function group(): BelongsTo{
        return $this->belongsTo(Group::class);
    }
}
