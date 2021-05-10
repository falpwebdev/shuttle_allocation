<!DOCTYPE html>
<html>
<head>
  <title>SAS Admin - SAS Masterlist</title>
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
  include 'modals/editOutGoing.php';
  include 'modals/editWorkS.php';
  include 'modals/editAlarm.php';
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
          <!-- SAS -->
          <!-- ROUTE -->
              <div class="col-lg-12">
                <p class="note note-success d-flex justify-content-start text-uppercase">Route Masterlist</p>
              </div>
              <div class="col-lg-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-info" id="btnExportRoute"><i class="fas fa-file-export"></i> Export Route</button>
                <form enctype="multipart/form-data" class="d-flex justify-content-end">
                
                  <span class="btn btn-primary waves-effect btn-sm mt-2 btn-file">
                  <div class="spinner-border text-dark" role="status">
                  <span class="sr-only">Loading...</span>
                  </div>
                  <i class="fas fa-upload btnTitle" style="font-size:15px;"> 
                  </i>
                   <span class="btnTitle">Upload New Route</span>
                  <input type="file" id="btnUploadRoute" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></span>
                </form>  
              </div>
              <div class="col-lg-12 d-flex justify-content-end">
              <p class="note note-danger"><strong>Note:</strong> Save as Excel Workbook before uploading new route.</p>

              </div>
              <div class="col-lg-12 mt-2" id="routeSect">
                <table class="table table-sm table-hovered table-bordered text-center" id="routeTbl" border="1">
                  <thead>
                    <tr>
                      <th>Route</th>
                      <th>Pickup Point</th>
                      <th>Shuttle Provider</th>
                      <th>Order Number</th>
                    </tr>
                  </thead>
                  <tbody id="tblRoute">
                  </tbody>
                </table>
              </div>
              <div class="col-lg-12 d-flex justify-content-end">
                
              </div>
          <!--  -->
          <!-- TIME -->
          <div class="col-lg-12">
              <p class="note note-success d-flex justify-content-start text-uppercase">Time Masterlist</p>
          </div>
          <!-- OUT GOING -->
          <div class="col-lg-6">
                <div class="form-row">
                  <div class="col">
                    <label>Hour</label>
                    <select class="browser-default custom-select" id="hour">
                      <?php
                        for ($i=1; $i < 13; $i++) { 
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      ?>
                    </select> 
                  </div>
                  <div class="col">
                    <label>Minute</label>
                    <select class="browser-default custom-select" id="minute">
                    <?php
                      for ($i=0; $i < 60; $i++) { 
                        if($i == 0){
                          echo '<option value="0'.$i.'">0'.$i.'</option>';
                        }elseif($i < 10){
                          echo '<option value="0'.$i.'">0'.$i.'</option>';
                        }else{
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      }
                    ?>
                  </select>
                  </div>
                </div>
                <button id="addOut" class="btn-sm btn-primary mt-1">Add Out Time</button>
              <table class="table table-sm table-hovered table-bordered text-center" id="outTbl" border="1">
              <thead>
                <tr>
                  <th colspan="3">Outgoing Time</th>
                </tr>
                <tr>
                  <th>Count</th>
                  <th>Outgoing Time</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tblOut">
              </tbody>
            </table>
          </div>
          <!--  -->
          <!-- Time Sched -->
          <div class="col-lg-6">
            <label for="newSched">New Sched</label>
            <input type="text" class="form-control" id="newSched">
            <button id="addSched" class="btn-sm btn-primary mt-1">Add New Sched</button>
            <table class="table table-sm table-hovered table-bordered text-center" id="schedTbl" border="1">
              <thead>
                <tr>
                  <th colspan="3">Schedule Time</th>
                </tr>
                <tr>
                  <th>Count</th>
                  <th>Schedule</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tblSched">
              </tbody>
            </table>
          </div>
          <!-- Alarm Time -->
          <div class="col-lg-6">
              <table class="table table-sm table-hovered table-bordered text-center" id="alarmTbl" border="1">
                  <thead>
                    <tr>
                      <th>Shift</th>
                      <th>Cut Off Time</th>
                      <th>Alarm Time</th>
                      <th>Snooze Time</th>
                    </tr>
                  </thead>
                  <tbody id="tblAlarm">
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
  displayRoute();
  displayOut();
  displaySched();
  displayAlarm();
  $('.spinner-border').hide();
});

$('#btnExportRoute').click(function(){
  var table = $('#routeTbl').DataTable();
  table.destroy();
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=routeSect]').html()));
  e.preventDefault();
  displayRoute();
});

$('#btnUploadRoute').change(function(){
  $('#btnUploadRoute').prop("disabled",true);
  $('.spinner-border').show();
  $('.btnTitle').hide();
  var form_data = new FormData();
  var ins = document.getElementById('btnUploadRoute').files.length;
		for (var x = 0; x < ins; x++) {
      form_data.append("file", document.getElementById('btnUploadRoute').files[x]);
    }
    $.ajax({
      url: 'functions/uploads/route/generate.php',
      dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
		  success: function (response){
        console.log(response);
        $('.spinner-border').hide();
        $('.btnTitle').show();
        $('#btnUploadRoute').prop("disabled",false);
        Swal.fire({
          icon: 'info',
          showConfirmButton: false,
          showCloseButton: true,
          title: 'Uploading Status',
          text: response
        });
        displayRoute();
      },error: function (response){
      }
    });
});

