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
  $employer = $_SESSION['agency']; 
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Department (Admin)</title>
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
<?php
  include 'src/navs/admin-topnav.php';
  include 'modals/ad-addEmployee.php';
  include 'modals/activeMP.php';
?>
<!-- ADDING LOADER -->
  <div id="loading" class="overlay">
    <div class="col-lg-12" style="">
      <p class="mt-5 animated flash infinite slow text-center text-white text-uppercase">Please wait. <br>Saving new employees..</p>
    </div>
  </div>
<!-- /ADDING LOADER -->
<!-- DELETING LOADER -->
	<div id="loading" class="overlayDel">
		<div class="col-lg-12" style="">
      <p class="mt-5 animated flash infinite slow text-center text-white text-uppercase">Please wait. <br>Deactivating employees..</p>
		</div>
	</div>
<!-- /DELETING LOADER -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <h3 class="card-title text-center mt-2">Employees </h3>
        <div class="card-body">
          <div class="row">
            <!-- Add Employees Section -->
              <div class="col-lg-6">
                <div class="card">
                    <h6 class="card-title text-center mt-2 mb-0">Add Employee</h6>
                  <div class="card-body pt-0 mt-0">
                    <form enctype="multipart/form-data" class="d-flex justify-content-end">
                      <button type="button" class="btn btn-outline-primary waves-effect btn-sm" id="addEmp"><i class="fas fa-user-plus" style="font-size:15px;"></i> Add New Employee</button>

                      <span class="btn btn-outline-default waves-effect btn-sm mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Multiple New Employees Upload
                      <input type="file" id="uploadNewEmp" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>

                      <a href="functions/templates/template-updater.php" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Template</a>
                    </form>
                  </div>
                </div>
              </div>
            <!-- /Add Employees Section -->
            <!-- Deactivate Employees Section -->
              <div class="col-lg-6">
                <div class="card">
                  <h6 class="card-title text-center mt-2 mb-0">Deactivate Employee</h6>
                  <div class="card-body pt-0 mt-0">
                    <form enctype="multipart/form-data" class="d-flex justify-content-end">
                      <span class="btn btn-outline-danger waves-effect btn-sm mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Upload Inactive Employees
                      <input type="file" id="uploadDeactEmp" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>

                      <a href="functions/templates/Employees for Deactivation.xlsx" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Template</a>
                      <a href="emp-view-inactive.php" class="btn btn-outline-primary waves-effect btn-sm mt-2"> <i class="fas fa-street-view" style="font-size:15px;"></i> View Inactive Employees</a>
                    </form>
                  </div>
                </div>
              </div>
            <!-- /Deactivate Employees Section -->
          </div>
          <div class="row mt-3 d-flex justify-content-end">
            <!-- Employee Status -->
              <div class="col-lg-6">
                <?php
                  // Generate Count of Employees 
                    $sql = "SELECT COUNT(idNumber) AS totA FROM `a_m_employee` WHERE `status` = 'Active'";
                    $query = $conn->query($sql);
                      $data = $query->fetch_assoc();
                      $countA = $data['totA'];
                    $sql = "SELECT COUNT(idNumber) AS totS FROM `a_m_employee` WHERE `status` = 'Suspended'";
                    $query = $conn->query($sql);
                      $data = $query->fetch_assoc();
                      $countS = $data['totS'];
                    $total = $countA + $countS;
                ?>
                <table class="table table-sm table-bordered text-center" onclick="activeMP();">
                  <thead>
                    <tr>
                      <th scope="col">Active</th>
                      <th scope="col">Suspended</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <th><?=$countA?></th>
                        <td><?=$countS?></td>
                        <td><?=$total?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            <!-- /Employee Status -->
          </div>
          <div class="form-row">
            <!-- Filter Employee Table -->
              <!-- Select Dept -->
                <div class="col">
                  <select class="browser-default custom-select" id="selectDept">
                  <option selected value="0">Select Department</option>
                  <?php
                    // Get Department Details to display in Select
                      $sqlGetDep = "SELECT deptCode,deptName FROM `a_m_department` GROUP BY deptCode ORDER BY deptName ASC";
                      $queryGet = $conn->query($sqlGetDep);
                        while ($deptData = $queryGet->fetch_assoc()) {
                          $deptCode = $deptData['deptCode'];
                          $deptName = $deptData['deptName'];
                          echo '<option value="'.$deptCode.'">'.$deptName.'</option>';
                        }
                  ?>
                  </select>
                </div>
              <!-- /Select Dept -->
                <label class="mt-2"> or </label>
              <!-- Filter by ID Number -->
                <div class="col">
                  <input type="text" id="empIdNum" class="form-control" placeholder="Enter ID Number">
                </div>
              <!-- /Filter by ID Number -->
                <div class="col">
                    <button class="btn btn-sm btn-primary" id="btnShowEmp">Show Employees</button>
                  <!-- Clear Filter -->
                    <button class="btn btn-sm btn-danger" id="btnClear">Clear</button>
                  <!-- Clear Filter -->
                  <!-- Export Accounting Report -->
                    <a href="functions/export/accounting.php" class="btn btn-sm btn-info">ACC Report</a>
                  <!-- Export Accounting Report -->
                </div>
            <!-- Filter Employee Table -->
          </div>
          <div class="form-row mt-2">
            <!-- Select Section -->
              <div class="col-3">
                <select class="browser-default custom-select" id="filterbySect" disabled>
                  <option selected value="0">Select Section</option>
                </select>
              </div>
              <div class="col-3">
                <button class="btn btn-sm btn-danger" id="btnExportSummary"><i class="fas fa-download"></i> Export Summary</button>
              </div>
            <!-- /Select Section -->
          </div>
            <div id="summary">
          <div class="row">
              <!-- Table of Employees -->
                <div class="col-lg-12 mt-3">
                  <table id="tblEmployees" class="table table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>ID Number</th>
                        <th>Date Hired</th>
                        <th>Batch Number</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Position</th>
                        <th>Cost Center</th>
                        <th>Employer</th>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Sub-Section</th>
                        <th>Line No</th>
                        <th>Area</th>
                        <th>Route</th>
                        <th>Shift</th>
                        <th>Shift Schedule</th>
                        <th>Handler</th>
                      </tr>
                    </thead>
                    <tbody id="tblEmp">
                    </tbody>
                  </table>
                </div>
              <!-- /Table of Employees  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include 'src/script.php';
