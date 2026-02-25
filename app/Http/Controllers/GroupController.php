<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller{

    public function groups(){
        $groups = Group::where('status', 'active')->get();
        return view('group.groups', compact('groups'));
    }

    public function GroupStore(StoreGroupRequest $request){
       $data = $request->validated();
       $data['meneger_id'] = auth()->id();
       $data['status'] = 'active';
       Group::create($data);
       return redirect()->route('groups')->with('success', __('groups.request_success'));
    }

    

}
