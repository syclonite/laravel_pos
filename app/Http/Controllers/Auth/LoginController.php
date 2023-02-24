<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function handle()
    {
        $success = auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], request()->has('remember'));
//        dd($success);
        if($success) {
            return view('backend.layout');
        }
    }

    public function sign_out(){

        auth()->logout();

        return redirect()->route('login');
    }
}
