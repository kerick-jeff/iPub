@extends('layouts.form')

@section('title', 'Registration')

<!-- provide author and page desc -->

@section('css')
    <link rel="stylesheet" href="{{ asset('js/countrylist/build/css/countrySelect.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/countrylist/build/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('js/loading/waitMe.css') }}" media="screen" title="no title">
    <style media="screen">
        #country {
            width: 319px;
        }
        @media (max-width: 767px) {
            #country {
                width: 183px;
            }
        }
    </style>
@endsection

@section('content')
    <p class="login-box-msg">Register</p>

    <form method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback  {{ $errors->has('name') ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name of Individual, Organisation, Business or Company">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>
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
        <input type="password" class="form-control" name="password" placeholder="Atleast 8 characters." placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type password">
        <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
          <select class="form-control" name="category">
            <option value="individual">Individual</option>
            <option value="organisation">Organisation</option>
            <option value="business">Business</option>
            <option value="company">Company</option>
            <option value="ngo">NGO</option>
          </select>
      </div>
      <div class="form-group has-feedback">
          <input type="text" id = "country" name="country" class="form-control" placeholder="country">
          <script src="{{ asset('js/jquery.min.js')}}"></script>
          <script src="{{ asset('js/countrylist/build/js/countrySelect.js') }}"></script>
          <script type="text/javascript">
              $("#country").countrySelect({
                preferredCountries: ['us', 'gb', 'cm'],
              });
          </script>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
              <input type="checkbox" name = "terms"> I agree to the <a href="#">terms and conditions</a>
              @if ($errors->has('terms'))
                  <span class="help-block" style = "color: #DD4B39 !important;">
                      <strong>{{ $errors->first('terms') }}</strong>
                  </span>
              @endif
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id = "register" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Register using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Register using
        Google+</a>
    </div>

    <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
  @endsection

  @section('javascript')
  <script type="text/javascript" src = "{{ asset('js/loading/waitMe.js') }}"></script>
  <script type="text/javascript">
    $("#register").click(function(){
        $("#body").waitMe({
            effect: 'roundBounce',
            text: 'Processing account details',
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
