<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginForm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        logger('redirect to google');
        return Socialite::driver('google')
            ->scopes(['profile', 'email'])
            ->redirect();
    }

    public function handleCallBack()
    {
        try {
            $user = Socialite::driver('google')->user();
            //dd($user);
            logger('user',['user' => $user]);
            $findUser = User::where('social_id',$user->id)->first();
            logger('user find',['userfind' => $findUser]);
            //dd($findUser);
            if($findUser)
            {
                logger('user is finded and connected',['findUser' => $findUser]);
                Auth::login($findUser);
                return to_route('dashboard');
            }else{
                $newUser = User::create([
                   'name' => $user->name,
                   'email' => $user->email,
                   'social_id' => $user->id,
                    'social_type' => 'google',
                    'password' => Hash::make('my-google')
                ]);
                logger('user is new', ['newUser'=>$newUser]);
                //dd($newUser);
                Auth::login($newUser);
                return to_route('dashboard');
            }
        }catch (\Exception $e){
            logger($e->getMessage());
        }
    }
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return to_route('pages.auth.register',[
            'user' => $user
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }


    public function doLogin(LoginForm $request)
    {
        logger('Salut');
        $credentials = $request->validated();
        //dd($credentials);
        if (Auth::attempt($credentials)){
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
