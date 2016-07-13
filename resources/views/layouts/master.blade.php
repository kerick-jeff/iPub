<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="ipub.ico">
        <title>iPub @yield('title') </title>
    </head>
    <body>
        @section('header')
            show header
        @show

        <div class="container-fluid">
          @section('sidebar')
              show sidebar
          @show

          @yield('content')
        </div>

        @section('footer')
            show footer
        @show
    </body>
</html>
