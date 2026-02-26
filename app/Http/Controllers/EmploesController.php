<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emploes\StoreEmployeeRequest;
use App\Http\Requests\Emploes\StoreUserPaymentRequest;
use App\Http\Requests\Emploes\UpdateEmployeeRequest;
use App\Models\GroupUser;
use App\Models\HodimDavomad;
use App\Models\Kassa;
use App\Models\MoliyaHistory;
use App\Models\Note;
use App\Models\User;
use App\Models\UserPaymart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


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
        $notes = Note::where('type','user')->where('type_id',$id)->get();
        return view('emploes.show', compact('user', 'davomad', 'guruhlari', 'userPaymart','notes'));
    }

    public function createEslatma(Request $request){
        $request->validate([
            'id' => 'required|exists:groups,id',
            'text' => 'required|string|max:255',
        ]);
        Note::create([
            'type' => 'user',
            'type_id' => $request->id,
            'text' => $request->text,
            'admin_id' => auth()->id(),
        ]);
        return redirect()->back()->with('success', __('groups.note_added_successfully'));
    }

    public function updateEmploes(UpdateEmployeeRequest $request){
        $data = $request->validated();
        $user = User::findOrFail($request->user_id);
        $user->update($data);
        return redirect()->back()->with('success', __('emploes_page.xodim_malumotlari_yangilandi'));
    }

    public function updatePassword(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make('password');
        $user->save();
        return redirect()->back()->with('success', __('emploes_page.parol_yangilandi_success'));
    }

    public function emploesDelete(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $user = User::findOrFail($request->user_id);
                $user->status = 'delete';
                $user->save();
                $userGroup = GroupUser::where('user_id', $request->user_id)->where('status', 'active')->first();
                if ($userGroup) {
                    $userGroup->status = 'deleted'; // "=" ishlatiladi, "==" emas
                    $userGroup->end_date = Carbon::now();
                    $userGroup->end_admin_id = auth()->id();
                    $userGroup->save(); 
                }
            });
            return redirect()->route('emploes')->with('success', __('emploes_page.xodim_ochirildi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
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
 