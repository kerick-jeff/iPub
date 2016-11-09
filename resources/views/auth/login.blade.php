@extends('layouts.form')

@section('title', 'Login')

<!-- provide author and page desc -->

@section('css')
    <link rel="stylesheet" href="{{ asset('js/loading/waitMe.css') }}" media="screen" title="no title">
@endsection

@section('content')
    <p class="login-box-msg">Login</p>

    @if(session('info'))
        <div class="alert alert-info alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <i class = "icon fa fa-info"></i> <br />
             {{ session('info') }}
             <a href="/resend/{{ session('email') }}/{{ session('name') }}">Resend link</a>
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class = "icon fa fa-warning"></i> <br />
            {{ session('warning') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <i class = "icon fa fa-check"></i> <br />
             {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        {{ csrf_field() }}
      <div class="form-group has-feedback  {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback  {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id = "login" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Login using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Login using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
    <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>

 @endsection

 @section('javascript')
 <script type="text/javascript" src = "{{ asset('js/loading/waitMe.js') }}"></script>
 <script type="text/javascript">
 $("#login").click(function(){
     $("#body").waitMe({
         effect: 'roundBounce',
         text: 'Signing you in',
         bg: 'rgba(255,255,255,0.7)',
         color: '#3c8dbc',
         sizeW: '',
         sizeH: '',
         source: '',
         onClose: function(){}
     });
 });
 </script>
 @endsection
