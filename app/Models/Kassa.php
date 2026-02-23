<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Kassa extends Model{
    protected $table = 'kassas';
    protected $fillable = [
        'naqt',
        'card',
        'bank',
        'pending_naqt',
        'pending_card',
        'pending_bank',
    ];
    public static function getBox(){
        return self::firstOrCreate(['id' => 1]);
    }
    public function getNaqtFormatAttribute(){
        return number_format($this->naqt, 0, '.', ' ');
    }
}
