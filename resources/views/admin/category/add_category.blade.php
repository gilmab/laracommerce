@extends('admin.layout.master') ; 
@section('title', 'Add Category')

@section('content')

<!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>Add category </h1>
                  <small> Add category </small>
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
                              <a class="btn btn-add " href="{{url('admin/view-category')}}"> 
                              <i class="fa fa-eye"></i>  View categories </a>  
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-6"  action="{{url('/admin/category')}}" method="post">  {{ csrf_field() }}
                              <div class="form-group">
                                 <label>Category Name</label>
                                 <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" id="category_name" required>
                              </div>
                              <div class="form-group">
                                 <label>Parent category </label>
                                 <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0" > Parent Category</option>
                                        @foreach ($levels as $val)
                                        <option value="{{$val->id}}" > {{$val->name}}</option>
                                        @endforeach
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Url </label>
                                 <input type="text" class="form-control" placeholder="Url" name="category_url" id="category_url" required>
                              </div>
                              <div class="form-group">
                                 <label>Description </label>
                                <textarea name="category_description" id="category_description" class="form-control"></textarea>
                              </div>
                              <div class="form-group">
                                 <label>Category status</label>
                                 <select name="category_status" id="category_status" class="form-control" >
                                    <option value="0">0 </option>
                                    <option value="1">1 </option>
                                 </select>
                              </div>
                              
                              
                              <div class="reset-button">
                                 <input type="submit" class="btn btn-success" value="Add category">
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


         