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
                                <h2> Change password  </h2>
                                <form action="{{url('/change-password')}}" id="contactForm registerForm" method="POST"> {{csrf_field()}}
                                    <div class="row">
                                            
                                        <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="hidden" class="form-control" placeholder="Old password" id="old_pwd" name="old_pwd" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div> 

                                         <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Old password" id="current_password" name="current_password" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                     <div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="password" class="form-control" placeholder="New Password" id="new_pwd" name="new_pwd" required="required" data-error="Please enter your password"> 
                                                <div class="help-block with-errors"> </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-12">
                                        <div class="submit-button text-center"> 
                                                <button class="btn hvr-hover" id="submit" type="submit"> Save</button>
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