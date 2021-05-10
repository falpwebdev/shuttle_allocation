<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  include 'db/config.php';
  include 'functions/inc/inc.php';
  $userId =$_SESSION['idNumber'];
  $userEmpName = $_SESSION['empName']; 
  $userHandle = $_SESSION['handle']; 
  $handle =$userHandle;
  if(isset($_SESSION['agency'])){
    $userAgency = $_SESSION['agency']; 
    $agency = $_SESSION['agency'];
  }else{
    $userAgency = 'FAS';
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Update Details</title>
  <?php
    include 'src/style.php';
    $data1 = $_GET['emp'];
    $dataEmp = explode("/", $data1);
    $empId = $dataEmp[0];
    $empName = $dataEmp[1];
    $userType = $_GET['role'];
  ?>
</head>
<body>
<?php
    // DETERMINE USER TYPE 
    if($userType == 'admin'){
        include 'src/navs/admin-topnav.php';
    }else if($userType == 'Agency'){
      include 'src/navs/agency-topnav.php';
    }else{
      include 'src/navs/topnav.php';
    }
 ?>
 <div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 mt-5">
      <div class="card">
          <h4 class="card-title text-center mt-3">UPDATE EMPLOYEE (<?=$empName;?>)</h4>
        <div class="card-body">
          <!-- Get Employee Details -->
            <?php
            $sql = "SELECT * FROM a_m_employee WHERE idNumber = '$empId'";
            $query = $conn->query($sql);
            while ($data = $query->fetch_assoc()) {
              $idNumber = $data['idNumber'];
              $empName = $data['empName'];
              $empNick = $data['empNickname'];
              $empContact = $data['empContact'];
              $empPosition = $data['empPosition'];
              $empCostCenter = $data['empCostCenter'];
              $empAgency = $data['empAgency'];
              $empDeptCode = $data['empDeptCode'];
              $empDeptSection = $data['empDeptSection'];
              $empDeptSubSect = $data['empSubSect'];
              $empArea = $data['empArea'];
              $empRoute = $data['empRoute'];
              $empShift = $data['empShift'];
              $empShiftTime = $data['empShiftTime'];
              $empLine = $data['lineNo'];
              $empHandler = $data['lineNo'];
              $status = $data['status'];
              $dateHired = $data['dateHired'];
              $empBatch = $data['batchNo'];
            }
          ?>
          <!-- Get Employee Details -->
          <!-- Row 1 -->
            <div class="row">
              <!-- ID NUMBER -->
                <div class="col">
                  <div class="md-form">
                    <input type="text" id="newIDNum" class="form-control" value="<?=$empId?>">
                    <label for="newIDNum">ID Number</label>
                  </div>
                </div>
              <!-- DATE HIRED -->
                <div class="col">
                  <label for="newDateHired">Date Hired</label>
                  <input type="date" id="newDateHired" class="form-control" value="<?=$dateHired?>">
                </div>
              <!-- NAME -->
                <div class="col">
                  <div class="md-form">
                    <input type="text" id="newEmpName" class="form-control" placeholder="LN, FN MI." value="<?=$empName?>">
                    <label for="newEmpName">Employee Name</label>
                  </div>
                </div>
              <!-- BATCH -->
                <div class="col">
                  <div class="md-form">
                    <input type="text" id="empBatch" name="batchNo" class="form-control" value="<?=$empBatch?>">
                    <label for="empBatch">Batch Number</label>
                  </div>
                </div>
              <!-- NICKNAME -->
                <div class="col">
                  <div class="md-form">
                    <input type="text" id="newEmpNickname" class="form-control" value="<?=$empNick?>">
                    <label for="newEmpName">Nickname</label>
                  </div>
                </div>
              <!-- CONTACT NUMBER -->
                <div class="col">
                  <div class="md-form">
                    <input type="tel" id="empContact" name="phone" class="form-control" placeholder="Ex: 0911-245-4678" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" value="<?=$empContact?>">
                    <label for="empContact">Contact Number</label>
                  </div>
                </div>
            </div>
          <!-- End Row 1 -->
          <!--  Row 2 -->
            <div class="row">
              <!-- POSITION -->
                <div class="col">
                  <label for="empPosition">Position</label>
                  <select class="browser-default custom-select" id="empPosition">
                  </select>
                </div>
              <!--  DEPARTMENT -->
                <div class="col">
                  <label for="empDepartment">Department</label>
                  <!-- <select class="browser-default custom-select" id="empDepartment" disabled>
                  </select> -->
                  <input class="form-control" id="empDepartment" value="<?=$empDeptCode?>" disabled>
                </div>
              <!--  SECTION -->
                <div class="col">
                  <label for="deptSect">Section</label>
                  <!-- <select class="browser-default custom-select" id="deptSect" disabled>
                  </select> -->
                  <input class="form-control" id="deptSect" value="<?=$empDeptSection?>" disabled>
                </div>
              <!-- SUB-SECTION -->
                <div class="col">
                  <label for="deptSubSect">Sub Section</label>
                  <!-- <select class="browser-default custom-select" id="deptSubSect" disabled>
                  </select> -->
                  <input class="form-control" id="deptSubSect" value="<?=$empDeptSubSect?>" disabled>
                </div>
               <!-- LINE NO -->
                <?php
                  if (in_array($empDeptCode, $withLineDept)){
                ?>
                <div class="col">
                  <label for="empLineNo">Line No</label>
                  <!-- <select class="browser-default custom-select" id="empLineNo" disabled>
                  </select> -->
                  <input class="form-control" id="empLineNo" value="<?=$empLine?>" disabled>
                </div>
                <?php
                  }
                ?>
            </div>
          <!-- End Row 2 -->
          <!-- Row 3 / Admin-->
            <?php
              if($userType == 'admin'){
            ?>
            <div class="row">
              <!-- COST CENTER -->
                <div class="col">
                  <label for="empCost">Cost Center</label>
                  <select class="browser-default custom-select" id="empCost">
                  </select>
                </div>
              <!-- EMPLOYER -->
                <div class="col">
                  <label for="empAgency">Employer</label>
                  <select class="browser-default custom-select" id="empAgency">
                  </select>
                </div>
            </div>
              <?php
                }
              ?>
          <!-- End Row 3 / Admin  -->
          <!-- Row 3 / User -->
            <div class="row mt-3">
              <!-- AREA -->
                <div class="col">
                  <label for="empArea">Area</label>
                  <select class="browser-default custom-select" id="empArea">
                    <option value="A">A</option>
                    <option value="B">B</option>
                  </select>
                </div>
              <!-- ROUTE -->
                <div class="col">
                  <label for="empRoute">Route</label>
                    <select class="browser-default custom-select" id="empRoute">
                    </select>
                </div>
              <!-- SHIFT -->
                <div class="col">
                  <label for="empShift">Shift</label>
                  <select class="browser-default custom-select" id="empShift">
                    <option value="ADS">ADS</option>
                    <option value="DS">DS</option>
                    <option value="NS">NS</option>
                  </select>
                </div>
              <!-- SHIFT TIME -->
                <div class="col">
                  <label for="empShiftTime">Shift Time</label>
                  <select class="browser-default custom-select" id="empShiftTime">
                    <?php
                      $sql = "SELECT * FROM `a_m_sched`";
                      $query = $conn->query($sql);
                      while ($dat = $query->fetch_assoc()) {
                        $sched = $dat['schedTime'];
                        echo '<option value="'.$sched.'">'.$sched.'</option>';
                      }
                    ?>
                  </select>
                </div>
            </div>
          <!-- End Row 3 / User -->
          <!-- Button Rows -->
            <div class="row">
              <div class="col-lg-12 d-flex justify-content-end">
                <?php
                  if($userType == 'admin'){
                ?>
                  <button type="button" class="btn btn-outline-danger btn-sm mt-3 btnDeact" id="btn-Resign">Resign</button>
                  <button type="button" class="btn btn-outline-danger btn-sm mt-3 btnDeact" id="btn-AWOL">AWOL</button>
                  <button type="button" class="btn btn-outline-danger btn-sm mt-3 btnDeact" id="btn-Cancel">Cancelled</button>
                  <button type="button" class="btn btn-outline-danger btn-sm mt-3 btnDeact" id="btn-ML">Matertiny Leave</button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-outline-primary btn-sm mt-3" id="btnUpdate">Update Details</button>
            </div>
          <!-- Button Rows -->
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
  displayPosition();
  displayCostCenter();
  displayAgency();
  displayRoute();
  displayShift();
  determineRestriction('<?=$userType?>');
  // Realtime 
    notifNum();
});
  // FUNCTIONS TO UI
    // Display Position
      const displayPosition = () => {
        var pos = '<?=$empPosition?>';
        $('#empArea').val('<?=$empArea?>');
        if('<?=$userAgency?>' == 'FAS'){
          var req = 'a_m_position';
        }else if('<?=$userAgency?>' == ''){
          var req = 'a_m_position';
        }else{
          var req = 'ma_position';
        }
          $.ajax({
            url: 'functions/display/common_department.php?data='+req,
            method: 'get',
            success: function(response){
              $('#empPosition').html(response);
              $('#empPosition').val(pos);
            },error: function(){
            }
          });
      }
    // Display Cost Center
      const displayCostCenter = () => {
        var x = '<?=$empDeptCode?>';
        var cost = '<?=$empCostCenter?>';
        $.ajax({
          url: 'functions/display/common_department.php?data=m_cost&dept='+x,
          method: 'get',
          success: function(response){
            $('#empCost').html(response);
            $('#empCost').val(cost);
          },error: function(){
          }
        });
      }
    // Display Employer
      const displayAgency = () => {
        var agency = '<?=$empAgency?>';
        $.ajax({
          url: 'functions/display/common_department.php?data=a_m_agency',
          method: 'get',
          success: function(response){
            $('#empAgency').html(response);
            $('#empAgency').val(agency);
          },error: function(){

          }
        });
      }
    // Display Route
      const displayRoute = () => {
        var route = '<?=$empRoute?>';
        $.ajax({
          url: 'functions/display/common_user.php?data=sas_m_route',
          method: 'get',
          success: function(response){
            $('#empRoute').html(response);
            $('#empRoute').val(route);
          },error: function(){

          }
        });
      }
    // Display Shift
      const displayShift = () => {
        $('#empShift').val('<?=$empShift?>');
        $('#empShiftTime').val('<?=$empShiftTime?>');
      }
    // Restrictions
      const determineRestriction = (x) => {
        // Clerk 
        if(x == 'Clerk'){
          $('#newIDNum').prop('disabled', true);
          $('#newDateHired').prop('disabled', true);
          $('#newEmpName').prop('disabled', true);
          $('#empBatch').prop('disabled', true);
          $('#empPosition').prop('disabled', true);
          $('#empShift').prop('disabled', true);
        }else{
        // Admin
          var employer = '<?=$empAgency?>';
          if(employer == 'FAS'){
            $('#empAgency').prop('disabled', true);
            }
        }
      }
    // Determine if MP is Active
      const empStat = () => {
        var status = '<?=$status?>';
        if(status != 'Active'){
          $('#btnUpdate').prop('disabled',true);
          $('.btnDeact').prop('disabled',true);
        }
      }
  // Deactivate Manpower
    $('.btnDeact').click(function(){
      var idNumber = '<?=$idNumber?>';
      var btn = $(this).attr('id');
      var split = btn.split("-");
      var deact = split[1];
      Swal.fire({
        title: 'Confirm Employee Deactivation?',
        showCancelButton: true,
        confirmButtonText: `Save`
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'functions/process/admin_emp_master.php?process=deact_MP&user=<?=$userEmpName?>&idNumber='+idNumber+'&categ='+deact,
            method: 'get',
            success: function(response){
              if(response == 'done'){
                Swal.fire('Saved!', '', 'success');
                $('#btnUpdate').prop('disabled',true);
                $('.btnDeact').prop('disabled',true);
              }
            },error: function(response){
            }
          });
        }
      })
  });
  // Update Manpower Details
    $('#btnUpdate').click(function(){
        var datax = [];
      // Disabled Button
        $(this).prop("disabled",true);
      // Get Variables
        var oldIdNum = '<?=$empId?>';
        var newIdNumber = $('#newIDNum').val();
        var newEmpName = $('#newEmpName').val();
        var newEmpNickname = $('#newEmpNickname').val();
        var empContact = $('#empContact').val();
        var empPosition = $('#empPosition').val();
        var empCost = $('#empCost').val();
        var empArea = $('#empArea').val();
        var empRoute = $('#empRoute').val();
        var empShift = $('#empShift').val();
        var empShiftTime = $('#empShiftTime').val();
        var empAgency = $('#empAgency').val();
        var newDateHired = $('#newDateHired').val();
        var empBatch = $('#empBatch').val();

        if('<?=$userType?>' == 'Clerk'){
          datax = {
            "type": "clerk",
            "oldID": oldIdNum,
            "nickName": newEmpNickname,
            "contactNo": empContact,
            "empArea": empArea,
            "empRoute": empRoute,
            "empShiftTime": empShiftTime,
            "empPosition": empPosition,
            "empName": newEmpName,
            "empShift": empShift
          };
        }else{
          datax = {
            "type": "admin",
            "oldID": oldIdNum,
            "idNumber": newIdNumber,
            "empName": newEmpName,
            "dateHired": newDateHired,
            "batchNo": empBatch,
            "nickName": newEmpNickname,
            "contactNo": empContact,
            "empPosition": empPosition,
            "empCost": empCost,
            "empAgency": empAgency,
            "empArea": empArea,
            "empRoute": empRoute,
            "empShift": empShift,
            "empShiftTime": empShiftTime
          };
        }
        var data = JSON.stringify(datax);
      // Submit New Details
        $.ajax({
          url: 'functions/process/admin_emp_master.php?process=update_MP&user=<?=$userEmpName?>&empData='+data+'&userID=<?=$userId?>',
          method: 'get',
          success: function(response){
            $('#btnUpdate').prop("disabled",false);
            console.log(response);
            if(response == 'success'){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Employee details has been successfully updated',
                showConfirmButton: false,
                timer: 2000
              })
              setInterval(function(){
                var user = '<?=$userType?>';
                if(user == 'Clerk'){
                  window.location.replace("user-department.php");
                }else{
                  var employer = '<?=$userAgency?>';
                  if(employer != 'FAS'){
                    window.location.replace("admin-agency.php?employer="+employer);
                  }else{
                    window.location.replace("admin-department.php");
                  }
                }
              },2000);
            }else{
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please check your data. Duplicate ID Number!',
                showConfirmButton: false,
                timer: 2000
              })
            }
          },error: function(response){
          }
        });
    });
  // Real Time Counting 
    setInterval(function(){
      notifNum();
    }, 3000);
</script>
</body>
</html>




