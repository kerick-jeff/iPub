@extends('layouts.master')

@section('description')
    <meta name = "description" content = "Register an account with iPub. An iPub account enables users of the platform to be able manage their data and resources related to iPub's aim." >
@endsection

@section('author')
    <meta name="author" content="kerick-jeff">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('js/countrylist/build/css/countrySelect.css') }}">

@endsection

@section('content')
<div class="container" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style = "color: #337AB7">
                <div class="panel-heading" style = "background-color: #337AB7; color: #fff">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Individual, Organisation, Business or Company">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="someone@example.com">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Atleast 8 characters.">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter your password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Select category</label>

                            <div class="col-md-6">
                                <select class="form-control" name="category">
                                    <option value="individual">Individual</option>
                                    <option value="organisation">Organisation</option>
                                    <option value="business">Business</option>
                                    <option value="company">Company</option>
                                    <option value="ngo">NGO</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Select country</label>

                            <div class="col-md-6">
                                <input type="text" id = "country" name="country" class="form-control">
                                <input type="hidden" name="country_code">
                            </div>

                            <script src="{{ asset('js/jquery.min.js')}}"></script>
                            <script src="{{ asset('js/countrylist/build/js/countrySelect.js') }}"></script>
                            <script type="text/javascript">
                                $("#country").countrySelect({
                                  preferredCountries: ['us', 'gb', 'cm'],

                                });
                            </script>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <div class="checkbox">
                                    <input type="checkbox" name = "agreement_policy">  <a href="/agreement-policy">Accept User agreement and Privacy Policy</a>
                                    @if ($errors->has('agreement_policy'))
                                        <span class="help-block" style = "color: #A94442;">
                                            <strong>{{ $errors->first('agreement_policy') }}</strong>
                                        </span>
                                    @endif
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
