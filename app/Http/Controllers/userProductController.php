<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class userProductController extends Controller
{
    public function indexProduct(){
        // $products = DB::table('products')->get();
        $products = Product::all();
        // return $product;
        return view('userProduct', [
            'title' => 'Product',
            'page'=>'Product',
            'products'=>$products
        ]);
    }
}
