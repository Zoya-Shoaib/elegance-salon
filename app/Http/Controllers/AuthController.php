<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin(){
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Direct route based on role
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            } 
            
            if ($role === 'receptionist') {
                return redirect()->route('receptionist.dashboard')->with('success', 'Welcome Receptionist!');
            } 
            
            if ($role === 'stylist') {
                return redirect()->route('stylist.dashboard')->with('success', 'Welcome Stylist!');
            }

            return redirect('/');
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}

