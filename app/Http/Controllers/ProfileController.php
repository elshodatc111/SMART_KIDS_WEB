<?php

namespace App\Http\Controllers;

use App\Http\Requests\Emploes\UpdatePasswordProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends Controller{
    public function profile(){
        $user = auth()->user();
        return view('profile.profile_page',compact('user'));
    }
    public function update(UpdatePasswordProfileRequest $request): RedirectResponse{
        $validated = $request->validated();
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        return redirect()->back()->with('success', "Parol yangilandi");
    }
}
