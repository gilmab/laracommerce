<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input ; 

use Illuminate\Http\Request;
use App\Products ;
use Image;
use RealRashid\SweetAlert\Facades\Alert;
use App\Category ; 
use App\Productattributes ; 
use DB ; 
use App\Productsimages ; 
use App\Coupons ; 
use Session;

class ProductsController extends Controller

{
    public function addProduct(Request $request){

           if($request->ismethod('post')){
               $data = $request->all() ; 
               //echo "<pre>".print_r($data) ; die() ;
               $product = new Products ; 
               $product->category_id = $data['category_id'] ; 
               $product->name = $data['product_name'] ; 
               $product->code = $data['product_code'] ; 
               $product->color = $data['product_color'] ; 
               if(empty($data['product_description'])){
                $product->description = '' ; 
               }else {
                   $product->description = $data['product_description'] ; 
               }
               $product->price = $data['product_price'] ; 
               // Upload Image Image 
               
               if($request->hasfile('image')){
                   echo $img_tmp = Input::file('image') ; 
                   if($img_tmp->isValid()){
                   //Image path code
                   $extension = $img_tmp->getClientOriginalExtension() ; 
                   $filename = rand(111,99999).'.'.$extension ; 
                   $img_path = 'uploads/products/'.$filename ; 

                    //Image resize 
                    Image::make($img_tmp)->resize(500, 500)->save($img_path) ; 

                    $product->image = $filename ; 
 
               }}
               $product->save() ; 

               return redirect('/admin/view-product')->with('flash_message_success', 'Product has been added') ; 

           }
           $categories = Category::where(['parent_id'=>0])->get() ; 
           $categories_dropdown =  "<option value='' selected disabled> Select </option>" ;
          
           foreach($categories as $cat){
               $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>" ; 
               $sub_categories = Category::where(['parent_id'=>$cat->id])->get() ;
                foreach($sub_categories as $sub_cat){
                    $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>" ; 
                }

           }
            return view('admin.products.add_product')->with(compact('categories_dropdown')) ; 

    }

    public function viewProduct() {

        $product = Products::get() ; 
        return view('admin.products.view_product')->with(compact('product')) ; 
    }

    public function editProduct(Request $request , $id=null ){

           if ($request->ismethod('post')){
               $data = $request->all() ; 
               if($request->hasfile('image')){
                echo $img_tmp = Input::file('image') ; 
                if($img_tmp->isValid()){
                //Image path code
                $extension = $img_tmp->getClientOriginalExtension() ; 
                $filename = rand(111,99999).'.'.$extension ; 
                $img_path = 'uploads/products/'.$filename ; 

                 //Image resize 
                 Image::make($img_tmp)->resize(500, 500)->save($img_path) ; 

                 $product->image = $filename ; 

            }}else{
                $filename = $data['current_image'] ; 
            }
            if(empty($data['product_description'])){
                $data['product_description'] = '' ; 
            }
            Products::where(['id' => $id])
            ->update([
            'name' => $data['product_name'], 
            'category_id' => $data['category_id'],
            'code' => $data['product_code'], 
            'color' => $data['product_color'],
            'description' => $data['product_description'],
            'price' => $data['product_price'],
            'image' => $filename
            ]);

            return redirect('/admin/view-product')->with('flash_message_success', 'Product has been updated') ; 

           }
           
           $productDetails = Products::where(['id' => $id])->first() ; 

           //Category dropdown code 
           $categories = Category::where(['parent_id'=>0])->get() ; 
           $categories_dropdown =  "<option value='' selected disabled> Select </option>" ;
           foreach($categories as $cat ){
               if($cat->id== $productDetails->category_id){
                   $selected = "selected" ; 
               }else {
                   $selected = "" ; 
               }
               $categories_dropdown .= "<option value='".$cat->id."'".$selected.">".$cat->name."</option>" ; 
           }
           // Code for subcategory
           $sub_categories = Category::where(['parent_id' => $cat->id])->get() ; 
           foreach($sub_categories as $sub_cat){
            if($sub_cat->id== $productDetails->category_id){
                $selected = "selected" ; 
            }else {
                $selected = "" ; 
            }
            $categories_dropdown .= "<option value='".$cat->id."'".$seleted.">&nbsp;--nbsp".$cat->name."</option>" ; 
           }
           
            return view('admin.products.edit_product')->with(compact('productDetails', 'categories_dropdown')) ; 
    }

