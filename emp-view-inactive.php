<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  include 'db/config.php';
  $userId =$_SESSION['idNumber'];
  $userEmpName = $_SESSION['empName']; 
  $employer = $_SESSION['agency']; 
  $dateNow = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Inactive Employees</title>
<?php
  include 'src/style.php';
?>
</style>
</head>
<body>
<?php
  if($employer == 'FAS'){
    include 'src/navs/admin-topnav.php';
  }else{
    include 'src/navs/agency-topnav.php';
  }
  include 'modals/empReturnEmp.php';
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <h3 class="card-title text-center mt-2">Inactive Manpower</h3>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <h4 class="card-title ml-1 mt-2">Filter Category</h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                      <select class="browser-default custom-select" id="btnFilter">
                        <option selected>Field</option>
                        <option value="idNumber">ID Number</option>
                        <option value="empName">Name</option>
                        <option value="empDeptCode">Department</option>
                        <option value="dateHired">Date Hired</option>
                        <option value="batchNo">Batch Number</option>
                        <option value="monthYear">Month & Year Hired</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <div class="md-form mt-0" id="inputText" style="display:none;">
                        <input type="text" id="iText" class="form-control iText">
                        <label for="" id="lText">ID Number</label>
                      </div>
                      <div class="mt-0" id="inputSelect" style="display:none;">
                        <select class="browser-default custom-select" id="inputSel">
                        </select>
                      </div>
                      <div class="mt-0" id="inputDate" style="display:none;">
                        <input type="date" name="date" id="date" class="form-control">
                      </div>
                      <div class="mt-0" id="monthYear" style="display:none;">
                        <input type="month" name="inputMonth" id="inputMonth" class="form-control">
                      </div>
                    
                    </div>
                    <div class="col-7">
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input dCategory" id="AWOL" disabled>
                        <label class="custom-control-label" for="AWOL">AWOL</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input dCategory" id="Cancel" disabled>
                        <label class="custom-control-label" for="Cancel">Cancelled</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input dCategory" id="Resign" disabled>
                        <label class="custom-control-label" for="Resign">Resigned</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input dCategory" id="Suspended" disabled>
                        <label class="custom-control-label" for="Suspended">Suspended</label>
                      </div>
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input dCategory" id="ML" disabled>
                        <label class="custom-control-label" for="ML">ML</label>
                      </div>
                      <button type="button" class="btn btn-default btn-sm" id="btnViewData">View Data</button>
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
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
           <div class="col-lg-12 d-flex justify-content-end">
            <div class="card">
              <div class="card-body mx-0 px-0">
                <!-- <div class="row"> -->
                  <div class="d-flex flex-row">
                    <div class="p-2 ml-1 rgba-blue-light">Resigned</div>
                    <div class="p-2 ml-1 rgba-pink-strong">AWOL</div>
                    <div class="p-2 ml-1 rgba-red-strong">Cancelled</div>
                    <div class="p-2 ml-1 mr-1 rgba-indigo-strong">Suspended</div>
                    <div class="p-2 ml-1 mr-1 rgba-grey-light">Maternity Leave</div>
                  </div>
                <!-- </div> -->
              </div>
            </div>
           </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mt-3">
              <table id="tblEmployees" class="table table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>ID Number</th>
                    <th>Date Hired</th>
                    <th>Batch Number</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Position</th>
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
  
});
var task = 0;
$('#btnFilter').change(function(){
  let field = $('#btnFilter').val();
    $('#inputText').hide();
    $('#inputSelect').hide();
    $('#inputDate').hide();
    $('#monthYear').hide();
  // console.log('xx');
  if(field == 'idNumber'){
    task = 1;
    $('.dCategory').prop('disabled',true);
    $('#inputText').show();
    $('#lText').text('ID Number');
  }else if(field == 'empName'){
    task = 1;
    $('.dCategory').prop('disabled',true);
    $('#inputText').show();
    $('#lText').text("Name (LN, FN MI.)");
  }else if(field == 'empDeptCode'){
    task = 2;
    $('.dCategory').prop('disabled',false);
    $('#inputSelect').show();
    displayDept();
  }else if(field == 'dateHired'){
    task = 2;
    $('.dCategory').prop('disabled',false);
    $('#inputDate').show();
  }else if(field == 'batchNo'){
    task = 2;
    $('.dCategory').prop('disabled',false);
    $('#inputText').show();
    $('#lText').text('Batch Number');
  }else if(field == 'monthYear'){
    task = 2;
    $('.dCategory').prop('disabled',false);
    $('#monthYear').show();
  }
  $('#iText').val('');
});

$('#btnViewData').click(function(){
  var table = $('#tblEmployees').DataTable();
  table.destroy();
  var field = $('#btnFilter').val();
  var fieldData = '';
  //  Determine Filter type
  if(field == 'idNumber' || field == 'empName' || field == 'batchNo'){
    fieldData = $('#iText').val();
  }else if(field == 'empDeptCode'){
    fieldData = $('#inputSel').val();
  }else if(field == 'monthYear'){
    fieldData = $('#inputMonth').val();
  }else if(field == 'dateHired'){
    fieldData = $('#date').val();
  }
  // Get Data needed
  if(task == 1){
  }else if (task == 2 || field == 'batchNo'){
    var categories = [];
    $('.dCategory:checkbox:checked').each(function(){
      var categ = $(this).attr('id');
      categories.push(categ);
    });
    var datCategories = JSON.stringify(categories);
  }
  $.ajax({
    url: 'functions/display/admin_emp_master.php?data=emp_inactive&task='+task+'&filterBy='+field+'&data1='+fieldData+'&category='+datCategories+'&employer=<?=$employer?>',
    method: 'get',
    success: function(response){
      // console.log(response);
      $('#tblEmp').html(response);
      $('#tblEmployees').DataTable({
        "scrollX": true
      });
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
    }
  });
});

$('#btnConfirmReturn').click(function(){
  var idNumber =  $('#idNumber').val();
  var type =  $('#type').val();
  var date =  $('#date').val();
  var remarks =  $('#remarks').val();
  var handler = $('#handler').val();
  $.ajax({
    url: 'functions/process/admin_emp_master.php?process=return_MP&idNumber='+idNumber+'&date='+date+'&remarks='+remarks+'&user=<?=$userId?>&userName=<?=$userEmpName?>&handler='+handler,
    method: 'get',
    success: function(response){
      console.log(response);
      if(response == 'done'){
            $('#modReturn').modal('toggle');
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Employee can now be added in master.',
                showConfirmButton: false,
                timer: 2000
              })
              setInterval(function(){
                location.reload();
              },'2000');
          }

    },error: function(response){

    }
  });
});
const returnEmp = (x) => {
  var y = x.split("/");
  var id = y[0];
  var name = y[1];
  var type = y[2];
  var handler = y[3];
  $('#modReturn').modal();
  $('#idNumber').val(id);
  $('#name').val(name);
  $('#type').val(type);
  $('#handler').val(handler);
}


// Functions
const displayDept = () => {
  $.ajax({
    url: 'functions/display/common_department.php?data=ma_department',
    method: 'get',
    success: function(response){
      $('#inputSel').html(response);
    },error: function(){
      
    }
  });
}
</script>
</body>
</html>