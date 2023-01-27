<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function register(Request $request)
    {   
        $request->validate([
            "name"=>"required|string",
            "email"=>"required|email",
            "password"=>"required|confirmed",
        ]);

        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=> Hash::make($request->password),
        ]);

        return redirect()->route("login")->with('success', "Regristation Successfull! Please Login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required",
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        };

        return back()->with('error', 'Login Failed');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
