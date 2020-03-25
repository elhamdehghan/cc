<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{


    use ResetsPasswords;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset()
    {
        request()->validate([
            'token' => 'required',
            'password' => 'required|string|min:8|max:40|confirmed',
        ]);
        $pr = PasswordReset::where('token',request('token'))->first();
        $user = User::where('mobile',$pr->mobile)->first();
        $user->update_password(request('password'));
        return redirect('login');
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset',compact('token'));
    }
}
