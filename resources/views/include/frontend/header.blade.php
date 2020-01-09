
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{asset('asset/img/favicon.png')}}" type="img/favicon.png" sizes="48x48">
  <title>Mandalay Homes</title>

  <!-- Custom fonts for this template-->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

  <link href="{{asset('frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('frontend/css/sb-admin-2.css')}}" rel="stylesheet">
  <!-- <script>
      $(document).click(function (e) {
            $el = $(e.target);
            if ($el.hasClass('toggletag')) {return false;} 
            else if ($el.hasClass('nav-toggle')) {
                $("body").toggleClass('close-menu');

            } else {
                $("body").removeClass('close-menu');
            }
        });
      </script>-->
   
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="fixed-top">
		      <img src="{{asset('frontend/img/header-bg.png')}}" class="curve_img" />
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
         <div class="logo">
              <a href="#"><img src="{{asset('frontend/img/logoRev.png')}}" width="400"></a>
            </div>
        
<!--<div class="plan-name_o">
                  Residence 1~ Plan 5411: Deseo
              </div>-->
          <!-- Topbar Search -->


          <!-- Topbar Navbar -->
         

           

            
            <div class="log_in_d">
                    <a href="{{url('admin/login')}}" class="btn btn-success btn-icon-split ">
                <!--<span class="icon text-white-50">
                  
                </span>-->
				<i class="fas fa-sign-in-alt pr-2"></i>
                <span>Login</span>
              </a>
           </div>
         

        </nav>
        <!-- End of Topbar -->