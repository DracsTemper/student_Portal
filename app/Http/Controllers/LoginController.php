<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
     
         if (!session('logged_in')) {
          return view('login');
        }else{
            return redirect('/students');
        }

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['Invalid credentials']);
        }

        session(['logged_in' => true]);

        return redirect('/students');
    }

    public function logout()
    {
        session()->forget('logged_in');
        return redirect('/login');
    }
}
