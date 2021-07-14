@extends('admin.layout.master') ; 
@section('title', 'Edit Banner')

@section('content')

<!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-image"></i>
               </div>
               <div class="header-title">
                  <h1>Edit Banner</h1>
                  <small> Edit Banner </small>
               </div>
            </section>
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
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonlist"> 
                              <a class="btn btn-add " href="{{url('/admin/banners')}}"> 
                              <i class="fa fa-eye"></i>  View Banner </a>  
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-6" enctype="multipart/form-data" action="{{url('/admin/edit-banners/'.$bannerdetail->id)}}" method="post">  {{ csrf_field() }}
                              
                              <div class="form-group">
                                 <label>Product Name</label>
                                 <input type="text" class="form-control" value="{{ $bannerdetail->name }}" name="banner_name" id="product_name" required>
                              </div>
                              <div class="form-group">
                                 <label>Product  Code </label>
                                 <input type="text" class="form-control" value="{{ $bannerdetail->textstyle }}" name="text_style" id="product_code" required>
                              </div>
                              <div class="form-group">
                                 <label> Banner Content </label>
                                 <textarea class="form-control" name="banner_content" id="content" required> 
                                    {{ $bannerdetail->textstyle }}
                                 </textarea>
                              </div>
                              <div class="form-group">
                                 <label>Link  </label>
                                <input type="text" class="form-control" value="{{ $bannerdetail->link }}" name="banner_link" id="banner_link">
                              </div>
                             
                              <div class="form-group">
                                 <label>Sort order  </label>
                                 <input type="text" class="form-control" value="{{ $bannerdetail->sortorder }}" name="banner_sortorder" required>
                              </div>
                              
                              <div class="form-group">
                                <label>Picture upload</label>
                                <input type="file" name="image">
                                <input type="hidden" name="current_image" value="{{$bannerdetail->image}}">
                                @if(!empty($bannerdetail->image))
                                <img src="{{asset('/uploads/banners/'.$bannerdetail->image )}}" style="width: 100px; margin-top:15px;">
                                @endif
                                
                             </div>
                              
                              <div class="reset-button">
                                 <input type="submit" class="btn btn-success" value="Edit Banner">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
        

@endsection


         