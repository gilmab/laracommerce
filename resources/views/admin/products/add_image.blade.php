@extends('admin.layout.master') ; 
@section('title', 'Add Images ')

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
                  <h1> Products Attributes </h1>
                  <small> Add Products Images </small>
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
                              <a class="btn btn-add " href="{{url('admin/view-product')}}"> 
                              <i class="fa fa-eye"></i>  View product </a>  
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-6" enctype="multipart/form-data" action="{{url('/admin/add-images/'.$productdetails->id)}}" method="post">  {{ csrf_field() }}
                            
                            <input type="hidden" name="product_id" value="{{ $productdetails->id }}">

                              <div class="form-group">
                                 <label>Product Name</label> {{ $productdetails->name }}       
                              </div>
                              
                              <div class="form-group">
                                <label>Product Name</label> {{ $productdetails->name }}       
                             </div>

                             <div class="form-group">
                                <label> Images </label>
                                <input type="file" name="image[]" id="image" multiple="multiple">
                             </div>
                              
                             
                            
                        
                              
                              <div class="reset-button">
                                 <input type="submit" class="btn btn-success" value="Add Images">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->







        
         <!-- View for product attributes  -->



        
 </div>
 <!-- /.content-wrapper -->



 
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-product-hunt"></i>
               </div>
               <div class="header-title">
                  <h1>View product</h1>
                  <small>View Product </small>
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
        
                <div id="message_success" style="display:none" class="alert alert-sm alert-success"> Status Enabled</div>                              
                 <div id="message_error" style="display:none" class="alert alert-sm alert-danger"> Status Disabled</div>
        
            <!-- Main content -->
            
        
            <section class="content">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="panel panel-bd lobidrag">
                         <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                               <a href="#">
                                  <h4> View Attributes pProduct </h4>
                               </a>
                            </div>
                         </div>
                         <div class="panel-body">
                         <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                               <div class="buttonexport" id="buttonlist"> 
                                  <a class="btn btn-add" href="{{url('/admin/add-product')}}"> <i class="fa fa-plus"></i> Add Product
                                  </a>  
                               </div>
                              
                            </div>
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="table-responsive">
                               <table id="table_id" class="table table-bordered table-striped table-hover">
                                  <thead>
                                     <tr class="info">
                                       <th> Product Id </th>
                                        <th>Image </th>
                                        <th> Action </th>
                                        
                                        
                                        
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($productImages as $attribute)
                                     <tr>
                                      
                                        <td> {{ $attribute->id }}  </td>
                                        <td> {{ $attribute->product_id }}  </td>

                                        <td>
                        <img src="{{url('uploads/products/'.$attribute->image)}}" alt="" style="width:80px;" />
                                        </td>                    
                                        <td>
                                         
                        <a  href="{{url('/admin/delete-alt-image/'.$attribute->id)}}" class="btn btn-danger btn-sm" ><i class="fa fa-trash-o"></i> </a>
                                        </td>
                                     </tr>
                                     @endforeach
                                    
        
                                  </tbody>
                               </table>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <!-- customer Modal1 -->
                <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
                   <div class="modal-dialog">
                      <div class="modal-content">
                         <div class="modal-header modal-header-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3><i class="fa fa-user m-r-5"></i> Update Customer</h3>
                         </div>
                         <div class="modal-body">
                            <div class="row">
                               <div class="col-md-12">
                                  <form class="form-horizontal">
                                     <fieldset>
                                        <!-- Text input-->
                                        <div class="col-md-4 form-group">
                                           <label class="control-label">Customer Name:</label>
                                           <input type="text" placeholder="Customer Name" class="form-control">
                                        </div>
                                        <!-- Text input-->
                                        <div class="col-md-4 form-group">
                                           <label class="control-label">Email:</label>
                                           <input type="email" placeholder="Email" class="form-control">
                                        </div>
                                        <!-- Text input-->
                                        <div class="col-md-4 form-group">
                                           <label class="control-label">Mobile</label>
                                           <input type="number" placeholder="Mobile" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                           <label class="control-label">Address</label><br>
                                           <textarea name="address" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                           <label class="control-label">type</label>
                                           <input type="text" placeholder="type" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group user-form-group">
                                           <div class="pull-right">
                                              <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                              <button type="submit" class="btn btn-add btn-sm">Save</button>
                                           </div>
                                        </div>
                                     </fieldset>
                                  </form>
                               </div>
                            </div>
                         </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                         </div>
                      </div>
                      <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- Modal -->    
                <!-- Customer Modal2 -->
                <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
                   <div class="modal-dialog">
                      <div class="modal-content">
                         <div class="modal-header modal-header-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3><i class="fa fa-user m-r-5"></i> Delete Customer</h3>
                         </div>
                         <div class="modal-body">
                            <div class="row">
                               <div class="col-md-12">
                                  <form class="form-horizontal">
                                     <fieldset>
                                        <div class="col-md-12 form-group user-form-group">
                                           <label class="control-label">Delete Customer</label>
                                           <div class="pull-right">
                                              <button type="button" class="btn btn-danger btn-sm">NO</button>
                                              <button type="submit" class="btn btn-add btn-sm">YES</button>
                                           </div>
                                        </div>
                                     </fieldset>
                                  </form>
                               </div>
                            </div>
                         </div>
                         <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                         </div>
                      </div>
                      <!-- /.modal-content -->
                   </div>
                   <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
             </section>
        
             <!-- end niew attributes  -->
        
        
        
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->


      
        <!-- end view for attributes  -->



         @endsection


         