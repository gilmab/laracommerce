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
                <div class="col-lg-5 col-sm-12">
                        <div class="contact-form-right">
                                <h2> New User Signup  </h2>
                                <form action="{{url('/user-registrer')}}" id="contactForm registerForm" method="POST"> {{csrf_field()}}
                                    <div class="row">
                                         <div class="col-md-12"> 
                                                <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required="required" data-error="Please enter your name"> 
                                                        <div class="help-block with-errors"> </div>
                                                </div>
                                         </div>   

                                         <div class="col-md-12"> 
                                            <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Your email" id="email" name="email" required="required" data-error="Please enter your email"> 
                                                    <div class="help-block with-errors"> </div>
                                            </div>
                                        </div>  

                                     <div class="col-md-12"> 
                                        <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required" data-error="Please enter your password"> 
                                                <div class="help-block with-errors"> </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-12">
                                        <div class="submit-button text-center"> 
                                                <button class="btn hvr-hover" id="submit" type="submit">Signup </button>
                                                <div id="msgSubmit" class="h3 text-center hidden" ></div>
                                                <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                  
                                    </div>
                                </form>
                        </div>
                </div>    

                <div class="col-lg-1 col-sm-12" id="or">
                        OR
                </div> 

                <div class="col-lg-6 col-sm-12">
                    <div class="contact-form-right">
                        <h2> Already member  just signup here  </h2>
                    <form action="{{url('/user-login')}}" method="POST" id="contactForm LoginForm"> {{csrf_field()}}
                        <div class="row">
                              

                             <div class="col-md-12"> 
                                <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your email" id="email" name="email" required="required" data-error="Please enter your email"> 
                                        <div class="help-block with-errors"> </div>
                                </div>
                            </div>  

                         <div class="col-md-12"> 
                            <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required" data-error="Please enter your password"> 
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
                    </form>
                    </div>

                </div> 
            </div>    
        
        </div>
</div>

@endsection 