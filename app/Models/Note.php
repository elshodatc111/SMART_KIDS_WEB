<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model{
    use HasFactory;
    protected $fillable = [
        'type',
        'text',
        'type_id',
        'admin_id',
    ];
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function kid(): BelongsTo{
        return $this->belongsTo(Kid::class, 'type_id');
    }
    public function kidLead(): BelongsTo{
        return $this->belongsTo(LeadEmployee::class, 'type_id');
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'type_id');
    }
    public function userLead(): BelongsTo{
        return $this->belongsTo(LeadEmployee::class, 'type_id');
    }
/*
    public function group(): BelongsTo{
        return $this->belongsTo(Group::class, 'type_id');
    }
*/
}
