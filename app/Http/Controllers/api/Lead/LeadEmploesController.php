<?php

namespace App\Http\Controllers\api\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Emploes\StoreWebEmploesRequest;
use App\Http\Requests\Lead\StoreLeadEmployeeRequest;
use App\Models\LeadEmployee;

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

}
