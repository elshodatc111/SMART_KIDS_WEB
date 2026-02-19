<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emploes\StoreEmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
 