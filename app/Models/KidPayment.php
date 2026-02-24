<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KidPayment extends Model{
    use HasFactory;
    protected $fillable = [
        'kid_id',
        'admin_id',
        'amount',
        'payment_type',
        'payment_method',
        'payment_status',
        'comment',
    ];
    protected function casts(): array{
        return [
            'amount' => 'decimal:0',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function kid(): BelongsTo{
        return $this->belongsTo(Kid::class);
    }
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