    public function deleteProduct($id=null){
        Products::where(['id' => $id])->delete() ; 
        Alert::success('Deleted Succefully', 'Success Message');
        return redirect()->back()->with('flash_message_success' , 'Product Deleted') ; 
        
    }
    public function updateStatus(Request $request, $id=null){
            $data = $request->all() ; 
            Products::where('id', $data['id'])->update(['status' =>$data['status']]) ; 
    }

    public function products($id=null){
                $productdetails = Products::with('attributes')->where('id',$id)->first() ; 
                $ProductAltimg = Productsimages::where('product_id',$id)->get() ; 
                $Productfeatured = Products::where(['featured_product'=>1])->get() ; 
               // echo $productdetails ; die() ; 
                return view('wayshop.product_detail')->with(compact('productdetails', 'ProductAltimg','Productfeatured')); 
    }

    public function addAttributes($id=null, Request $request){

        $productdetails =  Products::with('attributes')->where('id',$id)->first() ; 
        if($request->isMethod('post')){
                $data = $request->all() ; 
                //echo "<pre>"; print_r($data); die() ; 
                foreach($data['sku'] as $key => $val ){
                    //prevent duplicate SKU record 
                    $attrCountSKU = Productattributes::where('sku',$val)->count() ; 
                    if($attrCountSKU>0){
                        return redirect('/admin/add-attribute/'.$id)->with('flash_message_error', 'SKU was already exist') ; 
                    }

                    $attrCountSizes = Productattributes::where([
                        'product_id'=>$id, 
                        'size'=>$data['size']
                         [$key]
                         ])->count();
                    
                         if($attrCountSizes>0){
                            return redirect('/admin/add-attribute/'.$id)->with('flash_message_error', ''.$data['size'][$key].'Size is already exist please') ; 
                        }
                        $attribute = new Productattributes ; 
                        $attribute->product_id = $id ; 
                        $attribute->sku = $val ; 
                        $attribute->size = $data['size'][$key] ; 
                        $attribute->price = $data['price'][$key] ;
                        $attribute->stock = $data['stock'][$key] ;
                        $attribute->save() ; 


                }

                return redirect('/admin/add-attribute/'.$id)->with('flash_message_success','Product attribute added successfully') ; 
        }
        return  view('admin.products.add_attributes')->with(compact('productdetails')) ; 

    }
    
    public function deleteAttributes($id=null){
        Productattributes::where(['id'=>$id])->delete() ;
        return redirect()->back()->with('flash_message_success','attribute successfully deleted') ; 

    }

    public function addImage(Request $request, $id=null) {
               
                if($request->isMethod('post')){
                    $data = $request->all() ; 
                    if($request->hasFile('image')){
                        $files = $request->file('image') ; 
                        foreach($files as $file){
                            $image = new Productsimages;
                            



               $extension = $file->getClientOriginalExtension() ; 
                $filename = rand(111,9999 ).'.'.$extension ; 
                $img_path = 'uploads/products/'.$filename ; 
                 //Image resize 
                 Image::make($file)->save($img_path) ; 

                $image->image = $filename ; 
                $image->product_id = $data['product_id'] ; 
                $image->save() ; 
                        }
                    }
                    return redirect('admin/add-images/'.$id)->with('flash_message_success', 'Your images is added')  ; 
                }
                $productImages = Productsimages::where(['product_id'=>$id])->get() ; 
                $productdetails = Products::where(['id'=>$id])->first() ; 
                return view('admin.products.add_image')->with(compact('productdetails','productImages')) ;
    }

    public function deletealtimage($id=null){
         $productsImage = Productsimages::where(['id' => $id])->first() ; 

         $image_path = 'uploads/products' ; 
         if(file_exists($image_path.$productsImage->image)){
             unlink($image_path.$productsImage->image) ; 
         }
         Productsimages::where(['id'=>$id])->delete() ; 
         Alert::success('Deleted','Success Message') ; 
         return redirect()->back() ; 

    }

