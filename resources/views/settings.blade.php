@extends('layouts.master')

@section('title', '| Settings')

<!-- provide author and page desc -->

@section('css')
<link rel="stylesheet" href="{{ asset('js/countrytel/build/css/intlTelInput.css') }}" media="screen" title="no title" charset="utf-8" >
<link rel="stylesheet" href="{{ asset('js/loading/waitMe.css') }}" media="screen" title="no title">

<style media="screen">
  #profile {
    width: 100%;
    height: 200px;
    cursor: pointer;
  }

  @media (max-width: 767px) {
    #profile {
      width: 100%;
      height: 250px;
      cursor: pointer;
    }
  }
</style>
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>Settings</li>
</ol>
@endsection

@section('content')

<div class="row" id = "container">
  <div class="col-md-12">
    <!-- settings/pin -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class = "fa fa-cogs">&nbsp;Settings/Configurations</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
            <div class="col-md-3">
              <!-- change profile picture form -->
              <form action="/settings/profile-picture" method="POST" enctype = "multipart/form-data">
                {{ csrf_field() }}
                <strong><i class = "fa fa-camera"></i>&nbsp; Profile Picture </strong>
                <div class="form-group has-feedback">
                   <img id = "profile" class="img-responsive img-thumbnail" src="{{ url('/profilePicture') }}" alt="User profile picture" title = "Click to change profile picture">
                   <input type="file" id = "file" name="profile_picture" style = "width: 100%">
                   @if ($errors->has('profile_picture'))
                       <span class="help-block" style = "color: #DD4B39 !important;">
                           <strong>{{ $errors->first('profile_picture') }}</strong>
                       </span>
                   @endif
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" id = "change_profile_picture" class = "btn btn-primary btn-block" title = "Click to change your profile picture">Change profile picture</button>
                </div>
              </form>
              <hr />

              <!-- set phone contact -->
              <form id = "contactForm" action = "/settings/phone-number" method = "POST">
                {{ csrf_field() }}
                <strong><i class = "fa fa-phone"></i>&nbsp; Phone Contact </strong>
                <div class="form-group has-feedback">
                  <input type="tel" id = "phone" class="form-control" name="phone_number" >
                  @if ($errors->has('phone_number'))
                      <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('phone_number') }}</strong>
                      </span>
                  @endif
                  <input type="hidden" name="dial_code" id = "dialCode">
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" id = "set_phone_number" class = "btn btn-primary btn-block" title = "Set your phone number">Set phone number</button>
                </div>
              </form>
              <hr />

              <!-- security form -->
              <form action = "settings/security" method = "POST">
                {{ csrf_field() }}
                <strong><i class = "fa fa-lock"></i>&nbsp; Security </strong>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password" placeholder="Enter new password">
                  <span class="fa fa-lock form-control-feedback"></span>
                  @if ($errors->has('password'))
                      <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Re-enter password">
                  <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                  @if ($errors->has('password_confirmation'))
                      <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" id = "change_password" class = "btn btn-primary btn-block" title = "Change your password">Change your password</button>
                </div>
              </form>
              <hr />
            </div>

            <div class="col-md-9">
              <!-- location form -->
              <form action="/settings/location" method="POST">
                {{ csrf_field() }}
                <div class="hidden">
                    <input type="hidden" id = "latitude" name="latitude" value="{{ Auth::user()->geo_latitude }}">
                    <input type="hidden" id = "longitude" name="longitude" value="{{ Auth::user()->geo_longitude }}">
                </div>

                <div class="form-group has-feedback">
                  <strong><i class = "fa fa-map-marker"></i> Location </strong>
                  <p> Hint: You can set your location by either choosing the longitude and latitude of your location or by finding your location on the map and clicking on set. </p>
                  <div  id ="map_canvas" style = "width 100%; height: 320px"> </div>
                </div>

                <div class = "form-group has-feedback" style = "display: inline-block; width: 50%;">
                  <strong>Latitude ({{ Auth::user()->geo_latitude }})</strong>
                  <input type="number" step = "0.00000001" class = "form-control" name="geo_latitude" id = "geo_latitude" value="{{ empty(Auth::user()->geo_latitude) ? '' : Auth::user()->geo_latitude }}" min = "-90" max = "90">
                  @if ($errors->has('geo_latitude'))
                      <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('geo_latitude') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group has-feedback" style = "display: inline-block; width: 49%;">
                  <strong>Longitude ({{ Auth::user()->geo_longitude }})</strong>
                  <input type="number" step = "0.00000001" class = "form-control" name="geo_longitude" id = "geo_longitude" value = "{{ empty(Auth::user()->geo_longitude) ? '' : Auth::user()->geo_longitude }}" min = "-180" max = "180">
                  @if ($errors->has('geo_longitude'))
                      <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('geo_longitude') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" id = "set_location" class = "btn btn-primary" title = "Set geolocation">Set</button>
                </div>
              </form>
              <hr />

              <!-- description form -->
              <form action="/settings/description" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                  <strong><i class = "fa fa-file-text"></i> Description </strong>
                  <textarea class="form-control" id = "description" name = "description" rows="8" placeholder="Hint: Provide accurate description about what you (organisation, company, individual, NGO or business) do, how you operate, products you sell or give out and the services you offer." disabled > {{ Auth::user()->description }} </textarea>
                  @if ($errors->has('description'))
                      <span class="help-block" style = "color: #DD4B39 !important;">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group has-feedback">
                  <button type="submit" id = "set_description" class = "btn btn-primary btn-block" title = "Set description">Save</button>
                </div>
              </form>
              <hr />
            </div>
          </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
