<?php

namespace App\Http\Controllers\api\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreLeadKidRequest;
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

}
