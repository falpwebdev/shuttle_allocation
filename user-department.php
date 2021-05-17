<?php
  $interface = 'department';
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  if(isset($_SESSION['dept'])){
    $dept = $_SESSION['dept'];
  }
?>
<?php
  include 'db/config.php';
  include 'functions/inc/user-shuttle.php';
  include 'functions/inc/inc.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>FS - My Department </title>
  <?php
    include 'src/style.php';
  ?>
  <style>
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
  if($userType == 'Agency'){
    include 'src/navs/agency-topnav.php';
  }else {
    include 'src/navs/topnav.php';
  }
  include 'modals/transferEmp.php';
  include 'modals/changeShift.php';
  include 'modals/processingUI.php';
?>
<!-- ADDING LOADER -->
<div id="loading" class="overlay">
	<div class="col-lg-12" style="">
    <p class="mt-5 animated flash infinite slow text-center text-white text-uppercase">Please wait. <br>Updating employees..</p>
	</div>
</div>
<!-- /ADDING LOADER -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <h4 class="card-title text-center mt-3">EMPLOYEE MASTER (<?=$userHandle?>)</h4>
        <div class="card-body">
          <!-- Main Button Section -->
            <?php
              if($userHandle == 'Recruitment and Training'){
            ?>
              <div class="row d-flex">
                <form enctype="multipart/form-data" class="d-flex justify-content-end">
                  <a href="functions/templates/line-updater.php" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Template</a>
                  <span class="btn btn-outline-default waves-effect btn-sm mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Upload Transfer
                  <input type="file" id="uploadBulkTrans" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>
                </form>
              </div>
            <?php
              }
            ?>

          <!-- Filters Section -->
            <div class="row">
              <div class="col-lg-6 d-flex justify-content-start">
                <button type="button" class="btn btn-sm btn-info waves-effect" id="btnFilter">Filters</button>
                <button type="button" class="btn btn-sm btn-primary filters" style="display:none;" id="btnFilterNow">Generate</button>
                <button type="button" class="btn btn-sm btn-danger filters" style="display:none;" id="btnClear">Clear</button>
              </div>
              <div class="col-lg-6 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-primary waves-effect" id="btnSelectAll">Select All</button>
                <button type="button" class="btn btn-sm btn-outline-cyan waves-effect generateChecked" id="btnTransfer">Transfer</button>
                <button type="button" class="btn btn-sm btn-outline-unique waves-effect generateChecked" id="btnChangeShift">Change Shift</button>
              </div>
            </div>
            <div class="row mt-3" id="filters" style="display:none;">
              <div class="col">
                <label for="filDept">Department</label>
                <select class="browser-default custom-select" id="filDept">
                </select>
              </div>
              <div class="col">
                <label for="filSect">Section</label>
                <select class="browser-default custom-select" id="filSect">
                </select>
              </div>
              <div class="col">
                <label for="filSubDept">Sub Section</label>
                <select class="browser-default custom-select" id="filSubDept">
                </select>
              </div>
                <?php
                  if (in_array($dept, $withLineDept)){
                    echo '
                    <div class="col">
                      <label for="filLine">Line</label>
                      <select class="browser-default custom-select" id="filLine">
                      </select>
                    </div>';
                  }else{
                    echo '<input type="hidden" id="filLine" value="0">';
                  }
                ?>
              <div class="col">
                <label for="filDate">Date Hired</label>
                <input type="date" class="form-control" id="filDate">
              </div>
            </div>
          
          <!-- Table Section -->
            <div class="row mt-2">
              <div class="col-lg-12"> 
                <table class="table table-sm table-bordered" id="tblHandle">  
                  <thead>
                    <tr>
                      <th></th>
                      <th>ID Number</th>
                      <th>Name</th>
                      <th>Date Hired</th>
                      <th>Contact</th>
                      <th>Department</th>
                      <th>Position</th>
                      <th>Shift</th>
                      <th>Area</th>
                      <th>Route</th>
                      <?php
                      if(isset($dept)){
                        if (in_array($dept, $withLineDept)){
                          echo '<th>Line No</th>';
                        }
                      }
                      ?>
                      <th>Shift Schedule</th>
                      <th>Section</th>
                      <th>Sub-Section</th>
                      <th>Employer</th>
                    </tr>
                  </thead>
                  <tbody id="tblEmpHandle">
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
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
    // Navs
      $('#navDept').addClass('font-weight-bold');
      $('#navDept').css('color','#CC0000');
    // Realtime
    filingMPCount();
    notifNum();
    // Display Department Handle
      var data1 = '<?=$userHandle?>';
      var data = data1.replace("&","@");
        displayEmpHandle(data);
  });
    // Real Time Counting 
      setInterval(function(){
        filingMPCount();
        notifNum();
      }, 3000);
      
      const filingMPCount = () => {
        var data = '<?=$handle?>';
        var handle = data.replace("&","@");
        $.ajax({
          url: 'functions/process/realtime_count.php?process=filingMP_count&handle='+handle+'&type=<?=$userType?>&interface=<?=$interface?>',
          method: 'get',
          success: function(response){
            // console.log(response);
            if('<?=$totcount?>' != response){
              Swal.fire({
                title: 'This page needs to reload. Your masterlist have been changed!',
                showCancelButton: false,
                confirmButtonText: `Okay`,
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })    
            }
          },error: function(response){
          }
        });
    }
    // FUNCTIONS TO DISPLAY IN UI
      // Display Handled MP
        const displayEmpHandle = (x) => {
          $.ajax({
            url: 'functions/display/user_department.php?data=handleMP&handle='+x,
            method: 'get',
            success: function(response){
              $('#tblEmpHandle').html(response);
              $('#tblHandle').DataTable({
                scrollX: "true",
                scrollY: "480px",
                scrollCollapse: true,
                paging: false
              });
            },error: function(response){
            }
          });
        }
      // Display Menu
        const displayMenu = (x) => {
          var y = x.split("/");
          var id = y[0];
          var name = y[1];
          var role = '<?=$userType?>';
          Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Select Action',
            footer: '<a class="btn btn-sm btn-primary" href="emp-view-history.php?empId='+id+'&empName='+name+'&role='+role+'">View Employee History</a><a class="btn btn-sm btn-primary" href="emp-update-details.php?emp='+x+'&role='+role+'">Update Details</a>'
          })
        }
      // Select/UnSelect All Button
        $('#btnSelectAll').click(function(){
          var text = $(this).text();
          if(text == 'Select All'){
            $('#tblEmpHandle .empC').prop("checked",true);
            $(this).text('Unselect All');
          }else{
            $('#tblEmpHandle .empC').prop("checked",false);
            $(this).text('Select All');
          }
        });
      // Transfer button Functions
        $('#btnSubmitTrans').hover(function(){
          $('#note').addClass('animated bounce infinite');
        });
        $('#btnSubmitTrans').mouseleave(function(){
          $('#note').removeClass('animated bounce infinite');
        });
    // FILTER TABLE
      // Display Filtering Buttons
        $('#btnFilter').click(function(){
          var data = '<?=$handle?>';
          var handle = data.replace("&","@");
          $('#filters').toggle();
          $('#filters').addClass('animated fadeIn text-info');
          $('.filters').toggle();
          displayFilter(handle);
        });
      // Display Filter Values
        const displayFilter = (x) => {

          // Department
            $.ajax({
              url: 'functions/display/user_department.php?data=filterData&handler='+x+'&categ=dept',
              method: 'get',
              success: function(response){
                $('#filDept').html(response);
              },error: function(response){
              }
            });
          // Section
            $.ajax({
              url: 'functions/display/user_department.php?data=filterData&handler='+x+'&categ=sect',
              method: 'get',
              success: function(response){
                $('#filSect').html(response);
              },error: function(response){
              }
            });
          // Sub-Section
            $.ajax({
              url: 'functions/display/user_department.php?data=filterData&handler='+x+'&categ=sub',
              method: 'get',
              success: function(response){
                $('#filSubDept').html(response);
              },error: function(response){
              }
            });
          // Line Number
            $.ajax({
              url: 'functions/display/user_department.php?data=filterData&handler='+x+'&categ=line',
              method: 'get',
              success: function(response){
                $('#filLine').html(response);
              },error: function(response){
              }
            });
        }
      // Submit Filter
        $('#btnFilterNow').click(function(){
          // $('#btnSelectAll').text('Select All');
            var filDept = $('#filDept').val();
            var secDept1 = $('#filSect').val();
              var secDept = secDept1.replace("&","@");
            var subDept1 = $('#filSubDept').val();
              var subDept = subDept1.replace("&","@");
            var line = $('#filLine').val();
            var dateHired = $('#filDate').val();
            var host = '<?=$handle?>';
            var host = host.replace("&","@");
              $.ajax({
                url: 'functions/display/user_department.php?data=filterTable&filterDept='+filDept+'&filterSect='+secDept+'&filterSub='+subDept+'&line='+line+'&host='+host+'&dateHired='+dateHired,
                method: 'get',
                success: function(response){
                  var table = $('#tblHandle').DataTable();
                  table.destroy();
                  $('#tblEmpHandle').html(response);
                $('#tblHandle').DataTable({
                  scrollX: "true",
                  scrollY: "480px",
                  scrollCollapse: true,
                  paging: false
                });
                },error: function(response){
                }
              });
        });
      // Clear Table Filter
        $('#btnClear').click(function(){
          location.reload();
        });
    // CHANGE SHIFT
      // Display Change Shift Modal
        $('#btnChangeShift').click(function(){
          $('#tbltoChange').html('');
          var checked = 'none';
          $('#tblEmpHandle>tr').each(function(){
            var datID = $(this).attr('id');
            if($('#C'+datID).prop('checked') == true){
              var data = $('#C'+datID).val();
              data = data.split("/");
              var shift = data[4];
              var idData = 'CS'+data[0];
                if(shift == 'DS' || shift == 'ADS'){
                  var shiftTo = 'NS';
                }else{
                  var shiftTo = 'DS';
                }
                $('#tbltoChange').append('<tr id="'+idData+'"><td>'+data[0]+'</td><td>'+data[1]+'</td><td>'+data[3]+'</td><td>'+data[4]+'</td><td>'+shiftTo+'</td></tr>');
                checked = '1';
            }
          });
          if(checked != '1'){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please select employees',
                showConfirmButton: false,
                timer: 1500
              })
          }else{
            $('#changeShiftMod').modal();
          }
        });
      // Submit Change Shift
        $('#btnSubmitChangeShift').click(function(){
          // Variable
            var empChangeShift = [];
            var count = 1;
            var stats = 'false';
          // Get Change Shift MP
            $('#tbltoChange>tr').each(function(){
              var id = $(this).attr('id');
              empChangeShift.push(id);
            });
            var empDat = JSON.stringify(empChangeShift);
          // Change Shift MP
            $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
            var arrayCount = empChangeShift.length;
            $('#processingProgress').attr('aria-valuemax',arrayCount);
            
            empChangeShift.forEach(id => {
              id = id.replace('CS','');
              $.ajax({
                url: 'functions/process/user_department.php?process=changeShiftEmp&empID='+id+'&user=<?=$userId?>',
                method: 'get',
                success: function(response){
                  $('#status').text(response);
                  var percent = (count / arrayCount) * 100;
                  $('#processingProgress').attr('aria-valuemax',count).css('width', percent+'%');
                  $('#count').text(count+' updated.');
                  count = count + 1;
                  if(count == arrayCount){
                    setTimeout(() => {
                      Swal.fire(
                      'Success!',
                      'Change Shift done',
                      'success'
                      )
                        setInterval(function(){
                          location.reload();
                        },2000);
                    }, 2000);
                  }
                },error: function(response){
                  
                }
              });
            });
        });
    // Transfer Employee
      // Open Transfer Modal
        $('#btnTransfer').click(function(){
          // Variables
            var count = 0;
            var checked = 'none';
          // UI
            $('#tbltoTrans').html('');
          // Get Checked
            $('#tblEmpHandle>tr').each(function(){
                var datID = $(this).attr('id');
                if($('#C'+datID).prop('checked') == true){
                  checked = '1';
                  var data = $('#C'+datID).val();
                  data = data.split("/");
                  deptsx = data[2];
                  // Determine if Same Department
                    if(count == 0){
                      first = deptsx;
                      $('#tbltoTrans').append('<tr id="'+data[0]+'"><td>'+data[0]+'</td><td>'+data[1]+'</td><td>'+data[3]+'</td></tr>');
                    }else{
                      next = deptsx;
                      if(first != next){
                        checked = '2';
                        Swal.fire({
                          position: 'center',
                          icon: 'error',
                          title: 'Employees selected does not have the same department.',
                          showConfirmButton: true
                        })
                      }else{
                        $('#tbltoTrans').append('<tr id="'+data[0]+'"><td>'+data[0]+'</td><td>'+data[1]+'</td><td>'+data[3]+'</td></tr>');
                      }
                    }
                  count++;
                }
            });
            if(checked == 'none'){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please select employees',
                showConfirmButton: false,
                timer: 1500
              })
            }else if(checked == '1'){
              $('#transferMod').modal();
              displayDept(first);
            }
        });
      // Display Department
        const displayDept = (x) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=a_m_department',
            method: 'get',
            success: function(response){
              $('#empDept').html(response);
              $('#empDept').val(x);
              displaySection(x);
            },error: function(){
            }
          });
        }
      // Display Section
        const displaySection = (x) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=m_deptSect&dept='+x,
            method: 'get',
            success: function(response){
              $('#deptSect').html(response);
              var y = $('#deptSect').val();
              y = y.replace("&","@");
              displaySubSect(x,y);
            },error: function(response){
              
            }
          });
        }
      // Display Sub-Section
        const displaySubSect = (x,y) => {
          var deptwithLine = new Array();
            <?php 
              foreach($withLineDept as $key => $val){ 
            ?>
              deptwithLine.push('<?=$val;?>');
            <?php
              } 
            ?>
          $.ajax({
            url: 'functions/display/common_department.php?data=m_deptSubSect&dept='+x+'&sect='+y,
            method: 'get',
            success: function(response){
              $('#deptSubSect').html(response);

                if(deptwithLine.includes(x) == true){
                  $('#lineDisp').show();
                  var deptSubSect =  $('#deptSubSect').val();
                  var z = deptSubSect.replace("&","@");
                  displayLine(x,y,z);
                }else{
                  $('#lineDisp').hide();
                  $('#lineNo').val(0);
                }
            },error: function(response){
            }
          });
        }
      // Display Line 
        const displayLine = (x,y,z) => {
          $.ajax({
            url: 'functions/display/common_department.php?data=m_line&dept='+x+'&sect='+y+'&subSect='+z,
            method: 'get',
            success: function(response){
              $('#lineNo').html(response);
            },error: function(){

            }
          });
        }
      // Display Selected Department Details
        $('#empDept').change(function(){
          var dept = $(this).val();
          displaySection(dept);
        });
      // Display Selected Section Details
        $('#deptSect').change(function(){
          var dept = $('#empDept').val();
          var sect = $('#deptSect').val();
          displaySubSect(dept,sect);
        });
      // Display Selected Sub-Section Line Details
        $('#deptSubSect').change(function(){
          var dept = $('#empDept').val();
          var sect = $('#deptSect').val();
          var subSect = $('#deptSubSect').val();
          displayLine(dept,sect,subSect);
        });
      // Transfer Type Function
        $('#permanent').click(function(){
            if ($(this).is(':checked')) {
              $('#setDate').prop('disabled', true);
            }else{
              $('#setDate').prop('disabled', false);
            }
        });
      // Submit Transfer
        $('#btnSubmitTrans').click(function(){
          // UI
            $('#note').removeClass('animated bounce infinite');
          // Variables
            var checked = 'none';
            var transfTime = '';
            var empTransfer = [];
            var count = 0;
            var empDept = $('#empDept').val();
            var deptSect1 = $('#deptSect').val();
              var deptSect =deptSect1.replace("&","@");
            var deptSubSect1 = $('#deptSubSect').val();
              var deptSubSect =deptSubSect1.replace("&","@");
            var lineNo = $('#lineNo').val();
              if(lineNo == null){
                lineNo = 0;
              }
          // Check if Form is Complete
            if ($('#permanent').is(':checked')) {
              transfTime = 'permanent';
            }else{
              transfTime = $('#setDate').val();
            }
            if(transfTime == ''){
              Swal.fire(
                'Error!',
                'Please set Transfer Details',
                'error'
              )
            }
          // Get Transfer MP
            $('#tbltoTrans>tr').each(function(){
              var id = $(this).attr('id');
              empTransfer.push(id);
            });
          // Transfer MP
            if(transfTime != ''){
              $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
              var arrayCount = empTransfer.length;
              $('#processingProgress').attr('aria-valuemax',arrayCount);
              
              empTransfer.forEach(id => {
                id = id.replace('CS','');
                $.ajax({
                  url: 'functions/process/user_department.php?process=transferEmp&empID='+id+'&empDept='+empDept+'&deptSect='+deptSect+'&deptSubSect='+deptSubSect+'&lineNo='+lineNo+'&transDate='+transfTime+'&user=<?=$userId?>',
                  method: 'get',
                  success: function(response){
                    // console.log(response);
                    count = count + 1;
                    $('#status').text(response);
                    var percent = (count / arrayCount) * 100;
                    $('#processingProgress').attr('aria-valuemax',count).css('width', percent+'%');
                    $('#count').text(count+' updated.');
                    
                    if(count == arrayCount){
                      if(transfTime != 'permanent'){
                        $.ajax({
                          url: 'functions/process/user_department.php?process=finishedTrans&user=<?=$userId?>&transDate='+transfTime,
                          method: 'get',
                          success: function(response){

                          },error: function(response){
                          }
                        });
                      }
                      setTimeout(() => {
                        Swal.fire(
                        'Success!',
                        'Transferring done.',
                        'success'
                        )
                          setInterval(function(){
                            location.reload();
                          },2000);
                      }, 2000);
                    }
                  },error: function(response){

                  }
                });
              });
            }
        });
      // Bulk Transfer
        $('#uploadBulkTrans').change(function(){
          $('.overlay').show();
          var form_data = new FormData();
          var ins = document.getElementById('uploadBulkTrans').files.length;
            for (var x = 0; x < ins; x++) {
              form_data.append("file", document.getElementById('uploadBulkTrans').files[x]);
            }
            $.ajax({
              url: 'functions/uploads/uploadBulkTrans.php',
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
                  showConfirmButton: true,
                  showCloseButton: true,
                  title: 'Uploading Status',
                  text: response
                })
              },error: function (response){
              }
            });
        });
</script>
    
      