?>
<script type="text/javascript">
$(document).ready(function(){
  $('#navDept').addClass('font-weight-bold');
  $('#navDept').css('color','#CC0000');
});
  //  FUNCTIONS TO UI
    // TABLE
      // Display Section of Selected Dept
        const displaySection = (x) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=m_deptSect&dept='+x,
            method: 'get',
            success: function(response){
              $('#filterbySect').html(response);
            },error: function(response){
              
            }
          });
        }
      // Functions for filter table UI
        $('#selectDept').click(function(){
          $('#empIdNum').val('');
          $('#empIdNum').prop('disabled',true);
          $('#filterbySect').val('0');
        });
        $('#empIdNum').click(function(){
          $('#selectDept').prop('disabled',true);
          $('#filterbySect').prop('disabled',true);
        });
        $('#btnClear').click(function(){
          $('#empIdNum').val('');
          $('#empIdNum').prop('disabled',false);
          $('#selectDept').prop('disabled',false);
          $('#selectDept').val('0');
          $('#filterbySect').prop('disabled',true);
          $('#filterbySect').val('');
        });
    // ADD
      // Display Modal
        $('#addEmp').click(function(){
          $('#addEmpMod').modal();
          displayPos();
          displayRoute();
          displayDept();
        });
      // Display Position
        const displayPos = () => {
          $.ajax({
            url: 'functions/display/common_department.php?data=a_m_position',
            method: 'get',
            success: function(response){
              $('#empPosition').html(response);
            },error: function(){
            }
          });
        }
      // Display Route
        const displayRoute = () => {
          $.ajax({
            url: 'functions/display/common_user.php?data=sas_m_route',
            method: 'get',
            success: function(response){
              $('#empRoute').html(response);
            },error: function(){
            }
          });
        }
      // Display Department
        const displayDept = () => {
          $.ajax({
            url: 'functions/display/common_department.php?data=a_m_department',
            method: 'get',
            success: function(response){
              $('#empDepartment').html(response);
            },error: function(){
            }
          });
        }
      // Display Cost
        const displayCostCenter = (x) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=m_cost&dept='+x,
            method: 'get',
            success: function(response){
              $('#empCost').html(response);
            },error: function(){
            }
          });
        }
    // MENU
      const displayMenu = (x) => {
        var y = x.split("/");
        var id = y[0];
        var name = y[1];
        Swal.fire({
          icon: 'info',
          showConfirmButton: false,
          showCloseButton: true,
          title: 'Select Action',
          footer: '<a class="btn btn-sm btn-primary" href="emp-view-history.php?empId='+id+'&empName='+name+'&role=admin">View Employee History</a><a class="btn btn-sm btn-primary" href="emp-update-details.php?emp='+x+'&role=admin">Update Details</a>'
        })
      }
  // Show Table
    // Generate Table
      $('#btnShowEmp').click(function(){
        var table = $('#tblEmployees').DataTable();
        table.destroy();
        // Table Dept
          if(!$('#selectDept').is(":disabled")){
            var deptCode = $('#selectDept').val();
            var data = deptCode;
            var type = 'dept';
          }
        // Table ID
          if(!$('#empIdNum').is(":disabled")){
            var idNum = $('#empIdNum').val();
            var data = idNum;
            var type = 'idNum';
          }
        // Table Section
        if(section != '0' && $('#selectDept').is(":disabled") && $('#empIdNum').is(":disabled")){
          var section = $('#filterbySect').val();
          var deptCode = $('#selectDept').val();
          var data = deptCode+'/'+section;
          var type = 'section';
        }
          $.ajax({
            url: 'functions/display/admin_emp_master.php?data=master_dept&type='+type+'&data1='+data,
            method: 'get',
            success: function(response){
              if(type == 'dept' || type == 'section'){
                $('#filterbySect').prop('disabled',false);
                displaySection(deptCode);
                $('#filterbySect').val(section);
              }else if(type == 'idNum'){
                $('#filterbySect').prop('disabled',true);
              }
              // Disable Filter Buttons
                $('#empIdNum').prop('disabled',true);
                $('#selectDept').prop('disabled',true);
              // Generate Table
                $('#tblEmp').html(response);
                $('#tblEmployees').DataTable({
                  "scrollX": true
                });
                $('.dataTables_length').addClass('bs-select');
            },error: function(response){
            }
          });
        });
  // Add Employee
    // Display Cost Center
      $('#empDepartment').change(function(){
        var x = $(this).val();
        displayCostCenter(x);
      });
    // Submit New Employee (Single)
      $('#submitNewEmp').click(function(){
          var stat1 = 'complete';
          var stat2 = 'complete';
        $(".modal-body input").each(function() {
          var x = $(this).attr('id');
          if($('#'+x).val() == ''){
            stat1 = 'inc';
          }else{
          }
        });
        $(".modal-body select").each(function() {
          var x = $(this).attr('id');
          if($('#'+x).val() == '0'){
            stat2 = 'inc';
          }else{
          }
        });
          if(stat1 == 'complete' && stat2 == 'complete'){
            datax = [];
            var newEmpId = $('#newIDNum').val();
            var newEmpName = $('#newEmpName').val();
            var newEmpNickname = $('#newEmpNickname').val();
            var newEmpContact = $('#empContact').val();
            var newEmpPosition = $('#empPosition').val();
            var newEmpDept= $('#empDepartment').val();
            var newEmpArea = $("input[name=empArea]:checked").val();
            var newEmpShift = $("input[name=empShift]:checked").val();
            var newEmpSsched = $("input[name=empShiftSched]:checked").val();
            var newEmpAgency = $('#empAgency').val();
            var newEmpRoute = $('#empRoute').val();
            var newEmpCost = $('#empCost').val();
            var dateHired = $('#dateHired').val();
            var batchNo = $('#empBatch').val();
            var datax = {
              "idNumber": newEmpId,
              "empName": newEmpName,
              "dateHired": dateHired,
              "batchNo": batchNo,
              "empNickName": newEmpNickname,
              "empcontact": newEmpContact,
              "empPosition": newEmpPosition,
              "empCostCenter": newEmpCost,
              "empAgency": newEmpAgency,
              "empDeptCode": newEmpDept,
              "empArea": newEmpArea,
              "empRoute": newEmpRoute,
              "empShift": newEmpShift,
              "empShiftTime": newEmpSsched,
              "jobType": 'Permanent'
            };
            var data = JSON.stringify(datax);
              $.ajax({
                url: 'functions/process/admin_emp_master.php?process=add_MP&user=<?=$userEmpName?>&newData='+data,
                method: 'get',
                success: function(response){
                  if(response == 'done'){
                    $('#addEmpMod').modal('toggle');
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Employee Added',
                        showConfirmButton: false,
                        timer: 2000
                      })
                    setInterval(function(){
                      location.reload();
                    },'2000');
                  }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Employee Already Exist! Please check the ID Number',
                        showConfirmButton: false,
                        timer: 2000
                      })
                  }
                },error: function(response){
                }
              });
          }else{
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Please complete employee details.',
              showConfirmButton: false,
              timer: 2000
          })
          }
      });
    // Submit New Employee (Bulk)
      $('#uploadNewEmp').change(function(){
        $('.overlay').show();
        var form_data = new FormData();
        var ins = document.getElementById('uploadNewEmp').files.length;
          for (var x = 0; x < ins; x++) {
            form_data.append("file", document.getElementById('uploadNewEmp').files[x]);
          }
          $.ajax({
            url: 'functions/uploads/uploadNewEmp.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response){
              $('.overlay').hide();
              Swal.fire({
                icon: 'info',
                showConfirmButton: false,
                showCloseButton: true,
                title: 'Uploading Status',
                text: response
              })
            },error: function (response){
            }
          });
      });
  // Deact Employee
    $('#uploadDeactEmp').change(function(){
      $('.overlayDel').show();
      var form_data = new FormData();
      var ins = document.getElementById('uploadDeactEmp').files.length;
        for (var x = 0; x < ins; x++) {
          form_data.append("file", document.getElementById('uploadDeactEmp').files[x]);
        }
      $.ajax({
        url: 'functions/uploads/deactivateEmp.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response){
          $('.overlayDel').hide();
          Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Deactivation Status',
            text: response
          })
        },error: function (response){
        }
      });
    });

  // View Active MP per Agency
    const activeMP = () => {
      $('#activeMPMod').modal();
      $.ajax({
        url: 'functions/display/admin_emp_master.php?data=active_emp_count',
        method: 'get',
        success: function (response){
          console.log(response);
          $('#tblActiveMP').html(response);
        },error: function(response){

        }
      })
    }
  // Download Table
    $('#btnExportSummary').click(function (e) {
      var table = $('#tblEmployees').DataTable();
      table.destroy();
      window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=summary]').html()));
      e.preventDefault();
      $('#tblEmployees').DataTable({
        "scrollX": true
      });
    });
</script>
</body>
</html>