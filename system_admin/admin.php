<!DOCTYPE html>
<html>
<head>
  <title>SAS Admin - HR Masterlist</title>
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
          <div class="row">
            <div class="col-lg-2 mb-2">
              <a href="index.php" class="btn btn-sm mdb-color lighten-3 text-white"><i class="fas fa-arrow-left"></i> Main Menu</a>
            </div>
          </div>
          <p class="note note-success d-flex justify-content-start text-uppercase">Admin User Management</p>
          <!-- Add Admin Account -->
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <p class="note note-primary d-flex justify-content-start text-uppercase">Add Admin Account</p>
                    <div class="form-row">
                      <div class="col">
                        <label for="nAgency">Employer</label>
                        <select class="browser-default custom-select" id="nAgency">
                        </select>
                      </div>
                      <div class="col">
                        <label for="nUser">ID Number</label>
                        <input list="dispUser" class="form-control" id="nUser">
                      </div>
                      <div class="col">
                        <label for="userName">Admin Name</label>
                        <input type="text" name="" id="nuserName" class="form-control">
                      </div>
                      <div class="col">
                        <label for="nPw">Password</label>
                        <input type="text" name="" id="nPw" class="form-control">
                      </div>
                      <div class="col">
                        <label for="nShift">Select Shift </label>
                          <select class="browser-default custom-select" id="nShift">
                            <option value="0" selected> -- </option>
                            <option value="DS">Day Shift</option>
                            <option value="ADS">Always Day Shift</option>
                            <option value="NS">Night Shift</option>
                          </select>
                      </div>
                      <div class="col">
                        <label for="btnAddUser">Submit Form </label>
                        <button id="btnAddUser" class="btn-sm btn-primary btn-block">Add User</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <!-- Display Admin Acc -->
          <div class="row mt-5">
            <div class="col-lg-12">
              <table class="table table-sm table-bordered table-hovered table-borderedtext-center" id="adAccTbl">
                <thead>
                  <tr>
                    <th colspan="5" class="text-center">Admin Accounts</th>
                  </tr>
                  <tr>
                      <th>Employer</th>
                      <th>User Name</th>
                      <th>Name</th>
                      <th>Password</th>
                      <th>Shift</th>
                  </tr>
                </thead>
                <tbody id="tblAdAcc">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
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
  displayAdminUsers();
  displayAgency();
});

  // FUNCTIONS AUTO UI
    // Display Admin Users
      const displayAdminUsers = () => {
        var table = $('#adAccTbl').DataTable();
          table.destroy();
          $.ajax({
            url: '../functions/display/admin_module.php?data=admin_users',
            method: 'get',
            success: function(response){
                // console.log(response);
              $('#tblAdAcc').html(response);
              $('#adAccTbl').DataTable();
              $('.dataTables_length').addClass('bs-select');
            },error: function(response){
                
            }
          });
      }
    // Display Employers
      const displayAgency = () => {
        $.ajax({
          url: '../functions/display/common_department.php?data=a_m_agency',
          method: 'get',
          success: function(response){
            $('#nAgency').html(response);
          },error: function(){

          }
        });
      }

  // Add Admin Accounts
    $('#btnAddUser').click(function(){
      var agency = $('#nAgency').val();
      var idNumber = $('#nUser').val();
      var userName = $('#nuserName').val();
      var password = $('#nPw').val();
      var shift = $('#nShift').val();
      var datax = { 
        "agency": agency,
        "idNumber": idNumber,
        "userName": userName,
        "password": password,
        "shift": shift
      };
      var data = JSON.stringify(datax);
      if(agency != '0' && idNumber != '' && userName != '' && password != '' && shift != '0'){
        $.ajax({
          url: '../functions/process/admin_module.php?process=add_admin_acc&data='+data,
          method: 'get',
          success: function(response){
            // console.log(response);
            if(response == 'success'){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Successfully added admin account!',
                showConfirmButton: false,
                timer: 2000
              })
                    $('#nAgency').html('0');
                    $('#nUser').val('');
                    $('#nuserName').val('');
                    $('#nPw').val('');
                    displayAdminUsers();
                    displayAgency();
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
          icon: 'error',
          title: 'Error',
          text: 'Please complete form.',
        });
      }

    }); 
  
  // Update Admin Account
    // Open Edit Modal
      const editAdAcc = (x,y) => {
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
            url: '../functions/process/admin_module.php?process=update_admin_pw&acc='+idNumber+'&newPW='+newPw,
            method: 'get',
            success: function(response){
              console.log(response);
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
                displayAdminUsers();
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
    //  Delete User Account
      $('#btnDeleteAcc').click(function(){
        var idNumber = $('#AccI').text();
        $.ajax({
          url: '../functions/process/admin_module.php?process=deact_admin_user&acc='+idNumber,
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
              displayAdminUsers();
            }
          },error: function(response){
          }
        });
      });
</script>
</body>
</html>

  
     