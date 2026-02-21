<?php

namespace App\Http\Controllers\api\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreLeadKidRequest;
use App\Http\Requests\Lead\StoreChildEmployeeRequest;
use App\Models\LeadKid;

class LeadKidController extends Controller{

    public function createLeadKids(StoreLeadKidRequest $request){
        $validated = $request->validated();
        $leadKid = LeadKid::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Bola muvaffaqiyatli ro‘yxatga olindi (Lead bosqichi).',
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
        return redirect()->back()->with('success', 'Yangi Lead saqlandi!');
    }

}
