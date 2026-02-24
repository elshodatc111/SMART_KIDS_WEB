<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moliya extends Model{

    protected $table = 'moliyas';

    protected $fillable = [
        'cash',
        'card',
        'bank',
        'pending_card',
        'pending_bank',
    ];

    public static function getBox(){
        return self::firstOrCreate(['id' => 1]);
    }
    
}