</div>

@endsection

@section('javascript')

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/countrytel/build/js/intlTelInput.js"></script>
<script type="text/javascript" src="js/loading/waitMe.js"></script>
<script type="text/javascript">
    //map
    $(document).ready(function(){
        /*$.getJSON("http://ip-api.com/json/?callback=?", function(data) {
            var latitude = data.lat;
            var longitude = data.lon;
          //  alert(latitude + " - " + longitude);
            displayMap(latitude, longitude);
          });*/
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                $("#geo_latitude").val(position.coords.latitude);
                $("#geo_longitude").val(position.coords.longitude);
                displayMap(position.coords.latitude, position.coords.longitude);
            }, function(error){
                alert(error.code + " - " + error.message);
            });
        } else {
            document.getElementById("map_canvas").innerHTML = "Sorry, geolocation services are not supported by your browser";
        }
    });

    function displayMap(lat, lon){
        var position = new google.maps.LatLng(lat, lon);
		    var myOptions = {
  		      zoom: 10,
  		      minZoom: 3,
  		      maxZoom: 18,
  		      zoomControl: true,
    			  zoomControlOptions: {
    				    style: google.maps.ZoomControlStyle.DEFAULT
    			  },
    		    center: position,
    		    mapTypeId: google.maps.MapTypeId.ROADMAP,
    			  scrollwheel: false,
    			  //all of the below are set to to true by default
    			  panControl: false,
    			  mapTypeControl: false,
    			  scaleControl: false,
    			  streetViewControl: false,
    			  overviewMapControl: false,
    			  rotateControl: false
		    };

		    var map = new google.maps.Map(
		        document.getElementById("map_canvas"),
		        myOptions
        );

		    var marker = new google.maps.Marker({
		        position: position,
		        map: map,
		        title: "{{ Auth::user()->name }}"
		    });

		    var contentString = 'Set your location';
		    var infowindow = new google.maps.InfoWindow({
		        content: contentString
		    });

		    google.maps.event.addListener(marker, 'click', function() {
		      infowindow.open(map,marker);
		    });
    }

    //phoneNumber
    $("#phone").intlTelInput({
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        //initialCountry: "auto",
        numberType: "MOBILE",
        nationalMode: true,
        autoPlaceholder: true,
        separateDialCode: true,
        utilsScript: "js/countrytel/build/js/utils.js",
    });

    if("{{ Auth::user()->dial_code }} {{ Auth::user()->phone_number }}" != " "){
        $("#phone").intlTelInput("setNumber", "+{{ Auth::user()->dial_code }} {{ Auth::user()->phone_number }}");
    }

    $("#contactForm").submit(function(){
        var countryData = $("#phone").intlTelInput("getSelectedCountryData");
        var phoneNumber = $("#phone").intlTelInput("getNumber");
        var dialCode = countryData['dialCode'];
        if(Number(phoneNumber)){
            var begin = dialCode.length + 1;
            phoneNumber = phoneNumber.slice(begin);
            $("#phone").val(phoneNumber);
        }
        $("#dialCode").val(dialCode);
    });

    $("#description").hover(function(){
        $("#description").removeAttr("disabled");
    });

    $("#profile").click(function(){
        document.getElementById('file').click();
    });

    $("#change_profile_picture, #set_phone_number, #change_password, #set_location, #set_description").click(function(){
        $("#body").waitMe({
            effect: 'roundBounce',
            text: 'Saving account information',
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
