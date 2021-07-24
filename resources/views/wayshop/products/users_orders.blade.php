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
                            <th> Order ID</th>
                            <th> Ordered Product </th>
                            <th> Payment Method </th>
                            <th> Grand Total </th>
                            <th> Date  </th>
                            <th>  Action </th>
                         
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            @foreach ($orders as $order)
                                
                           <td> {{$order->id}}</td>
                          
                            <td>
                                 @foreach($order->orders as $pro)
                                    <a href="">
                                        {{$pro->product_code}}
                                        ({{$pro->product_qty}})
                                    </a>
                                 @endforeach
                            </td>
                            <td> {{$order->payment_method}} </td>
                            <td> {{$order->grand_total}} </td>
                            <td> {{ $order->created_at}} </td>
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