<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners ; 
use Illuminate\Support\Facades\Input ;
use RealRashid\SweetAlert\Facades\Alert;
use Image;



class BannersController extends Controller
{
    public function banners(){
        $bannerdetails = Banners::get() ; 
        return view('admin.banner.banners')->with(compact('bannerdetails')) ; 

    }

    public function addBanners(Request $request){
           if($request->isMethod('post')){
               $data = $request->all() ; 
               $banners = new Banners ; 
               $banners->name = $data['banner_name'] ; 
               $banners->textstyle = $data['text_style'] ; 
               $banners->sortorder = $data['banner_sortorder'] ; 
               $banners->content = $data['banner_content'] ; 
               $banners->link = $data['banner_link'] ; 

               if($request->hasfile('image')){
                echo $img_tmp = Input::file('image') ; 
                if($img_tmp->isValid()){
                //Image path code
                $extension = $img_tmp->getClientOriginalExtension() ; 
                $filename = rand(111,99999).'.'.$extension ; 
                $img_path = 'uploads/banners/'.$filename ; 

                 //Image resize 
                 Image::make($img_tmp)    ->save($img_path) ; 

                 $banners->image = $filename ; 

            }}
            $banners->save() ; 
            return redirect('/admin/add-banners')->with('flash_message_success', 'Your Banner is added ') ; 
              

           }
            return view('admin.banner.add_banner') ; 
 
    }

    public function editBanners(Request $request, $id=null ) {
        if($request->isMethod('post')){
            $data = $request->all() ; 

            if($request->hasFile('image')){
                $image_tmp = Input::file('image') ; 
                if($image_tmp->isValid()){
                    //Upload Images after resize
                    $extension = $image_tmp->getClientOriginalExtension() ; 
                    $filename = rand(111,99999).'.'.$extension ; 
                    $banner_path = 'uploads/banners/'.$filename ; 
                    Image::make($image_tmp)->save($banner_path) ; 
                }
            }else if(!empty($data['image'])){
                    $filename = $data['image'] ; 
                }else{
                    $filename = '' ; 
                }

                Banners::where('id',$id)->update([
                    'name'=>$data['banner_name'],
                    'textstyle'=>$data['text_style'],
                    'content'=>$data['banner_content'],
                    'sortorder'=>$data['banner_sortorder'],
                    'link'=>$data['banner_link'],
                    'image' => $filename
                    
                    ]) ; 
                return redirect('/admin/banners')->with('flash_message_success','Banner edited ') ; 
            

        }


        $bannerdetail = Banners::where(['id'=>$id])->first(); 
        return view('admin.banner.edit_banner')->with(compact('bannerdetail')) ; 
 
    }

    public function deleteBanners($id=null){
        Banners::where(['id' => $id])->delete() ; 
        Alert::success('Deleted Succefully', 'Success Message');
        return redirect()->back()->with('flash_message_success' , 'Banners Deleted') ; 

    }
}
