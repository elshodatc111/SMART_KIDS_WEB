<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kid\StoreKidPaymentRequest;
use App\Http\Requests\Kid\StoreKidRequest;
use App\Http\Requests\Kid\UpdateKidRequest;
use App\Models\Kassa;
use App\Models\Kid;
use App\Models\KidPayment;
use App\Models\Moliya;
use App\Models\MoliyaHistory;
use App\Models\Note;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KidController extends Controller{

    public function kids(){
        $query = Kid::query();
        if (request()->has('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('child_full_name', 'like', "%{$search}%")
                ->orWhere('certificate_serial', 'like', "%{$search}%")->where('status','!=','delete');
            });
        }
        $kids = $query->orderBy('id', 'desc')->where('status','!=','delete')->paginate(25);
        return view('kid.kids', compact('kids'));
    }

    public function store(StoreKidRequest $request){
        $data = $request->validated();
        $data['admin_id'] = auth()->id();
        Kid::create($data);
        return redirect()->back()->with('success', __('bolalar.success1'));
    }

    public function show(int $id){
        $kid = Kid::with('admin')->findOrFail($id);
        $notes = Note::where('type','kid')->where('type_id',$id)->orderby('id','desc')->get();
        $paymarts = KidPayment::where('kid_id', $id)->orderby('id','desc')->get();
        return view('kid.show',compact('kid','notes','paymarts'));
    }
    
    public function kidUpdate(UpdateKidRequest $request){
        $data = $request->validated();
        $kid = Kid::findOrFail($data['id']);
        $kid->update($data);
        return redirect()->back()->with('success', __('bolalar_show.create_child'));
    }

    public function noteCreate(Request $request){
        $request->validate([
            'id'   => 'required|integer',
            'text' => 'required|string|max:500',
        ]);
        Note::create([
            'type'     => 'kid',
            'text'     => $request->text,
            'type_id'  => $request->id,
            'admin_id' => auth()->id(),
        ]);
        return redirect()->back()->with('success', __('bolalar_show.create_eslatma'));
    }

    public function createPayment(StoreKidPaymentRequest $request){
        $data = $request->validated();
        if($data['payment_type'] == 'payment'){
            $this->createTypePayment($data);
        }elseif($data['payment_type'] == 'return'){
            $this->createTypeReturn($data);
        }else{
            $this->createTypeDiscount($data);
        }
        return redirect()->back()->with('success', "To'lov saqlanildi");
    }

    protected function createTypePayment($data){
        return DB::transaction(function () use ($data) {
            if($data['payment_method'] === 'cash'){
                $kid = Kid::lockForUpdate()->findOrFail($data['kid_id']);
                $kid->increment('amount', $data['amount']);
                Kassa::first()->increment('naqt', $data['amount']);
            }else{
                $moliya = Moliya::firstOrCreate();
                if ($data['payment_method'] === 'card') {
                    $moliya->increment('pending_card', $data['amount']);
                } elseif ($data['payment_method'] === 'bank') {
                    $moliya->increment('pending_bank', $data['amount']);
                }
            }
            return KidPayment::create([
                'kid_id'         => $data['kid_id'],
                'payment_type'   => $data['payment_type'],
                'payment_method' => $data['payment_method'],
                'amount'         => $data['amount'],
                'payment_status' => $data['payment_method'] === 'cash' ? 'success' : 'pending',
                'comment'        => $data['comment'] ?? 'To\'lov qo\'shildi',
                'admin_id'       => auth()->id(),
            ]);
        });
    }

    protected function createTypeReturn($data){
        return DB::transaction(function () use ($data) {
            $kid = Kid::lockForUpdate()->findOrFail($data['kid_id']);
            $kid->decrement('amount', $data['amount']);
            $kassa = Kassa::first();
            if($data['payment_method'] === 'cash'){
                $kassa->decrement('naqt', $data['amount']);
            }elseif($data['payment_method'] === 'card'){
                $kassa->decrement('card', $data['amount']);
            }else{
                $kassa->decrement('bank', $data['amount']);
            }
            return KidPayment::create([
                'kid_id'         => $kid->id,
                'payment_type'   => 'return',
                'payment_method' => $data['payment_method'],
                'amount'         => $data['amount'],
                'payment_status' => 'success',
                'comment'        => $data['comment'] ?? 'Pul qaytarildi',
                'admin_id'       => auth()->id(),
            ]);
        });
    }

    protected function createTypeDiscount($data){
        return DB::transaction(function () use ($data) {
            $kid = Kid::lockForUpdate()->findOrFail($data['kid_id']);
            $kid->increment('amount', $data['amount']);
            return KidPayment::create([
                'kid_id'         => $kid->id,
                'payment_type'   => 'discount',
                'payment_method' => $data['payment_method'],
                'amount'         => $data['amount'],
                'payment_status' => 'success',
                'comment'        => $data['comment'] ?? null,
                'admin_id'       => auth()->id(),
            ]);
        });
    }

    public function cancelPayment(int $id){
        $payment = KidPayment::findOrFail($id);
        if($payment->payment_status === 'canceled'){
            return redirect()->back()->with('error', "To'lov allaqachon bekor qilingan");
        }
        DB::transaction(function () use ($payment) {
            $payment->update(['payment_status' => 'canceled']);
            if($payment->payment_method === 'card'){
                Moliya::first()->decrement('pending_card', $payment->amount);
            }else{
                Moliya::first()->decrement('pending_bank', $payment->amount);
            }
            $payment->payment_status = 'canceled';
            $payment->comment = $payment->comment." (".auth()->user()->name.")";   
            $payment->save();
        });
        return redirect()->back()->with('success', "To'lov bekor qilindi");
    }

    public function successPayment(int $id){
        $payment = KidPayment::findOrFail($id);
        if($payment->payment_status === 'success'){
            return redirect()->back()->with('error', "To'lov allaqachon tasdiqlangan");
        }
        DB::transaction(function () use ($payment) {
            $payment->update(['payment_status' => 'success']);
            if($payment->payment_method === 'card'){
                Moliya::first()->decrement('pending_card', $payment->amount);
                Moliya::first()->increment('card', $payment->amount);
            }else{
                Moliya::first()->decrement('pending_bank', $payment->amount);
                Moliya::first()->increment('bank', $payment->amount);
            }
            $kid = Kid::lockForUpdate()->findOrFail($payment->kid_id);
            $kid->increment('amount', $payment->amount);
            $payment->comment = $payment->comment." (".auth()->user()->name.")";   
            $payment->save();
            MoliyaHistory::create([
                'type' => 'tulov',
                'amount' => $payment->amount,
                'payment_method' => $payment->payment_method,
                'description' => $payment->comment,
                'status' => 'success',
                'start_date'=> now(),
                'meneger_id' => auth()->id(),
                'end_date' => now(),
                'admin_id' => auth()->id(),
            ]);
        });
        return redirect()->back()->with('success', "To'lov tasdiqlandi");
    }

}
