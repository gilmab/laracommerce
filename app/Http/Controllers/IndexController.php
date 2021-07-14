<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category ; 
use App\Banners ; 
use App\Products ; 
class IndexController extends Controller
{
    public function index(){
        $banners = Banners::get() ;
        $categories = Category::with('categories')->where(['parent_id'=>0])->get() ;
        $products = Products::get() ;  
        return view('wayshop.index')->with(compact('banners', 'categories', 'products')) ; 
    }

    public function categories($category_id){
        $categories = Category::with('categories')->where(['parent_id'=>0])->get() ;
        $products = Products::where(['category_id'=>$category_id])->get() ; 
        $product_name = Products::where(['category_id'=>$category_id])->first() ;  
            return view('wayshop.category')->with(compact('categories','products','product_name')) ; 

    }
}
