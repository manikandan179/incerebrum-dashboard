<?php
    if (!session()->has('user_id')) {
        echo "<script>window.location.href = '/login';</script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Incerebrum | Dashboard</title>

  <link rel="icon" href="{{url('/')}}/assets/dist/img/favicon.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{url('/')}}/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select 2 -->
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/jquery-ui/jquery-ui.min.css">

  <!-- jQuery -->
  <script src="{{url('/')}}/assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{url('/')}}/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{url('/')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{url('/')}}/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="{{url('/')}}/assets/plugins/sweetalert2/sweetalert2.min.js"></script>  
  <!-- AdminLTE App -->
  <script src="{{url('/')}}/assets/dist/js/adminlte.js"></script>
  <!-- Select 2 -->
  <script src="{{url('/')}}/assets/plugins/select2/js/select2.full.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
          <a class="nav-link d-flex align-items-center text-dark" data-toggle="dropdown" href="#">
                
              <span class="mr-2">{{ session('user_name') }} </span>             
              <img src="{{url('/')}}/assets/dist/img/avatar5.png" alt="User Image" class="rounded-circle" width="30" height="30">
              
          </a>     
          <div class="dropdown-menu dropdown-menu-right"> 
            <a class="nav-link" href="{{ route('logout') }}" class="nav-link"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
          </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4  bg-white">
    <!-- Brand Logo -->
    <div class="brand-link d-flex">
      <img src="{{url('/')}}/assets/dist/img/Logo.png" alt="AdminLTE Logo" class="brand-image">
    </div>

    <!-- Sidebar -->
    <div class="sidebar bg-white">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('/candidates')}}" class="nav-link ">
              <p class="{{ Request::is('candidates*') ? 'text-primary' : '' }}">
                Students
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/upskill')}}" class="nav-link ">
              <p class="{{ Request::is('upskill*') ? 'text-primary' : '' }}">
                upskills
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>