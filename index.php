<!DOCTYPE html>
<html>
<head>
<title>SAS</title>
<?php
  include 'src/style.php';
?>
</head>
<body>
<div class="container-fluid">
  <div class="row justify-content-end mt-5">
    <div class="col-lg-4 animated fadeInUp" id="sec">
      <div class="card">
        <div class="card-body">
        <div class="float-md-right">
          <a href="admin-login.php" class="btn btn-sm btn-primary waves-effect"><i class="fas fa-user-shield" style="font-size:15px;"></i></a>
        </div>
          <form class="text-center border border-light p-5" id="frmLogin" action="functions/process/system_login.php" method="post">
            <p class="h4 mb-4">Shuttle Allocation System</p>
            <?php
              if(isset($_GET['stat'])){
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertx">
                <strong>Try Again!</strong> Invalid Login credentials.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
              }else{

              }
            ?>
            <div class="md-form">
              <input type="text" id="idNumber" name="idNumber" class="form-control mb-4">
              <label class="font-weight-bold inputs">ID Number</label>
            </div>
            <div class="md-form">
              <input type="password" id="password" name="password" class="form-control mb-4">
              <label class="font-weight-bold inputs">Password</label>
            </div>
              <!-- Sign in button -->
              <button class="btn btn-info" type="submit" name="login"><i class="fas fa-sign-in-alt fa-2x"></i></button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include 'src/script.php';
  if(isset($_GET['stat'])){
    $stat = $_GET['stat'];
  }else{
    $stat = 'x';
  }
  ?>
<script>
$(document).ready(function(){
});

const checkLogin = () => {
  var stat = <?=$stat?>;
  if(stat != ''){
      $('.inputs').css('color','red');
      $("input").css('border-bottom','solid 1px red');
      $('#sec').removeClass('animated fadeInUp');
  }
}
</script>
</body>
</html>