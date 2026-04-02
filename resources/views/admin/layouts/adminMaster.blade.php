<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $websiteParameter->title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <?php header('Access-Control-Allow-Origin:*'); ?>
  <?php header('Access-Control-Allow-Methods:GET,POST'); ?>
  <?php header('Access-Control-Allow-Headers:X-Requested-With'); ?>
  <link rel="icon" type="image/x-icon" href="{{asset($websiteParameter->favIcon())}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/dist/css/w3.css') }}">
 <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  @stack('css')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
@include('admin.include.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
@include('admin.include.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 
    <br>

    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') }} <a href="{{ url('/') }}">{{ $websiteParameter->h1 }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 10.0.0
    </div>
  </footer>
</div>

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/pages/dashboard3.js') }}"></script>
@stack('js')
</body>
</html>
