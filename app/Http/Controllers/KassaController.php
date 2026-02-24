<?php

namespace App\Http\Controllers;

use App\Models\Kassa;
use App\Models\KidPayment;
use Illuminate\Http\Request;

class KassaController extends Controller{

    public function kassa(){
        $kassa = Kassa::select("naqt","card","bank","pending_naqt","pending_card","pending_bank")->firstOrCreate(['id' => 1],['naqt' => 0,'card' => 0,'bank' => 0,'pending_naqt' => 0,'pending_card' => 0,'pending_bank' => 0,]);
        $qaytar = KidPayment::where('payment_type', 'return')->where('created_at', '>=', now()->subDays(45))->orderBy('id', 'desc')->get();
        $chegirma = KidPayment::where('payment_type', 'discount')->where('created_at', '>=', now()->subDays(45))->orderBy('id', 'desc')->get();
        return view('kassa.kassa',compact('kassa','qaytar','chegirma'));
    }
    
}
