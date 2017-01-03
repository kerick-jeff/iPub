@extends('layouts.master')

@section('title', '| geo')

<!-- provide author and page desc -->

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>geo</li>
</ol>
@endsection

@section('content')
    <div class="hidden">
        <input type="hidden" id = "latitude" name="latitude" value="{{ Auth::user()->geo_latitude }}">
        <input type="hidden" id = "longitude" name="longitude" value="{{ Auth::user()->geo_longitude }}">
    </div>
    <div id = "geo"></div>
@endsection

@section('javascript')
<script type="text/javascript">
    var latitude = $("#latitude").val();
    var longitude = $("#longitude").val();

    if(latitude != "" && longitude != ""){
        displayMap(latitude, longitude);
    } else {
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                displayMap(position.coords.latitude, position.coords.longitude);
            });
        } else {
            document.getElementById("geo").innerHTML = "Sorry, geolocation services are not supported by your browser";
        }
    }

    function displayMap(latitude, longitude){
        document.getElementById("geo").innerHTML = "<iframe style = \"width: 400px; height: 400px\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/?ll=" + latitude + "," + longitude + "&z=16&output=embed\"></iframe>";
    }
</script>
@endsection
