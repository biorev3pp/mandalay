
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Mandalay Homes</title>

  <!-- Custom fonts for this template-->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

  <link href="{{asset('frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('frontend/css/sb-admin-2.css')}}" rel="stylesheet">
   
   
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
              <a href="#"><img src="{{asset('frontend/img/logoRev.png')}}" width="300"></a>
            </div>
        
<div class="plan-name_o">
                  Residence 1~ Plan 5411: Deseo
              </div>
          <!-- Topbar Search -->


          <!-- Topbar Navbar -->
         <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            
            <li class="nav-item no-arrow d-flex align-items-center justify-content-center">
                    <a href="{{url('admin/login')}}" class="btn btn-success btn-icon-split ">
                <span class="icon text-white-50">
                  <i class="fas fa-sign-out-alt"></i>
                </span>
                <span class="text px-4">Login</span>
              </a>
            </li>
          </ul>

        </nav>
        <!-- End of Topbar -->