<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupons ; 
use DB ; 


class CouponController extends Controller
{
    public function addCoupon(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all() ; 

            $coupon = new Coupons ; 
            $coupon->coupon_code = $data['coupon_code'] ;
            $coupon->amount = $data['coupon_amount'] ; 
            $coupon->amount_type = $data['amount_type'] ; 
            $coupon->expiry_date = $data['expiry_date'] ;
            
            $coupon->save() ; 
            return redirect('/admin/add-coupon') ; 
        }
        return view('admin.coupons.add_coupon') ; 
    }

    public function viewCoupon() {
        $coupons = Coupons::all() ; 
        return view('admin.coupons.view_coupons')->with(compact('coupons')) ; 

    }

    public function deleteCoupon($id=null){
        DB::table('coupons')->where(['id'=>$id])->delete() ; 
        return view('admin.coupons.view_coupons') ; 
    }
    
}
