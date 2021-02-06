<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:6'
        ]);

        if (Auth::attempt($validator)) {
            if(Auth::user()->status == 0){
              Auth::guard('web')->logout();
              return redirect()->route('login')->withError('Your account was banned ');
            }
            return redirect('/dashboard');
        }else{
            return redirect()->route('login')->withErrors('Invalid credentials');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with(['success' => 'Logout Successfully']);
    }
}
