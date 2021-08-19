@extends('wayshop/layout/master')
@section('title', 'Product detail') 
@section('content')


<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->


<div class="cart-box-main">
    <div class="container">
        <h1 align="center"> Thanks you   </h1> <br> <br> 
        <div class="row">
            <div class="col-lg-12">
                <div align="center"> 
                    <h2> Your COD order has been placed  </h2>
                    <p> Your order number is {{Session::get('order_id')}} and total is {{Session::get('grand_total')}} </p>
                    
                </div>
            </div>
        </div>

        

    </div>
</div>


@endsection

<?php 
Session::forget('order_id') ;
 Session::forget('grand_total') ;

?>