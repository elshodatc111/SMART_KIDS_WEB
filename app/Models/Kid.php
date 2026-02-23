<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kid extends Model{

    protected $fillable = [
        'child_full_name',
        'certificate_serial',
        'tkun',
        'gender',
        'parent_full_name',
        'phone1',
        'phone2',
        'address',
        'amount',
        'status',
        'payment_month',
        'admin_note',
        'admin_id',
    ];

    protected $casts = [
        'tkun' => 'date',
        'status' => 'string',
    ];
    
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getAgeAttribute(){
        return $this->tkun->age;
    }
}
