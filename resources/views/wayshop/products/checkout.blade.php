@extends('wayshop/layout/master')
@section('title', 'Product detail') 
@section('content')

<div class="contact-box-main"> 
        <div class="container">
                @if(Session::has('flash_message_error'))
<div class="alert alert-sm alert-danger alert-block" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true"> &times; </span>
</button>
<strong> {!! session('flash_message_error') !!} </strong>
</div>
@endif

@if(Session::has('flash_message_success'))
<div class="alert alert-sm alert-success alert-block" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close">
    <span aria-hidden="true"> &times; </span>
</button>
<strong> {!! session('flash_message_success') !!} </strong>
</div>
@endif
  
  <form action="{{url('/checkout')}}" id="contactForm registerForm" method="POST"> {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                        <div class="contact-form-right">
                                <h2> Billing  </h2>
                              
                                    <div class="row">
                                        <div class="col-md-12"> 
                                                <div class="form-group">
                                                        <input type="text" class="form-control" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif id="billing_name" name="billing_name" required="required" data-error="Please enter your name"> 
                                                        <div class="help-block with-errors"> </div>
                                                </div>
                                         </div>

                                         <div class="col-md-12"> 
                                                <div class="form-group">
                                                        <input type="text" class="form-control" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif id="billing_address" name="billing_address" required="required" data-error="Please enter your name"> 
                                                        <div class="help-block with-errors"> </div>
                                                </div>
                                         </div>

                                         <div class="col-md-12"> 
                                                <div class="form-group">
                                                        <input type="text" class="form-control" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif id="billing_city" name="billing_city" required="required" data-error="Please enter your name"> 
                                                        <div class="help-block with-errors"> </div>
                                                </div>
                                         </div>   

                                         <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif id="billing_state" name="billing_state" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                                <div class="form-group">
                                                        <select name="billing_country"  id="billing_country" class="form-control" >
                                                            <option value="1">Select Country </option>
                                                            @foreach ($countries as $country)
                                            <option value="{{$country->country_name}}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif> {{$country->country_name}} </option>                    
                                                            @endforeach
                                                        </select>
                                                        
                                                </div>
                                            </div> 
									
									<div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="text" class="form-control" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}"  @endif id="billing_pincode" name="billing_pincode" required="required" data-error="Please enter your password"> 
                                                <div class="help-block with-errors"> </div>
                                        </div>
                                    </div> 
									
									<div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="text" class="form-control"  id="billing_mobile" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile }}"  @endif name="billing_mobile" required="required" data-error="Please enter your password"> 
                                                <div class="help-block with-errors"> </div>
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
                        <h2> Shipping   </h2>
                   
                        <div class="row">
                              
                                <div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Shipping name" id="shipping_name" name="shipping_name" required="required" data-error="Please enter your email"> 
                                                <div class="help-block with-errors"> </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Shipping address" id="shipping_address" name="shipping_address" required="required" data-error="Please enter your email"> 
                                                <div class="help-block with-errors"> </div>
                                        </div>
                                    </div>  

                             <div class="col-md-12"> 
                                <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Shipping state" id="shipping_state" name="shipping_state" required="required" data-error="Please enter your email"> 
                                        <div class="help-block with-errors"> </div>
                                </div>
                            </div>  

                         <div class="col-md-12"> 
                            <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shipping city" id="shipping_city" name="shipping_city" required="required" data-error="Please enter your password"> 
                                    <div class="help-block with-errors"> </div>
                            </div>
                        </div> 
						
			<div class="col-md-12"> 
                            <div class="form-group">
                                    <select  name="shipping_country" id="shipping_country" class="form-control" >
                                        <option value="1">Select Country </option>
                                        @foreach ($countries as $country)
                        <option value="{{$country->country_name}}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif> {{$country->country_name}} </option>                    
                                        @endforeach
                                    </select>
                                    
                            </div>
                        </div> 
						
						 <div class="col-md-12"> 
                            <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shipping pincode" id="shipping_pincode" name="shipping_pincode" required="required" data-error="Please enter your password"> 
                                    <div class="help-block with-errors"> </div>
                            </div>
                        </div> 
						
						 <div class="col-md-12"> 
                            <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Shipping mobile" id="shipping_mobile" name="shipping_mobile" required="required" data-error="Please enter your password"> 
                                    <div class="help-block with-errors"> </div>
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
         </form>
        </div>
</div>


@endsection 