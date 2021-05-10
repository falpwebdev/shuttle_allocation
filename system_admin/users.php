<!DOCTYPE html>
<html>
<head>
  <title>SAS Admin - User Masterlist</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="../img/sas-logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mdb.min.css">
  <link rel="stylesheet" href="../css/style.css?v=2">
  <link href="../css/addons/datatables.min.css" rel="stylesheet">
  <link href="../css/addons/datatables-select.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../lib/fontawesome-free-5.9.0-web/css/all.css">
  <style type="text/css">
  </style>
</head>
<body>
<?php
  include 'modals/editAccount.php';
?>
<h2 class="card-title text-white z-depth-5  mdb-color lighten-3">SAS Admin</h2>
<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!-- Main Menu -->
          <div class="row">
            <div class="col-lg-2 mb-2">
              <a href="index.php" class="btn btn-sm mdb-color lighten-3 text-white"><i class="fas fa-arrow-left"></i> Main Menu</a>
            </div>
          </div>
            <p class="note note-success d-flex justify-content-start text-uppercase">User Management</p>
          <!-- ADD USER ACCOUNTS -->
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-lg-12">
                <p class="note note-primary d-flex justify-content-start text-uppercase">Add User Account</p>
                <div class="form-row">
                  <div class="col">
                    <label for="type">Choose Acccount Type</label>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input type" id="typeClerk" name="type" value="Clerk">
                      <label class="custom-control-label" for="typeClerk">Clerk</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" class="custom-control-input type" id="typeLine" name="type" value="Line Leader">
                      <label class="custom-control-label" for="typeLine">Line Number</label>
                    </div>
                  </div>
                  <div class="col">
                    <label for="nDepts">Department</label>
                    <select class="browser-default custom-select" id="nDepts">
                    </select>
                  </div>
                  <div class="col">
                     <label for="nSect">Handle (<span id="handleL"></span>)</label>
                     <select class="browser-default custom-select" id="nHandle">
                    </select>
                  </div>
                  <div class="col">
                    <label for="nUser">ID Number</label>
                    <input list="dispUser" class="form-control" id="nUser">
                      <datalist id="dispUser">
                      </datalist>
                  </div>
                  <div class="col">
                    <label for="userName">Employee Name</label>
                    <input type="text" name="" id="nuserName" class="form-control" readonly>
                  </div>
                </div>
                <div class="form-row mt-2">
                  <div class="col">
                    <label for="nID">User Name</label>
                    <input type="text" name="" id="nID" class="form-control">
                  </div>
                  <div class="col">
                    <label for="nPw">Password</label>
                    <input type="text" name="" id="nPw" class="form-control">
                  </div>
                  <!-- <div class="col">
                    <label for="nShift">Select Shift </label>
                      <select class="browser-default custom-select" id="nShift">
                        <option value="0" selected> -- </option>
                        <option value="DS">Day Shift</option>
                        <option value="ADS">Always Day Shift</option>
                        <option value="NS">Night Shift</option>
                      </select>
                  </div> -->
                  <div class="col">
                    <label for="btnAddUser">Submit Form </label>
                    <button id="btnAddUser" class="btn-sm btn-primary btn-block">Add User</button>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
         
          <!-- END ADD USER ACCOUNTS -->
          <div class="row mt-5">
            <div class="col-lg-12">
              <table class="table table-sm table-bordered table-hovered table-borderedtext-center" id="accTbl">
                <thead>
                  <tr>
                    <th colspan="8" class="text-center">User Account</th>
                  </tr>
                  <tr>
                      <th>User Name</th>
                      <th>Name</th>
                      <th>Password</th>
                      <th>Department</th>
                      <th>Section / Line</th>
                      <th>Position</th>
                      <th>Shift</th>
                      <th>Type</th>
                  </tr>
                </thead>
                <tbody id="tblAcc">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <div>
    </div>
  </div>
</div>
<!-- SCRIPTS -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
  <script type="text/javascript" src="../js/addons/datatables.min.js"></script>
  <script src="../js/addons/datatables-select.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="../js/addons/datatables-select2.min.js"></script>
  <script src="../js/sweetalert.js"></script>
<!-- /SCRIPTS -->

