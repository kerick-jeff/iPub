<?php $__env->startSection('title', '| geo'); ?>

<!-- provide author and page desc -->

<?php $__env->startSection('breadcrumb'); ?>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> iPub </a></li>
    <li>geo</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="hidden">
        <input type="hidden" id = "latitude" name="latitude" value="<?php echo e(Auth::user()->geo_latitude); ?>">
        <input type="hidden" id = "longitude" name="longitude" value="<?php echo e(Auth::user()->geo_longitude); ?>">
    </div>
    <div id = "geo"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    var latitude = $("#latitude").val();
    var longitude = $("#longitude").val();
    if(latitude != "" && longitude != ""){
        alert(latitude + " - " + longitude);
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                display(position.coords.latitude, position.coords.longitude);
            });
        } else {
            document.getElementById("geo").innerHTML = "Sorry, geolocation services are not supported by your browser";
        }

        function display(latitude, longitude){
            document.getElementById("geo").innerHTML = "<iframe style = \"width: 400px; height: 400px\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/?ll=" + latitude + "," + longitude + "&z=16&output=embed\"></iframe>";
        }
    } else {
        alert("no");
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>