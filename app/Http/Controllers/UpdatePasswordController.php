<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UpdatePasswordController extends Controller
{
    public function edit() {
        return view('password.edit');
    }

    public function update(Request $request) {

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);
    
        if (!Hash::check($request->password, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return back()->with('success','Password Updated Successfully');

        }

        throw ValidationException::withMessages([
            'current password' => 'Your current password doesnt match with our record',
        ]);
    }
}
