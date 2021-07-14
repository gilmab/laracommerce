@extends('wayshop/layout/master')
@section('title', 'Product detail') 
@section('content')

 <!-- Start All Title Box -->
 <div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2> Product Name : {{ $productdetails->name }}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active"> {{ $productdetails->name }} </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

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

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach( $ProductAltimg as $key=>$image  )
                        <div class="carousel-item {{ $key==0 ? 'active' : ''}}"> 
                            <img class="d-block w-100" src="{{asset('/uploads/products/'.$image->image ) }}" alt="First slide"> 
                        </div>
                        @endforeach
                    
                <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span> 
                </a>
                     
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                    <i class="fa fa-angle-right" aria-hidden="true"></i> 
                    <span class="sr-only">Next</span> 
                </a>
               </div>
                    <ol class="carousel-indicators">
                        @foreach($ProductAltimg as $key=>$image)
                        <li data-target="#carousel-example-1" data-slide-to="{{$key}}" class="{{ $key==0 ? 'active' : ''}}">
                            <img class="d-block w-100 img-fluid" src="{{asset('/uploads/products/'.$image->image ) }}" alt="" />
                        </li>
                        @endforeach
                        
                        
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <form name="addtoCart"  action="{{url('/add-cart')}}"  method="post"> {{ csrf_field()}}
                    @method('post')
                <div class="single-product-details">
                    <input type="hidden" value="{{ $productdetails->id }}" name="product_id">
                    <input type="hidden" value="{{ $productdetails->name }}" name="product_name">
                    <input type="hidden" value="{{ $productdetails->color }}" name="color">
                    <input type="hidden" value="{{ $productdetails->code }}" name="code">
                    <input type="hidden" id="price" value="{{ $productdetails->price }}" name="price">


                    <h2> Product Name: {{ $productdetails->name }} </h2>
                    <h5 id="getPrice"> :Product price: {{ $productdetails->price }} </h5>
                    
                        <p>
                            <h4>Short Description:</h4>
                            <p> {{ $productdetails->description }} </p>
                            <ul> 
                                <li>
                                    <div class="form-group size-st">
                                        <label class="size-label">Size</label>
                             <select id="selSize" name="size" class="selectpicker show-tick form-control">
                                <option value="0">Size</option>
                                @foreach($productdetails->attributes as $sizes )
                                    <option value="{{$productdetails->id}}--{{$sizes->size}}"> {{ $sizes->size }} </option>
                                @endforeach
                            </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" name="quantity" value="0" min="0" max="20" type="number">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    
                                    <button class="btn hvr-hover" data-fancybox-close="" type="submit" style="color:white">Add to cart</button>
                                </div>
                            </div>

                            <div class="add-to-btn">
                                <div class="add-comp">
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                                </div>
                                <div class="share-bar">
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                    <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                </div>
                            </div>
                
                        </div>

                    </form>
                    </div>
 
        
        
                </div>

        <div class="row my-5">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Featured Products</h1>
                    
                </div>
                <div class="featured-products-box owl-carousel owl-theme">
                    @foreach($Productfeatured as $feat)
                    <div class="item">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <img src="{{asset('/uploads/products/'.$feat->image ) }}" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                    </ul>
                                    <a class="cart" href="#">Add to Cart</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4> {{$feat->name }} </h4>
                                <h5> {{ $feat->price }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-01.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-02.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-03.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-04.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-05.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-06.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-07.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-08.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-09.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="images/instagram-img-05.jpg" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->
 


@endsection 