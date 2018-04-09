@extends('layouts.extendable')

@section('css')
  <style type = "text/css">
    @media(max-width: 768px){
      #navigation {
        margin-top: 25%;
      }
    }

    #navigation {
      background: red;
    }

    @media(max-width: 992px){
      #navigation {
        display: none;
      }
    }
  </style>
@endsection

@section('extendable_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style = "margin-left: 0px; background-color: #ecf0f5">
    <!-- Main content -->
    <section class="content">
      

       @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style = "margin-left: 0px; background-color: ; position: fixed; bottom: 0px; left: 0px; right: 0px">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="/">iPub.com</a>.</strong> All rights reserved.
  </footer>

@endsection
