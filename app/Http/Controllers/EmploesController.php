<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emploes\StoreEmployeeRequest;
use App\Http\Requests\Emploes\StoreUserPaymentRequest;
use App\Models\GroupUser;
use App\Models\HodimDavomad;
use App\Models\Kassa;
use App\Models\MoliyaHistory;
use App\Models\User;
use App\Models\UserPaymart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmploesController extends Controller{
    public function index(){
        $users = User::where('id', '!=', auth()->user()->id)->where('status', '!=', 'delete')->get();
        return view('emploes.emploes', compact('users'));
    }
    public function store(StoreEmployeeRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make('password');
        $data['name'] = mb_strtoupper($data['name'], 'UTF-8');
        User::create($data);
        return redirect()->back()->with('success', __('emploes_page.success'));
    }

    public function show($id){
        $user = User::findOrFail($id);
        $davomad = HodimDavomad::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        $guruhlari = GroupUser::where('user_id', $id)->orderBy('id', 'desc')->get();
        $userPaymart = UserPaymart::where('user_id', $id)->get();
        return view('emploes.show', compact('user', 'davomad', 'guruhlari', 'userPaymart'));
    }

    public function createPayment(StoreUserPaymentRequest $request){
        $data = $request->validated();
        $user = User::findOrFail($data['user_id']);
        $adminId = auth()->id();
        $methodMapping = [
            'cash' => 'naqt',
            'card' => 'card',
            'bank' => 'bank'
        ];
        $kassaMethod = $methodMapping[$data['payment_method']];
        try {
            DB::transaction(function () use ($data, $user, $adminId, $kassaMethod) {
                UserPaymart::create([
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'payment_method' => $data['payment_method'],
                    'description' => $data['description'] ?? '',
                    'admin_id' => $adminId,
                ]);
                Kassa::where('id', '>', 0)->first()->decrement($kassaMethod, $data['amount']);
                MoliyaHistory::create([
                    'type' => 'ish_haqi', // Xarajat turi
                    'amount' => $data['amount'],
                    'payment_method' => $data['payment_method'],
                    'description' => __('emploes_page.xodimga_ish_haqi') . $user->name . " | " . ($data['description'] ?? ''),
                    'status' => 'success',
                    'start_date' => now(),
                    'end_date' => now(),
                    'meneger_id' => $adminId,
                    'admin_id' => $adminId,
                ]);
            });
            return redirect()->back()->with('success', __('emploes_page.paymart_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Xatolik yuz berdi: " . $e->getMessage());
        }
    }
}
 