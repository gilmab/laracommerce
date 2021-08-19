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
        <h1 align="center"> Users Orders  </h1> <br> <br> 
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" style="width: 100%"> 
                    <thead>
                        <tr>
                            <th> Order NAME</th>
                            <th> Order SIZE </th>
                            <th> PRICE </th>
                            <th> Grand Total </th>
                            <th> Date  </th>
                            <th>  Action </th>
                         
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            @foreach ($orderDetails->orders as $pro)
                                
                                 
                            <td> {{$pro->product_name}} </td>
                            <td> {{$pro->product_size}} </td>
                            <td> {{$pro->product_price}} </td>
                            <td> {{$pro->product_price}} </td>
                            <td> {{ $pro->created_at}} </td>
                            <td> view details </td>

                            
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>

        

    </div>
</div>


@endsection

<?php 
Session::forget('order_id') ;
 Session::forget('grand_total') ;

?>