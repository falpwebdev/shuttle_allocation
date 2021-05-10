<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
?>
<?php
  include 'db/config.php';
  $userId =$_SESSION['idNumber'];
  $userEmpName = $_SESSION['empName']; 
  $userHandle = $_SESSION['handle'];
  $handle = $userHandle;
  $userAgency = $_SESSION['agency'];
  $idNumber = $_GET['empId'];
  $empName = $_GET['empName'];
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Department</title>
<?php
  include 'src/style.php';
  include 'modals/transferEmp.php';
  include 'modals/changeShift.php';
?>
</head>
<body>
<?php
 if(isset($_GET['role'])){
  $userType = $_GET['role'];
 }
 if($userType == 'admin'){
   if($userAgency == 'FAS'){
     include 'src/navs/admin-topnav.php';
   }else{
    include 'src/navs/agency-topnav.php';
   }
 }else{
  include 'src/navs/topnav.php';
 }
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <h4 class="card-title text-center mt-3"><?=$idNumber?> - <?=$empName?></h4>
        <div class="card-body">
          <div class="row">

            <div class="col-lg-12">
              <div class="card">
                  <h6 class="card-title text-center text-uppercase mt-3">Attendance</h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                         <input type="month" id="selMonthYear" class="form-control">
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-lg-12">
                      <table class="table-sm table-bordered text-center" width="100%">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Outgoing</th>
                            <th>Filed By</th>
                          </tr>
                        </thead>
                        <tbody id="tblAttendance">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 mt-1">
              <div class="card">
                  <h6 class="card-title text-center text-uppercase mt-3">History</h6>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <table class="table-sm table-bordered text-center" width="100%">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Updated By</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          
                            $sqlHist = "SELECT `activityDate`,`actDescription`,(SELECT empName FROM `sas_m_accounts` WHERE idNumber = `user`) AS user, (SELECT adName FROM `sas_m_adminacc` WHERE idNumber = `user`) AS user1 FROM `a_mp_history` WHERE idNumber = '$idNumber' ORDER BY activityDate DESC";
                            $query = $conn->query($sqlHist);
                            while ($data = $query->fetch_assoc()) {
                              echo '<tr>
                              <td>'.$data['activityDate'].'</td>
                              <td>'.$data['actDescription'].'</td>';
                              if($data['user'] == '' && $data['user1'] == ''){
                                echo '<td>System</td>';
                              }else if($data['user1'] != ''){
                                echo '<td>'.$data['user1'].'</td>';
                              }else{
                                echo '<td>'.$data['user'].'</td>';
                              }
                              echo '</tr>';
                            }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include 'src/script.php';
  include 'functions/js/notif.php';
?>
<script type="text/javascript">
$(document).ready(function(){
  // Real time
    notifNum();
});
//  Realtime
  setInterval(function(){
  notifNum();
  }, 3000);
$('#selMonthYear').change(function(){
  var filter = $(this).val();
  $.ajax({
    url: 'functions/display/user_department.php?data=attendanceMP&id=<?=$idNumber?>&monthYear='+filter,
    method: 'get',
    success: function(response){
     $('#tblAttendance').html(response);
    },error: function(){
    }
  });
});


</script>
</body>
</html>

