<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function createCategory(){
        return view('createCategory',[
            'title'=>'Create Category',
            'page'=>'Create Category'
        ]);
    }

    public function storeCategory(Request $request){
        $request->validate([
            'name'=>'required|min:5|max:80'
        ]);
        Category::create([
            'name'=>$request->name
        ]);

        return redirect('/create-category');
    }

    // public function indexCategory(){
        
    //     return view('GenresIndex', [
    //         'title'=> 'Genres',
    //         'genres'=>Category::all()
    //     ]);
    // }

}
