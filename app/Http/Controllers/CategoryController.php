<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category ; 
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
   
    public function addCategory (Request $request){
        if($request->isMethod('post')){

            $data = $request->all() ; 
            $category = new Category ; 

            $category->name = $data['category_name'] ; 
            $category->parent_id = $data['parent_id'] ; 
            $category->url = $data['category_url'] ; 
            $category->description = $data['category_description'] ; 
            $category->status = $data['category_status'] ; 
            $category->save() ; 
            return redirect('/admin/category')->with('flash_message_success', 'Category added success') ; 
        }
         $levels = Category::where(['parent_id'=>0])->get() ; 
         return view('admin.category.add_category')->with(compact('levels')) ; 
    }


    public function viewCategories(){
        $category = Category::get() ; 
        return view('admin.category.view_category')->with(compact('category')) ; 

    }
    public function editCategories(Request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all() ; 
            Category::where(['id' => $id])->update([
                'name' => $data['category_name'],
                'parent_id' => $data['parent_id'], 
                'description' => $data['category_description'],
                'url' => $data['category_url'], 

            ]) ; 
            return redirect()->back()->with('flash_message_success','Category_updated') ; 
        }
        $leveli = Category::where(['parent_id'=> 0])->get() ; 
        $categoryDetail = Category::where(['id' => $id])->first() ; 
        return view('admin.category.edit_category')->with(compact('leveli','categoryDetail' )) ; 

    }

    public function deleteCategories(Request $request, $id=null){
        Category::where(['id' => $id])->delete() ; 
        Alert::Success('Deleted', 'Success Message') ; 
        return redirect()->back() ; 

    }

    public function updateStatus(Request $request, $id){
            $data = $request->all() ; 
            Category::where(['id' => $id])->update(['status' => $data['status']]) ; 
    }
}
