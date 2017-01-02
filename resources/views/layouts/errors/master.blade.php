<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iPub @yield('title')</title>
  @yield('description')
  @yield('author')
  <!-- favicon -->
  <link rel = "shortcut icon" href = "ipub.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <!--      <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">        -->
  <link rel="stylesheet" href="{{ asset('ipub/bootstrap/css/bootstrap.min.css') }}">
  <!-- Theme style -->
  <!--       <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">     -->
  <link rel="stylesheet" href="{{ asset('ipub/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('ipub/dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" id = "body" style = "height: 100%">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size:45px"><b>iP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:45px"><b>iP</b>ub</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li style="right: 570%"><a href="/pubs" >Pubs</a></li>
            <li style="right: 570%"><a href="/about" >About Us</a></li>
        </ul>
      </div>
    </nav>
  </header>

    <!-- Main content -->
    <section class="content"  style = "background-color: #ecf0f5;">

       @yield('content')

    </section>
    <!-- /.content -->

  <footer class="main-footer" style = "margin-left: 0px; position: fixed; bottom: 0px; left: 0px; right: 0px">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="/">iPub.com</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!--        <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>        -->
<script src="{{ asset('ipub/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<!--        <script src="../../bootstrap/js/bootstrap.min.js"></script>     -->
<script src="{{ asset('ipub/bootstrap/js/bootstrap.min.js') }}"></script>


</body>
</html>
