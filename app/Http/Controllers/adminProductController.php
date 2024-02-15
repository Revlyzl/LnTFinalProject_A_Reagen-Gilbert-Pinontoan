<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class adminProductController extends Controller
{
    //Read Product Function

    public function createProduct(){
        $categories = Category::all();
        return view('createProduct', [
            'title'=>'Create Product Page',
            'page'=> 'Create Product',
            'categories'=>$categories
        ]);
    }

    public function storeProduct(Request $request){
        $request->validate([
            'name' => 'required|min:5|max:80',
            'category_id'=>'required',
            'price'=> 'required',
            'total_product'=> 'required',
            'image'=>'required|mimes:jpg, png, jpeg'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = $request->name.'-'.$request->category_id.'.'.$extension;
        $request->file('image')->storeAs('/public/product_images', $filename);
       
        


        Product::create([
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'price'=>$request->price,
            'total_product'=> $request->total_product,
            'image'=> $filename
        ]);
        //tab utk quick solving/finish
        return redirect('/create-product');
    }

    public function indexProduct(){
        $products = Product::all();
        return view('adminProduct', [
            'title' => 'Product',
            'page'=>'Product',
            'products'=>$products
        ]);
    }

    public function deleteProduct(Product $product){
        $product->delete();
        return redirect('/adminProduct');
    }

    public function editProduct(Product $product){
        $categories = Category::all();
        return view('editProduct', [
            'title' => 'Edit Product',
            'page'=> 'Edit Product',
            'product'=>$product,
            'categories'=>$categories
        ]);
    }

    public function updateProduct(Product $product, Request $request){
        $request->validate([
            'name' => 'required|min:5|max:80',
            'category_id'=>'required',
            'price'=> 'required',
            'total_product'=> 'required',
            'image'=>'required|mimes:jpg, png, jpeg'
        ]);

        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = $request->name.'-'.$request->category_id.'.'.$extension;
        $request->file('image')->storeAs('/public/product_images', $filename);

        $product->update([
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'price'=>$request->price,
            'total_product'=> $request->total_product,
            'image'=> $filename
        ]);

        return redirect('/adminProduct');
    }


}
