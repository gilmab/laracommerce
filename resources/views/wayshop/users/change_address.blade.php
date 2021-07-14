@extends('wayshop/layout/master')
@section('title', 'User login') 
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
            <div class="row">
                <div class="col-md-3"> </div>
                <div class="col-md-6">
                        <div class="contact-form-right">
                                <h2> Change address  </h2>
                                <form action="{{url('/change-addresss')}}" id="contactForm registerForm" method="POST"> {{csrf_field()}}
                                    <div class="row">
                                            

                                         <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$userDetails->name}}" id="name" name="name" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$userDetails->address}}" id="address" name="address" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$userDetails->city}}" id="city" name="city" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control"value="{{$userDetails->state}}" id="state" name="state" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <select name="country" id="country" class="form-control"> 
                                                        <option value="1"> Select country </option>
                                                        @foreach($countries as $country )
                                                        <option value="{{$country->country_name}}">{{$country->country_name}} </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>  

                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" value="{{$country->pincode}}" id="pincode" name="pincode" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div> 

                                     <div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Your mobile phone" id="mobile" name="mobile" required="required" data-error="Please enter your password"> 
                                                <div class="help-block with-errors"> </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-12">
                                        <div class="submit-button text-center"> 
                                                <button class="btn hvr-hover" id="submit" type="submit"> Change address </button>
                                                <div id="msgSubmit" class="h3 text-center hidden" ></div>
                                                <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                  
                                    </div>
                                </form>
                        </div>
                </div>    

                <div class="col-md-3"> </div>
                
            </div>    
        
        </div>
</div>

@endsection 