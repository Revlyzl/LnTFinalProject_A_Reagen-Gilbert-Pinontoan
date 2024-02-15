<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function indexUser(){
        // $products = DB::table('products')->get();
        $users = User::all();
        // return $product;
        return view('user', [
            'title' => 'User',
            'page'=>'User',
            'users'=>$users
        ]);
    }
}
