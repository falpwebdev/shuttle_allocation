<?php
  include 'db/config.php';
  if(isset($_GET['code'])){
    $code = $_GET['code'];
    $sqlCodeInfo = "SELECT * FROM `sas_d_resub_code` WHERE `resubmitCode` ='$code' AND `status` = 'Open';";
    $query = $conn->query($sqlCodeInfo);
    $count = mysqli_num_rows($query);
    if($count != '1'){
      $codeStat = 'Used';
    }else{
      // $sqlUpdateCode = "UPDATE `sas_d_resub_code` SET `status`= 'Using', `usedDt`= (SELECT CURRENT_TIMESTAMP()) WHERE `resubmitCode` = '$code'";
      // $query1 = $conn->query($sqlUpdateCode);
      $codeStat = 'Open';
      while($data = $query->fetch_assoc()){
        echo $modifyDate = $data['modifyDate'];
        echo $modifyItem = $data['modifyItem'];
        echo $requestor = $data['requestor'];
      }
    }
  }else{  
    header("Location: resubmit-out-login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Modify Outgoing Data</title>
<?php
  include 'src/style.php';
?>
</head>
<body>
    <div class="container-fluid">
    </div>
<?php
  include 'src/script.php';
?>
<script>
$(document).ready(function(){
  checkCode();
});

  // Functions
    const checkCode = () => {
      var x = '<?=$codeStat?>';
      if(x == 'Used'){
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Code have been used or already using. Got o GA.',
          showConfirmButton: true,
          timer: 1500
        }).then((result) => {
            if (result.isConfirmed) {
              location.href = "resubmit-out-login.php";
            }
          });
      }else{

      }
    }
</script>
</body>
</html>