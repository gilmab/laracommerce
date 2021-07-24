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
use App\Orders ; 
use Auth ; 
use App\User ;
use App\Country ;   
use App\Coupons ; 
use Session;
use App\OrdersProduct;
use App\DeliveryAddress ; 
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
    Session::forget('CouponAmount') ;
    Session::forget('Coupon') ; 

    $data = $request->all() ; 
    if(empty(Auth::user()->email)){
            $data['user_email'] = '' ; 
    }else {
        $data['user_email'] = Auth::user()->email ;
    }
   
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
        if(Auth::check()){
            $user_email = Auth::user()->email ; 
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get() ; 
        }
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

                    if(Auth::check()){
                        $user_email = Auth::user()->email ; 
                        $usercart = DB::table('cart')->where(['user_email'=>$user_email])->first() ; 
                    }else {
                        $session_id = Session::get('session_id') ; 
                        $usercart = DB::table('cart')->where(['session_id'=> $session_id])->get() ; 
                    }
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


public function checkout(Request $request) {

    $user_id = Auth::User()->id ; 
    $user_email =  Auth::user()->email ; 

    $userDetails = User::find($user_id) ;
    $countries = Country::get() ; 
    // Check if shiiping address exist 
    $ShippingCount = DeliveryAddress::where('user_id', $user_id)->count() ; 
    $shippingDetail = DeliveryAddress::where('user_id', $user_id)->first() ; 
    
    if($ShippingCount > 0){
      $shippingDetail = DeliveryAddress::where('user_id', $user_id)->first() ;
    }
    // Update cart with email 
    $session_id = Session::get('session_id') ; 
    DB::table('cart')->
    where(['session_id'=>$session_id])->update(['user_email'=>$user_email]) ;

    
    if($request->isMethod('post')){
        $data = $request->all() ; 
        //echo "<pre>" ; print_r($data) ; die() ; 
        //Update Users Details
        User::where('id',$user_id)->update([
            'name'=>$data['billing_name'],
            'address' => $data['billing_address'],
            'state' => $data['billing_state'],
            'city' => $data['billing_city'],
            'country' => $data['billing_country'] , 
             'pincode' => $data['billing_pincode'],
             'mobile' => $data['billing_mobile']
            ]) ;
            if($ShippingCount > 0){
           // Updatig shipping address
           DeliveryAddress::where('user_id',$user_id)->update([
                    'name'=>$data['shipping_name'],
                    'address' => $data['shipping_address'],
                    'state' => $data['shipping_state'],
                    'city' => $data['shipping_city'],
                    'country' => $data['shipping_country'] , 
                     'pincode' => $data['shipping_pincode'],
                     'mobile' => $data['shipping_mobile']
                    ]) ;
            } else{
                //New shipping address 
                $shipping = new DeliveryAddress ; 
                $shipping->user_id = $user_id ; 
                $shipping->user_email = $user_email ; 
                $shipping->name = $data['shipping_name'] ; 
                $shipping->address = $data['shipping_address'] ; 
                $shipping->city = $data['shipping_city'] ; 
                $shipping->state = $data['shipping_state'] ; 
                $shipping->country = $data['shipping_country'] ; 
                $shipping->pincode = $data['shipping_pincode'] ; 
                $shipping->mobile = $data['shipping_mobile'] ;
                $shipping->save() ;  

            }
           return redirect()->action('ProductsController@orderReview') ;
    }
    return view('wayshop.products.checkout')->with(compact('userDetails', 'countries')) ; 
}

public function orderReview(){
    $user_id = Auth::User()->id ; 
    $user_email =  Auth::user()->email ; 
    
    $userDetails = User::find($user_id) ;
    $countries = Country::get() ; 
    // Check if shiiping address exist 
    $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get() ; 
    foreach($userCart as $key=>$product){
        $productDetails = Products::where('id', $product->product_id)->first() ; 
        $userCart[$key]->image = $productDetails->image ; 
    }

    $shippingDetail = DeliveryAddress::where('user_id', $user_id)->first() ; 
    return view('wayshop.products.order_review')->with(compact('userDetails', 'countries','shippingDetail','userCart')) ; 
}

public function placeorder(Request $request ){
       if($request->isMethod('post')){
           $user_id = Auth::user()->id ; 
           $user_email = Auth::user()->email ; 
           $data = $request->all() ;  
           
           
           // get shipping detail 
           $shippingdetail = DeliveryAddress::where(['user_email'=> $user_email])->first() ; 
           //echo "<pre>" ; print_r($shippingdetail) ; die() ; 
           //echo "<pre>"; print_r($data) ; die() ;
           
           if(empty(Session::get('CouponCode'))){
               $coupon_code = 'Not Used ' ; 
           }
           if(empty(Session::get('CouponAmount'))){
               $couponAmount = '' ; 
           }else {
               $couponAmount = Session::get('CouponAmoount') ; 

           }

           $order = new Orders ; 
           $order->user_id = $user_id ; 
           $order->user_email = $user_email ;
           $order->name = $shippingdetail->name ;
           $order->address = $shippingdetail->address ; 
           $order->city = $shippingdetail->city ;
           $order->state = $shippingdetail->state ;
           $order->pincode = $shippingdetail->pincode ;
           $order->country = $shippingdetail->country ;
           $order->mobile = $shippingdetail->mobile ;
           $order->shipping_address = $shippingdetail->address ;
           $order->coupon_code = $coupon_code ; 
           $order->coupon_amount =$couponAmount ;
           $order->order_status =  "Now" ; 
           $order->payment_method = $data['paymentMethod'] ;
           $order->grand_total = $data['grand_total'] ; 
           $order->save() ; 
          
           $order_id = DB::getPdo()->lastinsertID() ;

           $catProducts = DB::table('cart')->where(['user_email' => $user_email])->get() ;

           foreach($catProducts as $pro){
               $cartprod = new OrdersProduct ; 
               $cartprod->order_id = $order_id ; 
               
               $cartprod->user_id = $user_id ; 
               $cartprod->product_id = $pro->product_id ; 
               $cartprod->product_code = $pro->product_color ; 
               $cartprod->product_name = $pro->product_name  ;
               $cartprod->product_size = $pro->size; 
               $cartprod->product_price = $pro->price ; 
               $cartprod->product_qty = $pro->quantity ;
               $cartprod->save() ; 


           }

           Session::put('order_id',$order_id) ; 
           Session::put('grand_total',$data['grand_total']) ;
           return redirect('/thanks') ; 
       } 
}

public function Thanks(){
    $user_email = Auth::user()->email ; 
    DB::table('cart')->where('user_email', $user_email)->delete(); 
    return view('wayshop.orders.thanks') ; 
}

}
 