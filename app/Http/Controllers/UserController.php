<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function store(RegisterUsers $request)
    {
        
        $this-> validate(request(), ['first_name' => 'bail|required|max:255',
                                    'last_name' => 'bail|required|max:255',
                                    'email' => 'bail|required|email',
                                    'password' => 'bail|required|min:8|confirmed|regex:/^(?=.*?[0-9])$/',
                                    'password_confirmation' => 'required',
                                    // 'checkbox' =>'required',
                                    ]);
                 
        $user = \App\User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        // $verifyUser = \App\VerifyUser::create([
        //     'user_id' => $user->id,
        //     'token' => str_random(40)
        // ]);
        
        auth()->login($user);

        // return redirect('/login')->withErrors([
        //                             'message' => 'Please check your email account. We sent you verification link']);
    }
}
