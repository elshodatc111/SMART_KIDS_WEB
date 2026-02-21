<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadEmployee extends Model{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'phone1',
        'phone2',
        'address',
        'date_of_birth',
        'education_level',
        'education_detail',
        'previous_company',
        'career_objective',
        'expected_salary',
        'lovozim',
        'status',
        'vacance_about',
        'admin_note',
    ];
            
    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
