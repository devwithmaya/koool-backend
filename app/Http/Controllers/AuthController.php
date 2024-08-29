<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginForm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json($user);
    }

    public function login()
    {
        //dd('Salut');

        return view('pages.auth.login');
    }
    public function doLogin(LoginForm $request)
    {
        //dd('Salut');
        logger('Salut');
        $credentials = $request->validated();
        //dd($credentials);
        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors([
            "email" => 'Identifiants incorrectes'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Vous êtes bien déconnecté');
    }
}
