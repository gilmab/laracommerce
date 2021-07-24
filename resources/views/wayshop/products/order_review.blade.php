@extends('wayshop/layout/master')
@section('title', 'Product detail') 
@section('content')

<div class="contact-box-main"> 
        <div class="container">
                


  
  
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                        <div class="contact-form-right">
                                <h2> Billing  </h2>
                              
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                        {{$userDetails->name}} 
                                            </div>    
                                                
                                         </div>

                                         <div class="col-md-12"> 
                                                <div class="form-group">
                                            {{$userDetails->address}}"  
                                                       
                                                </div>
                                         </div>

                                         <div class="col-md-12"> 
                                                <div class="form-group">
                                                        {{$userDetails->city}}
                                                        
                                                </div>
                                         </div>   

                                         <div class="col-md-12"> 
                                            <div class="form-group">
                                            {{$userDetails->state}}
                                                   
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                                <div class="form-group">
                                                        {{$userDetails->country}}
                                                        
                                                </div>
                                            </div> 
									
									<div class="col-md-12"> 
                                        <div class="form-group">
                                               {{$userDetails->pincode}}
                                                
                                        </div>
                                    </div> 
									
									<div class="col-md-12"> 
                                        <div class="form-group">
                                               {{$userDetails->mobile }}
                                                
                                        </div>
                                    </div> 
									
									
									<div class="col-md-12" style="margin-left:30px ;"> 
                                        <div class="form-group">
                                                <input type="checkbox" class="form-check-input" id="bill_to_ship" name="billing_mobile" data-error="Please enter your password"> 
                                               <label class="form-check-label" for="billtoship"> Shipping address same as billing address </label>
                                        </div>
                                    </div> 
                                    
                                    
                                    </div>
                                  
                       </div>
                                
                        </div>
                  

                
                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2> Shipping  Details </h2>
                   
                        <div class="row">
                              
                                <div class="col-md-12"> 
                                        <div class="form-group">
                                                {{$shippingDetail->name}}
                                        </div>
                                    </div>  

                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            {{$shippingDetail->address}}
                                        </div>
                                    </div>  

                             <div class="col-md-12"> 
                                <div class="form-group">
                                    {{$shippingDetail->state}}
                                </div>
                            </div>  

                         <div class="col-md-12"> 
                            <div class="form-group">
                                {{$shippingDetail->city}}
                            </div>
                        </div> 
						
			<div class="col-md-12"> 
                            <div class="form-group">
                                {{$shippingDetail->country}}
                                    
                            </div>
                        </div> 
						
						 <div class="col-md-12"> 
                            <div class="form-group">
                                {{$shippingDetail->pincode}}
                            </div>
                        </div> 
						
						 <div class="col-md-12"> 
                            <div class="form-group">
                                {{$shippingDetail->pincode}}
                            </div>
                        </div> 
                        
                        <div class="col-md-12">
                            <div class="submit-button text-center"> 
                                    <button class="btn hvr-hover" id="submit" type="submit"> login </button>
                                    <div id="msgSubmit" class="h3 text-center hidden" ></div>
                                    <div class="clearfix"> </div>
                            </div>
                        </div>
                      
                        </div>
                   
                    </div>

                </div> 
            </div>    
         
        </div>
</div>


 <!-- Start Cart  -->
 <div class="cart-box-main">
    <div class="container">
        <div class="row">
            <h1 style="text-align: center; "> Order summary </h1>
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_amount = 0 ;  ?>
                            @foreach($userCart as $cart )
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                <img class="img-fluid" src="{{asset('/uploads/products/'.$cart->image)}}" alt="" />
                            </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                {{$cart->product_name }}
                            </a>
                                </td>
                                <td class="price-pr">
                                    <p> {{ $cart->price }}</p>
                                    <p> Product code {{ $cart->product_code }} | Product size {{ $cart->size }} </p>
                                </td>
                                <td class="quantity-box">
                                  
                                    {{$cart->quantity}}
                                    
                                </td>
                                <td class="total-pr">
                                    <p> $ {{ $cart->quantity*$cart->price }}</p>
                                </td>
                               
                            </tr>
                            
                            <?php $total_amount = $total_amount + ($cart->price*$cart->quantity) ;  ?>
                           @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-lg-12 col-sm-12">
                
                <div class="order-box">
                    <h3></h3>
                    <div class="d-flex">
                        <h3>Your total </h3>
                        <div class="ml-auto font-weight-bold"> $ {{$total_amount}} </div>
                    </div>
                    <div class="d-flex">
                        <h4> Cart Sub total </h4>
                        <div class="ml-auto font-weight-bold"> $ 40 </div>
                       
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Shipping cost  (+) </h4>
                        <div class="ml-auto font-weight-bold"> $ 10 </div>
                    </div>
                   
                    <div class="d-flex">
                        <h4>Coupon discount (-)</h4>
                        <div class="ml-auto font-weight-bold"> 
                          @if(!empty(Session::get('CouponAmount')))
                          $ {{Session::get('CouponAmount')}}
                          @else
                          $ 0
                          @endif
                         </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ {{$grand_total = $total_amount - Session::get('CouponAmount')}} </div>
                    </div>
                    <hr> 
                </div>
            </div>
            
        </div>
 
        <form name="paymentform" id="paymentform" action="{{url('/place-order')}}" method="post"> {{ csrf_field() }}
            <input type="hidden" value="{{$grand_total}}" name="grand_total">
            <hr class="mb-4">
            <div class="title-left">
                    <h3> payemment </h3>
            </div>
            <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" value="cod"  type="radio"  class="custom-control-input cod"> 
                        <label class="custom-control-label" for="crédit"> Cash on delivery  </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="checkbox" id="debit" value="paypal" name="paymentMethod"  class="custom-control-input paypal"   >
                        <label class="custom-control-label" for="debit"> paypal </label>
                    </div>
                    <div class="col-12  d-flex shopping-box">
                        <button type="submit" class="ml-auto btn hvr-hover" onclick="return selectPaymentMethod();" style="color:white;">Place order </button>
                    </div>
            </div>
        
        </form>

    </div>
</div>
<!-- End Cart -->




@endsection  