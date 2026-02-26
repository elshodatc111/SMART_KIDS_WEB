<?php

namespace App\Http\Controllers\api\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\StoreWebEmploesRequest;
use App\Http\Requests\Emploes\SuccessStoreEmployeeLeadRequest;
use App\Http\Requests\Lead\StoreLeadEmployeeRequest;
use App\Models\LeadEmployee;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class LeadEmploesController extends Controller{

    public function createLeadEmploes(StoreLeadEmployeeRequest $request){
        $data = $request->validated();    
        $lead = LeadEmployee::create($data);
        return response()->json([
            'message' => 'Arizangiz muvaffaqiyatli qabul qilindi!',
            'data' => $lead
        ], 200);
    }

    public function allLead(){
        $leads = LeadEmployee::orderBy('id','desc')->get();
        return view('emploes.emploes_lead',compact('leads'));
    }

    public function createLeadWebEmploes(StoreWebEmploesRequest $request){
        $data = $request->validated();    
        LeadEmployee::create($data);
        return redirect()->back()->with('success', 'Yangi Lead saqlandi!');
    }

    public function show($id){
        $user = LeadEmployee::findOrFail($id);
        $notes = Note::where('type','user_lead')->where('type_id',$id)->orderby('id','desc')->get();
        return view('emploes.emploes_lead_show',compact('user','notes'));
    }

    public function createEslatmaLeadWebEmploes(Request $request){
        $request->validate([
            'id'   => 'required|integer|exists:lead_employees,id',
            'text' => 'required|string|max:500',
        ]);
        Note::create([
            'type'     => 'user_lead',
            'text'     => $request->text,
            'type_id'  => $request->id,
            'admin_id' => auth()->id(),
        ]);
        $user = LeadEmployee::findOrFail($request->id);
        if ($user->status == 'new') {
            $user->status = 'pending'; // Qiymat berish
            $user->save();             // Bazaga saqlash
        }
        return redirect()->back()->with('success', __('bolalar_show.create_eslatma'));
    }

    public function emploesLeadCancel(Request $request){
        $request->validate([
            'id'   => 'required|integer|exists:lead_employees,id',
        ]);
        $user = LeadEmployee::findOrFail($request->id);
        $user->status = 'canceled';
        $user->save();
        return redirect()->back()->with('success',"Ariza bekor qilindi");
    }

    public function emploesLeadSuccess(SuccessStoreEmployeeLeadRequest $request) {
        $data = $request->validated();
        try {
            $user = DB::transaction(function () use ($data, $request) {
                $newUser = User::create([
                    'name'            => $data['name'],
                    'phone'           => $data['phone1'],
                    'phone_two'       => $data['phone_two'],
                    'address'         => $data['address'],
                    'amount'          => $data['amount'],
                    'birthday'        => $data['birthday'],
                    'passport_number' => $data['passport_number'],
                    'type'            => $data['type'],
                    'type_about'      => $data['type_about'],
                    'status'          => 'active',
                    'password'        => Hash::make('12345678'),
                ]);
                $lead = LeadEmployee::findOrFail($request->lead_id);
                $lead->status = 'success';
                $lead->save();
                return $newUser;
            });
            return redirect()->route('emploes_show', $user->id)->with('success', 'Xodim muvaffaqiyatli ishga olindi!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
    }
}
