<!DOCTYPE html>
<html>
<head>
<title>SAS - Department (Agency)</title>
<?php
  include 'src/style.php';
?>
<style type="text/css">
		.overlay, .overlayDel {
  			position: fixed; 
        top: 0;
        left: 0;
  			display: none; 
  			width: 100%; 
  			height: 100%; 
  			/* background-color: white;  */
 			z-index: 5; 
  			cursor: pointer; 
        background-image: url('img/uploading.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
		}
</style>
</head>
<body>
<!-- ADDING LOADER -->
<div id="loading" class="overlay">
	<div class="col-lg-12" style="">
    <p class="mt-5 animated flash infinite slow text-center text-white text-uppercase">Please wait. <br>Saving new employees..</p>
	</div>
</div>
<!-- /ADDING LOADER -->
<?php
  include 'src/script.php';
?>
<script type="text/javascript">
$(document).ready(function(){
  $('.overlayDel').show();
});
</script>
</body>
</html> 