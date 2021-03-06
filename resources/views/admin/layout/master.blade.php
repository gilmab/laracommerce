<!DOCTYPE html>
<html lang="en">
   
<!-- Mirrored from thememinister.com/crm/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jun 2019 11:06:57 GMT -->
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{csrf_token()}}">
      <title> @yield('title') </title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="{{asset('admin_asset/assets/dist/img/ico/favicon.png')}}" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
         <link rel="stylesheet" href="/resources/demos/style.css">
      <!-- jquery-ui css -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- Bootstrap -->
      <link href="{{asset('admin_asset/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap rtl -->
      <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
      <!-- Lobipanel css -->
      <link href="{{asset('admin_asset/assets/plugins/lobipanel/lobipanel.min.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Pace css -->
      <link href="{{asset('admin_asset/assets/plugins/pace/flash.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Font Awesome -->
      <link href="{{asset('admin_asset/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Pe-icon -->
      <link href="{{asset('admin_asset/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Themify icons -->
      <link href="{{asset('admin_asset/assets/themify-icons/themify-icons.css')}}" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start page Label Plugins 
         =====================================================================-->
      <!-- Emojionearea -->
      <link href="{{asset('admin_asset/assets/plugins/emojionearea/emojionearea.min.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Monthly css -->
      <link href="{{asset('admin_asset/assets/plugins/monthly/monthly.css')}}" rel="stylesheet" type="text/css"/>
      <!-- End page Label Plugins 
         =====================================================================-->
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="{{asset('admin_asset/assets/dist/css/stylecrm.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
         =====================================================================-->
   </head>

   <body class="hold-transition sidebar-mini">

     <!--preloader-->
     <div id="preloader">
      <div id="status"></div>
   </div>

     <div class="wrapper">
        @include('admin.layout.header') ; 

        @include('admin.layout.sidebar') ; 
    
        @yield('content')

        @include('admin.layout.footer') ; 
     </div>

     


      <!-- jQuery -->
      <script src="{{asset('admin_asset/assets/plugins/jQuery/jquery-1.12.4.min.js')}}" type="text/javascript"></script>
      <!-- jquery-ui --> 
      <script src="{{asset('admin_asset/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="{{asset('admin_asset/assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="{{asset('admin_asset/assets/plugins/lobipanel/lobipanel.min.js')}}" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="{{asset('admin_asset/assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
      <!-- SlimScroll -->
      <script src="{{asset('admin_asset/assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript">    </script>
      <!-- FastClick -->
      <script src="{{asset('admin_asset/assets/plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
      <!-- CRMadmin frame -->
      <script src="{{asset('admin_asset/assets/dist/js/custom.js')}}" type="text/javascript"></script>
      <!-- End Core Plugins
         =====================================================================-->
      <!-- Start Page Lavel Plugins
         =====================================================================-->
      <!-- ChartJs JavaScript -->
      <script src="{{asset('admin_asset/assets/plugins/chartJs/Chart.min.js')}}" type="text/javascript"></script>
      <!-- Counter js -->
      <script src="{{asset('admin_asset/assets/plugins/counterup/waypoints.js')}}" type="text/javascript"></script>
      <script src="{{asset('admin_asset/assets/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
      <!-- Monthly js -->
      <script src="{{asset('admin_asset/assets/plugins/monthly/monthly.js')}}" type="text/javascript"></script>
      <!-- End Page Lavel Plugins
         =====================================================================-->
      <!-- Start Theme label Script
         =====================================================================-->
      <!-- Dashboard js -->
      <script src="{{asset('admin_asset/assets/dist/js/dashboard.js')}}" type="text/javascript"></script>
      <!-- End Theme label Script
         =====================================================================-->
         <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
         <script> 
         $(document).ready( function () {
    $('#table_id').DataTable();
    //Update Status Product 
    $('.ProductStatus').change(function(){
            var id = $(this).attr('rel') ; 
            if($(this).prop("checked")==true){
               $.ajax({
                  headers: {
                     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'post',
                  url : '/blog/public/admin/update-product-status',
                  data : {status: '0', id:id}, 
                  success:function(data){
                     $("#message_success").show() ; 
                     setTimeout(function(){
                        $("#message_success").fadeOut('slow') ; }, 2000) ; 
                  },error:function(){
                     alert("Error") ; 
                  }

               })
            }else {

               $.ajax({
                  headers: {
                     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'post',
                  url : '/blog/public/admin/update-product-status',
                  data : {status: '0', id:id}, 
                  success:function(resp){
                     $("#message_error").show() ; 
                     setTimeout(function(){
                        $("#message_error").fadeOut('slow') ; }, 2000) ; 
                  },error:function(){
                     alert("Error") ; 
                  }

               })


            }
    }) ; 

    //Update Status category
    $('.CategoryStatus').change(function(){
            var id = $(this).attr('rel') ; 
            if($(this).prop("checked")==true){
               $.ajax({
                  headers: {
                     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'post',
                  url : '/blog/public/admin/update-category-status',
                  data : {status: '1', id:id}, 
                  success:function(data){
                     $("#message_success").show() ; 
                     setTimeout(function(){
                        $("#message_success").fadeOut('slow') ; }, 2000) ; 
                  },error:function(){
                     alert("Error") ; 
                  }

               })
            }else {

               $.ajax({
                  headers: {
                     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'post',
                  url : '/blog/public/admin/update-category-status',
                  data : {status: '1', id:id}, 
                  success:function(resp){
                     $("#message_error").show() ; 
                     setTimeout(function(){
                        $("#message_error").fadeOut('slow') ; }, 2000) ; 
                  },error:function(){
                     alert("Error") ; 
                  }

               })
            }
    }) ; 

            // Add remove fields dynamically 
            
     $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="display:flex;"> <input type="text" name="sku[]" id="sku" placeholder="sku" class="form-control" style="width:120px;margin-right:5px;"/> <input type="text" name="size[]" id="size" placeholder="size" class="form-control" style="width:120px;margin-right:5px;"/> <input type="text" name="price[]" id="price" placeholder="price" class="form-control" style="width:120px;margin-right:5px;"/>  <input type="text" name="stock[]" id="stock" placeholder="stock" class="form-control" style="width:120px;margin-right:10px;"/>  <a href="javascript:void(0);" class="remove_button"> Remove </a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

} );

         </script> 


      <script>
         function dash() {
         // single bar chart
         var ctx = document.getElementById("singelBarChart");
         var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
         labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
         datasets: [
         {
         label: "My First dataset",
         data: [40, 55, 75, 81, 56, 55, 40],
         borderColor: "rgba(0, 150, 136, 0.8)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(0, 150, 136, 0.8)"
         }
         ]
         },
         options: {
         scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
         }
         }
         });
               //monthly calender
               $('#m_calendar').monthly({
                 mode: 'event',
                 //jsonUrl: 'events.json',
                 //dataType: 'json'
                 xmlUrl: 'events.xml'
             });
         
         //bar chart
         var ctx = document.getElementById("barChart");
         var myChart = new Chart(ctx, {
         type: 'bar',
         data: {
         labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september","october", "Nobemver", "December"],
         datasets: [
         {
         label: "My First dataset",
         data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
         borderColor: "rgba(0, 150, 136, 0.8)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(0, 150, 136, 0.8)"
         },
         {
         label: "My Second dataset",
         data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
         borderColor: "rgba(51, 51, 51, 0.55)",
         width: "1",
         borderWidth: "0",
         backgroundColor: "rgba(51, 51, 51, 0.55)"
         }
         ]
         },
         options: {
         scales: {
         yAxes: [{
             ticks: {
                 beginAtZero: true
             }
         }]
         }
         }
         });
             //counter
             $('.count-number').counterUp({
                 delay: 10,
                 time: 5000
             });
         }
         dash();         
      </script>
      <script>
         $( function() {
           $( "#expiry_date" ).datepicker({
              minDate:0, 
              dateFormat: 'yy-mm-dd'

           });
         } );
         </script>
      
      <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" > 
      <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
      

   
    @include('sweetalert::alert')

   </body>
  
</html>