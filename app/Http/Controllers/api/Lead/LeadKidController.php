<?php

namespace App\Http\Controllers\api\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kid\StoreKidRequest;
use App\Http\Requests\Kid\StoreKidRequest2;
use App\Http\Requests\Lead\StoreLeadKidRequest;
use App\Http\Requests\Lead\StoreChildEmployeeRequest;
use App\Models\Kid;
use App\Models\LeadKid;
use App\Models\Note;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class LeadKidController extends Controller{

    public function createLeadKids(StoreLeadKidRequest $request){
        $validated = $request->validated();
        $leadKid = LeadKid::create($validated);
        return response()->json([
            'success' => true,
            'message' => __('lead_kid_page.create_lead'),
            'data' => $leadKid
        ], 201);
    }

    public function allLead(){
        $leads = LeadKid::orderBy('id','desc')->get();
        return view('emploes.child_lead',compact('leads'));
    }

    public function createWeb(StoreChildEmployeeRequest $request){
        $data = $request->validated();
        LeadKid::create($data);
        return redirect()->back()->with('success', __('lead_kid_page.create_lead'));
    }

    public function show($id){
        $user = LeadKid::findOrFail($id);
        $notes = Note::where('type','kid_lead')->where('type_id',$id)->orderby('id','desc')->get();
        return view('emploes.child_lead_show',compact('user','notes'));
    }

    public function createEslatmaLeadWebKid(Request $request){
        $request->validate([
            'id'   => 'required|integer|exists:lead_kids,id',
            'text' => 'required|string|max:500',
        ]);
        Note::create([
            'type'     => 'kid_lead',
            'text'     => $request->text,
            'type_id'  => $request->id,
            'admin_id' => auth()->id(),
        ]);
        $user = LeadKid::findOrFail($request->id);
        if ($user->status == 'new') {
            $user->status = 'pending'; // Qiymat berish 
            $user->save();             // Bazaga saqlash
        }
        return redirect()->back()->with('success', __('bolalar_show.create_eslatma'));
    }

    public function cancel(Request $request){
        $request->validate([
            'id'   => 'required|integer|exists:lead_kids,id',
        ]);
        $user = LeadKid::findOrFail($request->id);
        $user->status = 'canceled'; // Qiymat berish 
        $user->save();             // Bazaga saqlash
        return redirect()->back()->with('success', __('lead_kid_page.ariza_bekor_qilindi'));
    }

    public function store(StoreKidRequest2 $request) {
        $data = $request->validated();
        $leadId = $data['id']; 
        unset($data['id']); 
        $data['admin_id'] = auth()->id();
        try {
            $kid = DB::transaction(function () use ($data, $leadId) {
                $leadKid = LeadKid::findOrFail($leadId);
                $leadKid->status = 'success';
                $leadKid->save();
                return Kid::create($data);
            });
            return redirect()->route('kid_show', $kid->id)->with('success', __('bolalar.success1'));
        } catch (\Exception $e) {
            \log::error("Bola saqlashda xato: " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }

}
