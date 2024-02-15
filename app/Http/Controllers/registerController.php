<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function register(Request $request){
        return view("register", [
            'title'=>'Register',
            'page'=> 'Register'
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=>'required|min:3|max:40',
            'email'=>'required|email:dns|unique:users',
            'password'=>'required|min:6|max:12',
            'phone'=> 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login');
    }
}