<script>
$(document).ready(function(){
  displayUsers();
});
  // FUNCTIONS AUTO UI
    // Display Department
      const displayADept = () => {
        $.ajax({
          url: '../functions/display/common_department.php?data=a_m_department',
          method: 'get',
          success: function(response){
            $('#nDepts').html(response);
          },error: function(){

          }
        });
      }
    // Display Section
      const displaySect = (deptCode) => {
        $.ajax({
          url: '../functions/display/common_department.php?data=m_deptSect&dept='+deptCode,
          method: 'get',
          success: function(response){
            $('#nHandle').html(response);
            var sect = $('#nHandle').val();
            var handle = sect.replace("&","@");
            deptEmp(deptCode,handle,"Clerk");
          },error: function(response){
            
          }
        });
      }
    // Display Lines 
      const displayLine = (deptCode) => {
        $.ajax({
          url: '../functions/display/admin_module.php?data=m_dept_line&dept='+deptCode,
          method: 'get',
          success: function(response){
            if(response != 'false'){
              $('#nHandle').html(response);
              var handle1 = $('#nHandle').val();
              var handle = handle1.replace("&","@");
              deptEmp(deptCode,handle,"Line Leader");
            }else{
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'No line number registered under this department.',
                showConfirmButton: false,
                timer: 2000
              })
            }
          },error: function(response){
            
          }
        });
      }
    
    // Display Accounts in the table
      const displayUsers = () => {
        var table = $('#accTbl').DataTable();
        table.destroy();
        $.ajax({
          url: '../functions/display/admin_module.php?data=li_users',
          method: 'get',
          success: function(response){
            $('#tblAcc').html(response);
            $('#accTbl').DataTable();
            $('.dataTables_length').addClass('bs-select');
          },error: function(response){
            
          }
        });
      }

    // Display ID Numbers
      const deptEmp = (deptCode,handle,type) => {
        $.ajax({
          url: '../functions/display/admin_module.php?data=m_id_employee&dept='+deptCode+'&handler='+handle+'&type='+type,
          method: 'get',
          success: function(response){
            $('#dispUser').html(response);
          },error: function(response){
            
          }
        });
      }
  // Add User Account
      // Display in Select Handle
        $('.type').click(function(){
          displayADept();
          var type = $(this).val();
          if(type == 'Clerk'){
            $('#handleL').text('Section');
            $('#nHandle').html('');
          }else if(type == 'Line Leader'){
            $('#handleL').text('Line Number');
            $('#nHandle').html('');
          }
        });
      // Display Section of Department
        $('#nDepts').change(function(){
          var type = $('input[name="type"]:checked').val();
          var deptCode = $('#nDepts').val();
          if(type == 'Clerk'){
            displaySect(deptCode);
          }else if(type == 'Line Leader'){
            displayLine(deptCode);
          }
        });
      // Display ID Numbers in the Department
        $('#nHandle').change(function(){
          var type = $('input[name="type"]:checked').val();
          var deptCode = $('#nDepts').val();
          var sect = $('#nHandle').val();
            var deptSection = sect.replace("&","@");
            deptEmp(deptCode,deptSection,type);
        });
      // Display Name of Selected ID 
        $('#nUser').change(function(){
          var idNumber = $(this).val();
            $.ajax({
              url: '../functions/display/admin_module.php?data=m_name_emp&idNumber='+idNumber,
              method: 'get',
              success: function(response){
                if(response != 'false'){
                  $('#nuserName').val(response);
                }else{
                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Employee does not exist! Kindly add in the Employee Masterlist',
                    showConfirmButton: false,
                    timer: 2000
                  })
                }
              },error: function(response){
                
              }
            });
        });
      // Submit New Account     
        $('#btnAddUser').click(function(){
          var type = $('input[name="type"]:checked').val();
          var dept = $('#nDepts').val();
          var handle1 = $('#nHandle').val();
          var handle = handle1.replace("&","@");
          var userName = $('#nuserName').val();
          var idNumber = $('#nID').val();
          var userID = $('#nUser').val();
          var password = $('#nPw').val();
          var datax = {
            "idNumber": idNumber,
            "userID": userID,
            "userName": userName,
            "dept": dept,
            "handle": handle,
            "password": password,
            "type": type
          };
          var data = JSON.stringify(datax);
          if(type != '' && dept != '0' && handle != '' && userName != '' && idNumber != '' && password != ''){
            $.ajax({
              url: '../functions/process/admin_module.php?process=add_user_acc&data='+data,
              method: 'get',
              success: function(response){
                if(response == 'success'){
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successfully added user account!',
                    showConfirmButton: false,
                    timer: 2000
                  })
                  $('#nDepts').html('');
                  $('#nHandle').html('');
                  $('#nuserName').val('');
                  $('#nID').val('');
                  $('#nUser').val('')
                  $('#nPw').val('');
                  displayUsers();
                }else{
                  Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Account already exist. Kindly check in the masterlist.',
                    showConfirmButton: false,
                    timer: 2000
                  })
                }
              },error: function(response){
              }
            })
          }else{
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Please complete form.',
              showConfirmButton: false,
              timer: 2000
            })
          }
        });
  // Update User Account
      // Open Edit Modal
        const editAcc = (x,y) => {
          $('#editAccMod').modal();
          $('#AccI').text(x);
          $('#userID').val(x);
          $('#oldPw').val(y);
        }
      // Update User Account
        $('#btnUpdateAcc').click(function(){
          var idNumber = $('#AccI').text();
          var newPw = $('#newPw').val();
          $.ajax({
            url: '../functions/process/admin_module.php?process=update_pw_acc&acc='+idNumber+'&newPW='+newPw,
            method: 'get',
            success: function(response){
              if(response == 'success'){
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Successfully updated user password!',
                  showConfirmButton: false,
                  timer: 2000
                })
                $('#AccI').text('');
                $('#oldPw').val('');
                $('#newPw').val('');
                $('#editAccMod').modal('toggle');
                displayUsers();
              }else{
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Please try again.',
                  showConfirmButton: false,
                  timer: 2000
                })
              }

            },error: function(response){
              
            }
          }); 
        });
      // Delete User Account
        $('#btnDeleteAcc').click(function(){
          var idNumber = $('#AccI').text();
          $.ajax({
              url: '../functions/process/admin_module.php?process=deact_user_acc&acc='+idNumber,
              method: 'get',
              success: function(response){
                if(response == 'success'){
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successfully deleted user!',
                    showConfirmButton: false,
                    timer: 2000
                  })
                  $('#AccI').text('');
                  $('#editAccMod').modal('toggle');
                  displayUsers();
                }
              },error: function(response){

              }
          });
        });
</script>
</script>
</body>
</html>
            

