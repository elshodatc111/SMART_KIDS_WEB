<?php

namespace App\Http\Controllers;

use App\Models\Kassa;
use Illuminate\Http\Request;

class KassaController extends Controller{

    public function kassa(){
        $kassa = Kassa::select("naqt","card","bank","pending_naqt","pending_card","pending_bank")->firstOrCreate(['id' => 1],['naqt' => 0,'card' => 0,'bank' => 0,'pending_naqt' => 0,'pending_card' => 0,'pending_bank' => 0,]);
        return view('kassa.kassa',compact('kassa'));
    }
    
}
