<?php

namespace App\Http\Controllers;

use App\Http\Requests\Moliya\BalansToKassaRequest;
use App\Http\Requests\Moliya\KassaPendingRequest;
use App\Http\Requests\Moliya\KassaXarajatRequest;
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
        $moliyaHistory = MoliyaHistory::where('created_at', '>=', now()->subDays(45))->where('status','!=', 'pending')->orderBy('id', 'desc')->get();
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
            return redirect()->back()->with('success', __('kassa.balansdan_kassaga'));
        });  
    }

    public function balansDaromad(BalansToKassaRequest $request){
        $data = $request->validated();  
        return DB::transaction(function () use ($data) {
            $moliya = Moliya::first();
            $balanceColumn = $data['payment_method'];
            $moliya->decrement($balanceColumn, $data['amount']);
            MoliyaHistory::create([
                'type'=>'daromad',
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'description' => $data['description'],
                'status' => 'success',
                'start_date' => now(),
                'meneger_id' => auth()->id(),
                'end_date' => now(),
                'admin_id' => auth()->id(),
            ]);
            return redirect()->back()->with('success', __('kassa.balans_daromad'));
        });  
    }

    public function balansXarajat(BalansToKassaRequest $request){
        $data = $request->validated();  
        return DB::transaction(function () use ($data) {
            $moliya = Moliya::first();
            $balanceColumn = $data['payment_method'];
            $moliya->decrement($balanceColumn, $data['amount']);
            MoliyaHistory::create([
                'type'=>'xarajat',
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'description' => $data['description'],
                'status' => 'success',
                'start_date' => now(),
                'meneger_id' => auth()->id(),
                'end_date' => now(),
                'admin_id' => auth()->id(),
            ]);
            return redirect()->back()->with('success', __('kassa.balans_xarajat'));
        });  
    }

    public function kassaXarajat(KassaXarajatRequest $request){
        $data = $request->validated();  
        return DB::transaction(function () use ($data) {
            $kassa = Kassa::first();
            $balanceColumn = $data['payment_method'];
            if($balanceColumn === 'cash'){
                $kassa->decrement('naqt', $data['amount']);
                $kassa->increment('pending_naqt', $data['amount']);
            } elseif($balanceColumn === 'card'){
                $kassa->decrement('card', $data['amount']);
                $kassa->increment('pending_card', $data['amount']);
            } elseif($balanceColumn === 'bank'){
                $kassa->decrement('bank', $data['amount']);
                $kassa->increment('pending_bank', $data['amount']);
            }
            MoliyaHistory::create([
                'type'=>'xarajat',
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'description' => $data['description'],
                'status' => 'pending',
                'start_date' => now(),
                'meneger_id' => auth()->id(),
            ]);
            return redirect()->back()->with('success', __('kassa.kassadan_xarajat'));
        });
    }

    public function kassaChiqim(KassaXarajatRequest $request){
        $data = $request->validated();  
        return DB::transaction(function () use ($data) {
            $kassa = Kassa::first();
            $balanceColumn = $data['payment_method'];
            if($balanceColumn === 'cash'){
                $kassa->decrement('naqt', $data['amount']);
                $kassa->increment('pending_naqt', $data['amount']);
            } elseif($balanceColumn === 'card'){
                $kassa->decrement('card', $data['amount']);
                $kassa->increment('pending_card', $data['amount']);
            } elseif($balanceColumn === 'bank'){
                $kassa->decrement('bank', $data['amount']);
                $kassa->increment('pending_bank', $data['amount']);
            }
            MoliyaHistory::create([
                'type'=>'KassaToBalans',
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'description' => $data['description'],
                'status' => 'pending',
                'start_date' => now(),
                'meneger_id' => auth()->id(),
            ]);
            return redirect()->back()->with('success', __('kassa.kassadan_chiqim'));
        });
    }

    public function pendingCanceled(KassaPendingRequest $request){
        $data = $request->validated();
        return DB::transaction(function () use ($data) {
            $MoliyaHistory = MoliyaHistory::find($data['id']);
            $amount = $MoliyaHistory->amount;
            $paymentMethod = $MoliyaHistory->payment_method;
            $kassa = Kassa::first();
            if($paymentMethod === 'cash'){
                $kassa->increment('naqt', $amount);
                $kassa->decrement('pending_naqt', $amount);
            } elseif($paymentMethod === 'card'){
                $kassa->increment('card', $amount);
                $kassa->decrement('pending_card', $amount);
            } elseif($paymentMethod === 'bank'){
                $kassa->increment('bank', $amount);
                $kassa->decrement('pending_bank', $amount);
            }
            $MoliyaHistory->update(['status' => 'canceled','end_date' => now(), 'admin_id' => auth()->id()]);
            return redirect()->back()->with('success', __('kassa.pending_canceled'));
        });
    }

    public function pendingSuccess(KassaPendingRequest $request){
        $data = $request->validated();
        return DB::transaction(function () use ($data) {
            $MoliyaHistory = MoliyaHistory::find($data['id']);
            $amount = $MoliyaHistory->amount;
            $paymentMethod = $MoliyaHistory->payment_method;
            $kassa = Kassa::first();
            $moliya = Moliya::first();
            if($paymentMethod === 'cash'){
                if($MoliyaHistory->type === 'KassaToBalans'){
                    $moliya->increment('cash', $amount);
                } 
                $kassa->decrement('pending_naqt', $amount);
            } elseif($paymentMethod === 'card'){
                if($MoliyaHistory->type === 'KassaToBalans'){
                    $moliya->increment('card', $amount);
                } 
                $kassa->decrement('pending_card', $amount);
            } elseif($paymentMethod === 'bank'){
                if($MoliyaHistory->type === 'KassaToBalans'){
                    $moliya->increment('bank', $amount);
                } 
                $kassa->decrement('pending_bank', $amount);
            }
            $MoliyaHistory->update(['status' => 'success', 'end_date' => now(), 'admin_id' => auth()->id()]);
            return redirect()->back()->with('success', __('kassa.pending_success'));
        });
    }


}