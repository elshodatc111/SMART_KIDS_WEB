<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kid\StoreKidRequest;
use App\Models\Kid;

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


}
