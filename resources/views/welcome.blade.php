
@extends('layouts.extendable')

@section('css')
<style type = "text/css">
#bg {
  background: url("{{ asset('land1.jpg') }}") no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  margin: 0px;
}

#label {
  position: relative;
  margin: 10%;
  margin-top: 5%;
  margin-bottom: 0;
  font-family: monospace;
  font-weight: bold;
  line-height: 175%;
  color: white;
  font-size: 400%;
  width: 80%;
}

@media (max-width: 767px){
  #label {
    margin: 10%;
    margin-top: 20%;
    font-size: 200%;
    line-height: 125%;
  }
}

@media (max-width: 992px){
  #label {
    margin: 5%;
    margin-bottom: 8%;
    font-size: 250%;
    line-height: 125%;
  }
}
</style>
@endsection

@section('extendable_content')
  <!-- Dislay landing page image -->
  <div class="content-wrapper" id = "bg">
    <h1 id = "label">&ldquo;What are you, your friends, families and relations craving about? Tell'em it's on iPub&rdquo; &mdash; <i>Fru Kerick</i></h1>
  </div>

  <footer class="main-footer" style = "margin-left: 0px; background-color: ; position: fixed; bottom: 0px; left: 0px; right: 0px">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="/">iPub.com</a>.</strong> All rights reserved.
  </footer>
@endsection

@section('javascript')
<script type = "text/javascript">
    // Ensure that the layout is fixed so that scroll bars don't appear when the page loads
    $("body").toggleClass("fixed");
</script>
@endsection
