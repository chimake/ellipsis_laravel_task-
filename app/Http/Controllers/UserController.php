<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function update()
    {
        $user = auth()->user();    
            
        return view('auth.update', compact('user'));
    }

    public function updateUser(Request $request)
    {
        //  validation first
        // Then
        $user = auth()->user();
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return redirect()->route('update-view')->with('success','Profile Updated Successfully');
    }


    public function updatePassword()
    {
        return view('auth.passwordchange');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('update-password-view')->with('success','Password Updated Successfully');
        
    }
}
