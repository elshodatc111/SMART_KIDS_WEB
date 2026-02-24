<?php

namespace App\Http\Controllers;

use App\Http\Requests\Moliya\BalansToKassaRequest;
use App\Models\Kassa;
use App\Models\KidPayment;
use App\Models\Moliya;
use App\Models\MoliyaHistory;
use Illuminate\Support\Facades\DB;

class MoliyaController extends Controller{

    public function moliya(){
        $moliya = Moliya::firstOrCreate();
        $pending = KidPayment::where('payment_type', 'payment')->where('payment_status', 'pending')->get();
        $canceled = KidPayment::where('payment_type', 'payment')->where('created_at', '>=', now()->subDays(45))->where('payment_status', 'canceled')->get();
        $moliyaHistory = MoliyaHistory::where('created_at', '>=', now()->subDays(45))->where('status', 'success')->orderBy('id', 'desc')->get();
        return view('moliya.moliya', compact('moliya', 'pending', 'canceled', 'moliyaHistory'));
    }

    public function balansToKassa(BalansToKassaRequest $request){
        $data = $request->validated();  
        return DB::transaction(function () use ($data) {
            $moliya = Moliya::first();
            $balanceColumn = $data['payment_method'];
            $moliya->decrement($balanceColumn, $data['amount']);
            $kassa = Kassa::first();
            $kassa->increment($balanceColumn, $data['amount']); 
            MoliyaHistory::create([
                'type'=>'BalansToKassa',
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'description' => $data['description'],
                'status' => 'success',
                'start_date' => now(),
                'meneger_id' => auth()->id(),
                'end_date' => now(),
                'admin_id' => auth()->id(),
            ]);
            return redirect()->back()->with('success', __('Mablag\' muvaffaqiyatli kassa balansiga o\'tkazildi.'));
        });  
    }

}
