<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>iPub @yield('title')</title>
        @yield('description')
        @yield('author')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "shortcut icon" href = "ipub.ico">

        <link rel="stylesheet" href="{{ asset('boot/css/bootstrap.min.css') }}" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/hover.css') }}" media="screen" title="no title" charset="utf-8">

        <style media="screen">
            #login:hover, #register:hover, #pubs:hover, #about:hover {
                background: rgba(51,122,183,.2); 
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
              <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class = "sr-only">Toggle navigation</span>
                        <span class = "glyphicon glyphicon-menu-hamburger"></span>
                    </button>
                    <div class="navbar-brand">
                        <a id="menu-toggle" href="#" class="glyphicon glyphicon-align-justify btn-menu toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                        <a href="#" style = "text-decoration: none; color: rgba(51,122,183,1);">iPub</a>
                    </div>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li><a href="#" id = "pubs" style = "color: rgba(51,122,183,1);">Pubs</a></li>
                    <li><a href="#" id = "about" style = "color: rgba(51,122,183,1);">About Us</a></li>
                  </ul>
                  <ul class = "nav navbar-nav navbar-right">
                    <li><a href="#" id = "login" style = "color: rgba(51,122,183,1);">Login</a></li>
                    <li><a href="#" id = "register" class = "hoverable" style = "color: rgba(51,122,183,1);">Register</a></li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
          </nav>
          <!-- Sidebar -->
          <div id="sidebar-wrapper">
              <nav id="spy">
                  <ul class="sidebar-nav nav" style = "color: rgba(51,122,183,1);">
                      <li>
                          <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-inbox"></i></span>Inbox</a>
                      </li>
                      <li>
                          <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-globe"></i></span>Notifications</a>
                      </li>
                      <li>
                          <a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-upload"></i></span>Upload File</a>
                          <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                              <li><a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-picture"></i></span>Photo</a></li>
                              <li><a href="#"><span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-film"></i></span>Video</a></li>
                          </ul>
                      </li>
                      <li>
                          <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-user"></i></span>Profile</a>
                      </li>
                      <li>
                          <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-cog"></i></span>Settings</a>
                      </li>
                      <li>
                          <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-stats"></i></span>Statistics</a>
                      </li>
                      <li>
                          <a href="#"> <span class="fa-stack fa-lg pull-left"><i class="glyphicon glyphicon-log-out"></i></span>Logout</a>
                      </li>
                  </ul>
              </nav>
          </div>
          <!-- Page content -->
          <div class="container-fluid" style = "margin-top: 50px;">

              @yield('content')

          </div>
        </div>

        @section('footer')

            <!-- display footer -->
        @show

        <script type="text/javascript" src = "{{ asset('js/jquery.min.js') }}"> </script>
        <script type="text/javascript" src = "{{ asset('boot/js/bootstrap.min.js') }}"> </script>
        <script type="text/javascript" src = "{{ asset('js/sidebar.js') }}"> </script>
    </body>
</html>
