<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoliyaHistory extends Model{
    use HasFactory;
    protected $fillable = [
        'type',
        'amount',
        'payment_method',
        'description',
        'status',
        'start_date',
        'meneger_id',
        'end_date',
        'admin_id',
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:0',
    ];
    public function meneger(): BelongsTo{
        return $this->belongsTo(User::class, 'meneger_id');
    }
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
}
