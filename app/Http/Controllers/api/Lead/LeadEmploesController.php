<?php

namespace App\Http\Controllers\api\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\StoreLeadEmployeeRequest;
use App\Models\LeadEmployee;
use Illuminate\Http\Request;

class LeadEmploesController extends Controller{
    public function createLeadEmploes(StoreLeadEmployeeRequest $request){
        $data = $request->validated();    
        $lead = LeadEmployee::create($data);
        return response()->json([
            'message' => 'Arizangiz muvaffaqiyatli qabul qilindi!',
            'data' => $lead
        ], 200);
    }
}
