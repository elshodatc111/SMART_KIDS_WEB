<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KassaController extends Controller{
    public function kassa(){
        return view('kassa.kassa');
    }
}
