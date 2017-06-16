
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
  position: absolute;
  margin: 20%;
  margin-top: 5%;
  margin-bottom: 10%;
  color: white;
  font-size: 300%;
  width: 50%;
}

@media (max-width: 768px){
  #label {
    position: absolute;
    margin: 10%;
    margin-top: 20%;
    margin-bottom: 5%;
    color: white;
    font-size: 200%;
    width: 90%;
  }
}
</style>
@endsection

@section('extendable_content')
  <!-- Dislay landing page image -->
  <div class="content-wrapper" id = "bg">
    <h1 id = "label">&ldquo;What are you, your friends, families and relations craving about?<br /> Tell'em it's on iPub&rdquo; &mdash; <i>Fru Kerick</i></h1>
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
