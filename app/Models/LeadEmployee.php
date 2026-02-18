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
        'position_applied',
        'years_of_experience',
        'career_objective',
        'expected_salary',
        'gender',
        'status',
        'admin_note',
        'vacance_about',
        'vacance_about_other',
        'vacance_looking_for',
        'vacance_looking_for_other',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
