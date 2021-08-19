@extends('admin.layout.master'); 
@section('title', 'View Orders ')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-eye"></i>
       </div>
       <div class="header-title">
          <h1> View Orders </h1>
          <small> Orders   </small>
       </div>
    </section>
    

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
                         <h4> View Orders  </h4>
                      </a>
                   </div>
                </div>
                <div class="panel-body">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                   <div class="btn-group">
                      <div class="buttonexport" id="buttonlist"> 
                         <a class="btn btn-add" href="{{url('/admin/add-coupon')}}"> <i class="fa fa-plus"></i> Add coupons
                         </a>  
                      </div>
                     
                   </div>
                   <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                   <div class="table-responsive">
                      <table id="table_id" class="table table-bordered table-striped table-hover">
                         <thead>
                            <tr class="info">
                              <th> Orders  ID </th>
                               <th> Orders date </th>
                               <th> Customer Name  </th>
                                <th> Customer email  </th>
                               <th> Ordered  Product </th>
                               <th> Ordered Amount </th>
                               <th> Ordered Status    </th>
                               <th> Payement method  </th>
                              
                               
                            </tr>
                         </thead>
                         <tbody>
                     @if(!empty($coupons))
                     @foreach ($coupons as $coupon)
                         
                            <tr>
                              <td> {{$coupon->id }} </td>
                               <td> {{$coupon->coupon_code }}  </td>
                               <td> {{$coupon->amount }}  </td>
                               @if($coupon->amount_type =="Percentage") % @else PKR @endif
                               <td> {{$coupon->amount_type }}  </td>
                              <td> {{$coupon->expiry_date}} </td>
                            
                              <td> {{ $coupon->created_at}}  </td>
                               <td>
                                tt
                              </td>
                                                           
                               <td>
                                  <a href="{{url('/admin/edit-coupons/'.$coupon->id)}}" class="btn btn-add btn-sm" ><i class="fa fa-pencil"></i></a>
                                  <a  href="{{url('/admin/delete-coupons/'.$coupon->id)}}" class="btn btn-danger btn-sm" ><i class="fa fa-trash-o"></i> </a>
                               </td>
                            </tr>
                            @endforeach
                            @endif
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
    <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

@endsection