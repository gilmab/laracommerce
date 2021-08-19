<aside class="main-sidebar">
   <!-- sidebar -->
   <div class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu">
         <li class="active">
            <a href="{{url('/admin/dashboard')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
            <span class="pull-right-container">
            </span>
            </a>
         </li>
         <li class="treeview">
            <a href="#">
            <i class="fa fa-product-hunt"></i><span> Products </span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{url('/admin/add-product')}}">Add Product</a></li>
               <li><a href="{{url('/admin/view-product')}}"> View Product </a></li>       
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
            <i class="fa fa-list"></i><span> Category <span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{url('/admin/category')}}">Add Category</a></li>
               <li><a href="{{url('/admin/view-categories')}}"> View Category </a></li>    
            </ul>
         </li>

         <li class="treeview">
            <a href="#">
            <i class="fa fa-list"></i><span> Coupon <span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{url('/admin/add-coupon')}}">Add Coupon </a></li>
               <li><a href="{{url('/admin/view-coupon')}}"> View Coupon </a></li>    
            </ul>
         </li>

         <li class="treeview">
            <a href="{{url('admin/orders')}}">
            <i class="pe-7s-cart"></i><span> Order <span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{url('admin/orders')}}">Add Coupon </a></li>
               <li><a href="{{url('/admin/view-coupon')}}"> View Coupon </a></li>    
            </ul>
         </li>

         <li class="active">
            <a href="{{url('/admin/banners')}}"><i class="fa fa-image"></i><span> Banners </span>
            <span class="pull-right-container">
            </span>
            </a>
         </li>
         
      </ul>
   </div>
   <!-- /.sidebar -->
</aside>
<!-- =============================================== -->