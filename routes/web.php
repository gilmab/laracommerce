<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});


//Route for user login 
Route::match( ['get','post'] , '/user-login' , 'UsersController@login') ; 


Route::match( ['get','post'] , '/' , 'IndexController@index') ; 
Route::get('/products/{id}', 'ProductsController@products') ; 

Route::get('/categories/{category_id}', 'IndexController@categories') ; 
Route::get('/get-product-price', 'ProductsController@getPrice') ; 
// Route for login register 
Route::get('/login-register','UsersController@userLoginRegister') ;   

//Route for add users registration 
Route::post('/user-registrer' ,'UsersController@register') ;


Route::match(['get','post'],'/user-logout', 'UsersController@logout') ; 

// Route for middleware after front login
Route::group(['middleware' => ['frontlogin']], function(){
  // Route for user account 
  Route::match(['get','post'] , '/account', 'UsersController@account'); 

  Route::match(['get','post'] , '/change-password', 'UsersController@changePassword'); 

  Route::match(['get','post'] , '/change-addresss', 'UsersController@changeAddress'); 

  Route::match(['get','post'] , '/checkout', 'ProductsController@checkout');
  
  Route::match(['get','post'] , '/order-review', 'ProductsController@orderReview'); 

  Route::match(['get','post'] , '/place-order', 'ProductsController@placeorder'); 

  Route::match(['get','post'] , '/thanks', 'ProductsController@Thanks'); 

  Route::match(['get','post'] , '/orders', 'ProductsController@UseOrders'); 


}) ; 


//Route for add to cart 

Route::match(['get','post'],'/add-cart', 'ProductsController@addtoCart') ; 

Route::match(['get','post'],'/cart', 'ProductsController@cart') ; 

//Route for deleting cart product 
Route::get('/cart/delete-product/{id}', 'ProductsController@deletecart') ; 
// Route for update quantity
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updatequantity') ; 

//Apply coupons 

Route::match(['get','post'],'/cart/apply-coupon', 'ProductsController@applycoupon') ;

Route::match( ['get','post'], '/admin' , 'AdminController@login') ; 


Auth::routes(['verify'=>true]);

Route::get('/home', 'IndexController@index')->name('home');

//Route::get('/admin/category', 'CategoryController@viewcat') ; 


Route::group(['middleware' =>['auth']], function(){

    //Categories routes 
    Route::match( ['get', 'post'],'/admin/category' , 'CategoryController@addCategory') ; 

    Route::match(['get', 'post'], '/admin/view-categories' , 'CategoryController@viewCategories') ; 

    Route::match(['get', 'post'], '/admin/edit-categories/{id}' , 'CategoryController@editCategories') ; 

    Route::match(['get', 'post'], '/admin/delete-categories/{id}' , 'CategoryController@deleteCategories') ;
    
    Route::post('/admin/update-category-status', 'CategoryController@updateStatus') ; 

    //Products routes
    Route::match(['get', 'post'], '/admin/dashboard' , 'AdminController@dashboard') ; 

    Route::match(['get', 'post'], '/admin/add-product' , 'ProductsController@addProduct') ; 

    Route::match(['get', 'post'], '/admin/view-product' , 'ProductsController@viewProduct') ; 

    Route::match(['get', 'post'], '/admin/edit-product/{id}' , 'ProductsController@editProduct') ; 

    Route::match(['get', 'post'], '/admin/delete-product/{id}' , 'ProductsController@deleteProduct') ; 

    Route::post('/admin/update-product-status', 'ProductsController@updateStatus') ; 

    // Banners Route 

    Route::match(['get', 'post'], '/admin/banners' , 'BannersController@banners') ; 

    Route::match(['get', 'post'], '/admin/add-banners' , 'BannersController@addBanners') ; 

    Route::match(['get', 'post'], '/admin/edit-banners/{id}' , 'BannersController@editBanners') ; 

    Route::match(['get', 'post'], '/admin/delete-banners/{id}' , 'BannersController@deleteBanners') ; 

    //Products Attribute 

    Route::match(['get', 'post'], '/admin/add-attribute/{id}' , 'ProductsController@addAttributes') ; 

    Route::match(['get', 'post'], '/admin/delete-attribute/{id}' , 'ProductsController@deleteAttributes') ; 

    Route::match(['get', 'post'], '/admin/add-images/{id}' , 'ProductsController@addImage') ; 

    Route::get('/admin/delete-alt-image/{id}', 'ProductsController@deletealtimage') ;

  // Apply coupons 




    //Coupons Route 

    Route::match(['get', 'post'], '/admin/add-coupon' , 'CouponController@addCoupon') ; 

    Route::match(['get', 'post'], '/admin/view-coupon' , 'CouponController@viewCoupon') ; 

    Route::match(['get', 'post'], '/admin/delete-coupons/{id}' , 'CouponController@deleteCoupon') ; 
   


}) ; 

Route::get('/logout' , 'AdminController@logout') ; 
