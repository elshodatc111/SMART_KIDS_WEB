<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kid\StoreKidPaymentRequest;
use App\Http\Requests\Kid\StoreKidRequest;
use App\Http\Requests\Kid\UpdateKidRequest;
use App\Models\Kid;
use App\Models\Note;
use Symfony\Component\HttpFoundation\Request;

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

    public function show(int $id){
        $kid = Kid::with('admin')->findOrFail($id);
        $notes = Note::where('type','kid')->where('type_id',$id)->orderby('id','desc')->get();
        return view('kid.show',compact('kid','notes'));
    }
    
    public function kidUpdate(UpdateKidRequest $request){
        $data = $request->validated();
        $kid = Kid::findOrFail($data['id']);
        $kid->update($data);
        return redirect()->back()->with('success', __('bolalar_show.create_child'));
    }

    public function noteCreate(Request $request){
        $request->validate([
            'id'   => 'required|integer',
            'text' => 'required|string|max:500',
        ]);
        Note::create([
            'type'     => 'kid',
            'text'     => $request->text,
            'type_id'  => $request->id,
            'admin_id' => auth()->id(),
        ]);
        return redirect()->back()->with('success', __('bolalar_show.create_eslatma'));
    }

    public function createPayment(StoreKidPaymentRequest $request){
        $data = $request->validated();
        dd($data);
    }


}