$('#addOut').click(function(){
  var hour = $('#hour').val();
  var minute = $('#minute').val();
    $.ajax({
      url: '../functions/process/admin_module.php?process=add_outgoing&hr='+hour+'&min='+minute,
      method: 'get',
      success: function(response){
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Adding Status',
            text: response
          });
          $('#hour').val('');
          $('#minute').val('');
          displayOut();
      },error: function(response){

      }
    });
});

$('#addSched').click(function(){
  var newSched = $('#newSched').val();
  $.ajax({
      url: '../functions/process/admin_module.php?process=add_schedule&newS='+newSched,
      method: 'get',
      success: function(response){
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Adding Status',
            text: response
          });
          $('#newSched').val('');
          displaySched();
      },error: function(response){

      }
    });

});

$('#btnUpdateOut').click(function(){
  var old = $('#oldOut').val();
  var hour = $('#uhr').val();
  var minute = $('#umin').val();
  $.ajax({
      url: '../functions/process/admin_module.php?process=update_outgoing&prev='+old+'&hr='+hour+'&min='+minute,
      method: 'get',
      success: function(response){
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Updated Out',
            text: response
          });
          $('#uhr').val('');
          $('#umin').val('');
          $('#oldOut').val('');
          $('#updateOutGoingMod').modal('toggle');
          displayOut();
      },error: function(response){

      }
  });
});

$('#btnUpdateWork').click(function(){
  var old = $('#oldWork').val();
  var newS = $('#newTWork').val();
  $.ajax({
      url: '../functions/process/admin_module.php?process=update_schedule&prev='+old+'&new='+newS,
      method: 'get',
      success: function(response){
        Swal.fire({
            icon: 'info',
            showConfirmButton: false,
            showCloseButton: true,
            title: 'Updated Sched',
            text: response
          });
          $('#oldWork').val('');
          $('#newTWork').val('');
          $('#updateWorkSMod').modal('toggle');
          displaySched();
      },error: function(response){

      }
    });

});

const displayRoute = () => {
  var table = $('#routeTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_route',
    method: 'get',
    success: function(response){
      $('#tblRoute').html(response);
      $('#routeTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  })
}

const displayOut = () => {
  var table = $('#outTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_out_going',
    method: 'get',
    success: function(response){
      $('#tblOut').html(response);
      $('#outTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  })
}

const editOut = (x) => {
  $('#updateOutGoingMod').modal();
  $('#oldOut').val(x);
}

const editSched = (x) => {
  $('#updateWorkSMod').modal();
  $('#oldWork').val(x);
  $('#newTWork').val(x);
}

const deleteOut  = (x) => {
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../functions/process/admin_module.php?process=delete_outgoing&item='+x,
        method: 'get',
        success: function(response){
          Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Deleted Out',
              text: response
            });
            displayOut();
        },error: function(response){

        }
      });
    }
  })
}

const displaySched = () => {
  var table = $('#schedTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_schedule',
    method: 'get',
    success: function(response){
      $('#tblSched').html(response);
      $('#schedTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  })
}

const deleteSched  = (x) => {
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '../functions/process/admin_module.php?process=delete_schedule&item='+x,
        method: 'get',
        success: function(response){
          Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Deleted Schedule',
              text: response
            });
            displaySched();
        },error: function(response){

        }
      });
    }
  })
}

const displayAlarm = () => {
  var table = $('#schedTbl').DataTable();
  table.destroy();
  $.ajax({
    url: '../functions/display/admin_module.php?data=li_alarm',
    method: 'get',
    success: function(response){
      $('#tblAlarm').html(response);
      $('#alarmTbl').DataTable();
      $('.dataTables_length').addClass('bs-select');
    },error: function(response){
      
    }
  })
}

const editAlarm = (a,b,c,d) => {
  $('#editAlarmMod').modal();
  $('#AlarmI').text(a);
  $('#shift').val(a);
  $('#timeCut').val(b);
  $('#timeAlarm').val(c);
  $('#timeSnooze').val(d);
}

$('#btnUpdateAlarm').click(function(){
  var shift = $('#shift').val();
  var cutOff = $('#timeCut').val();
  var alarm = $('#timeAlarm').val();
  var snooze = $('#timeSnooze').val();
  var datax = {
    "shift": shift,
    "cutOff": cutOff,
    "alarm": alarm,
    "snooze": snooze
  };
  var data = JSON.stringify(datax);
    $.ajax({
      url: '../functions/process/admin_module.php?process=update_alarm&data='+data,
      method: 'get',
      success: function(response){
        Swal.fire({
          icon: 'info',
          showConfirmButton: false,
          showCloseButton: true,
          title: 'Update Alarm',
          text: response
        });
          displayAlarm();
          $('#editAlarmMod').modal('toggle');
      },error: function(response){
      }
    });
});
</script>
</body>
</html>

