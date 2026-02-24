<?php

namespace App\Http\Controllers;

use App\Models\KidPayment;
use App\Models\Moliya;
use Illuminate\Http\Request;

class MoliyaController extends Controller{
    public function moliya(){
        $moliya = Moliya::firstOrCreate();
        $pending = KidPayment::where('payment_type', 'payment')->where('payment_status', 'pending')->get();
        $canceled = KidPayment::where('payment_type', 'payment')->where('payment_status', 'canceled')->get();
        return view('moliya.moliya', compact('moliya', 'pending', 'canceled'));
    }
}
