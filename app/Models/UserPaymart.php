<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPaymart extends Model{
    use HasFactory;

    protected $table = 'user_paymarts';

    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'description',
        'admin_id',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getFormattedAmountAttribute(): string{
        return number_format($this->amount, 0, '.', ' ') . " UZS";
    }
}