    public function getPrice(Request $request) {
 $data = $request->all() ; //echo "<pre>" ; print_r($data) ; die() ;
 
 $proArr = explode(" ", $data['idSize']); 
 $proAttr = Productattributes::where
 (['product_id'=>$proArr[0], 
 'size' => $proArr[1]])->first(); 
 echo $proAttr->price ;  

    }

public function addtoCart(Request $request) {
    
    $data = $request->all() ; 
   
    $session_id = Session::get('session_id') ; 
   if(empty($session_id)){
    
    $session_id = str_random(40) ;
    Session::put('session_id',$session_id) ; 
   }

   $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],
    'session_id' => $session_id, 'product_name' => $data['product_name']])->count() ; 
 
    if($countProducts>0){
        return redirect()->back()->with('flash_message_error','Product already added') ; 
    }else{

        DB::table('cart')->insert([
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'product_code' => $data['code'],
            'size' => $data['size'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'user_email' => 'popopo',
            'session_id' => $session_id,
            'product_color' => $data['color']
        ]) ; 
        
    }
      return redirect('/cart')->with('flash_message_success', 'Products_has_been_added') ; 
    
}

public function cart(Request $request) {
    
        $session_id = Session::get('session_id') ; 
        $usercart = DB::table('cart')->where(['session_id'=>$session_id])->get() ; 
        foreach($usercart as $key=>$product){
          $productDetails =  Products::where(['id'=> $product->product_id])->first() ; 
          $usercart[$key]->image = $productDetails->image ; 
        }
       // echo "<pre>"; print_r($usercart); die() ; 
        return view('wayshop.products.cart')->with(compact('usercart')) ;
}

public function deletecart($id=null) {
    
    DB::table('cart')->where(['id'=>$id])->delete() ; 
    return redirect('/')->with('flash_message_success', 'Product has been deleted') ; 

}

public function updatequantity($id=null, $quantity=null){
    Session::forget('CouponAmount') ; 
    Session::forget('CouponCode') ; 
    DB::table('cart')->where(['id'=>$id])->increment('quantity', $quantity) ; 
    return redirect('/cart')->with('flash_message_success', 'Product has been deleted') ; 

}

public function applycoupon(Request $request) {
    Session::forget('CouponAmount') ; 
    Session::forget('CouponCode') ; 
            if($request->isMethod('post')){
                $data = $request->all() ; 
               // echo "<pre>".print_r($data) ; die() ; 
               $couponcount = Coupons::where('coupon_code',$data['coupon_code'])->count() ; 
                if($couponcount == 0){
                    return redirect()->back()->with('flash_message_error','Coupon Code does not ') ; 
                }else {
                   // echo 'success '; die() ; 
                   $couponsDetails = Coupons::where('coupon_code', $data['coupon_code'])->first() ; 
                   //Coupons details status 
                   if($couponsDetails->status==0){
                       return redirect()->back()->with('flash_message_error', 'Coupons code is not active ') ; 
                   }
                   //Check expiry date 
                   $expiry_date = $couponsDetails->expiry_date ; 
                   $current_date =  date('Y-m-d') ;
                   if($expiry_date < $current_date){
                       return redirect()->back()->with('flash_message_error','Coupon code is expired '); 
                   }
                    //Coupon is ready for discount
                    $session_id = Session::get('session_id') ; 
                    $usercart = DB::table('cart')->where(['session_id' => $session_id])->get() ; 

                    $total_amount = 0 ;

                    foreach($usercart as $item){
                        $total_amount = $total_amount + ($item->price*$item->quantity);
                        
                    }
                    //Check if coupon amount is fixed or percentage 
                    if($couponsDetails->amount_type=="Fixed"){
                        $couponAmount = $couponsDetails->amount ; 
                    }else {
                        $couponAmount = $total_amount * ($couponsDetails->amount/100) ;
                    }
                    //Add Coupon code in session 
                    Session::put('CouponAmount',$couponAmount) ; 
                    Session::put('CouponCode',$data['coupon_code']) ; 
                    return redirect()->back()->with('flash_message_success','Coupon code is successfully added') ; 
                    


                }
            }
}


public function checkout() {
    return view('wayshop.products.checkout') ; 
}

}
