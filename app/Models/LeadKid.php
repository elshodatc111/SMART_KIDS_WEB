<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadKid extends Model{
    use HasFactory;
    protected $fillable = [
        'child_full_name',
        'certificate_serial',
        'tkun',
        'gender',
        'parent_full_name',
        'phone1',
        'phone2',
        'address',
        'status',
        'source',
        'admin_note',
    ];
    protected $casts = [
        'child_dob' => 'date',
        'expected_arrival_date' => 'date',
        'status' => 'string',
    ];
}
