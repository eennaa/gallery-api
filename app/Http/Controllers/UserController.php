<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;


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
                                    ]);
                 
        $user = \App\User::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        
        auth()->login($user);
    }
    
    public function show(Gallery $gallery) {
    {
        $galleries = Gallery::with('user', 'images')
                ->where('user_id', $gallery->user_id)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);

        return response()->json($galleries);
    }
    }
}
