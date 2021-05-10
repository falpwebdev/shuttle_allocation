<!DOCTYPE html>
<html>
<head>
  <title>SAS</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- MDB icon -->
  <link rel="icon" href="../img/sas-logo.ico" type="image/x-icon">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="../css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="../css/style.css?v=2">
  <link href="../css/addons/datatables.min.css" rel="stylesheet">
  <link href="../css/addons/datatables-select.min.css" rel="stylesheet">
  <!-- <link href="css/addons/datatables2.min.css" rel="stylesheet">
  <link href="css/addons/datatables-select2.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="../lib/fontawesome-free-5.9.0-web/css/all.css">
  <style type="text/css">
  </style>
</head>
<body>
<?php
 include '../modals/processingUI.php';
?>
<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-lg-12">
      <div class="card">
        <h4 class="card-title text-center mt-3">Adjust Manpower</h4>
        <div class="card-body">
          <!-- Download Manpower -->
            <section>
              <div class="row">
                <div class="col-lg-12">
                  <p class="note note-danger">Download Manpower per Line</p>
                </div>
              </div>
              <div class="row d-flex justify-content-center">
                  <select class="browser-default custom-select" id="selectLine" style="width:300px;">
                  </select>
                  <button type="button" class="btn btn-default btn-sm" id="btnExport">Print Data</button>
              </div>
            </section>
          <!-- Update Manpower -->
            <section>
              <div class="row mt-3">
                <div class="col-lg-12">
                  <p class="note note-success">Update Manpower per Line</p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                <form enctype="multipart/form-data" class="d-flex justify-content-end">
                        <span class="btn btn-outline-primary waves-effect btn-lg btn-block mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Add Manpower
                        <input type="file" id="uploadNewEmp" name="fileNew" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>
                </form>
                <a href="templates/Add Manpower Template.xlsx" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Template</a>

                  <p class="note note-danger mt-2"><strong>Note: </strong>If manpower already exist in the system, the data of the MP will be updated. </p>
                </div>
                <div class="col-lg-6">
                <form enctype="multipart/form-data" class="d-flex justify-content-end">
                        <span class="btn btn-outline-danger waves-effect btn-lg btn-block mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Excess Manpower
                        <input type="file" id="uploadExcessEmp" name="fileExcess" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>
                </form>
                <a href="templates/Excess Manpower Production Template.xlsx" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Template</a>

                  <p class="note note-danger mt-2"><strong>Note: </strong>Excess manpower will be transfered to PDX (Excess Department).</p>
                </div>
              </div>
              <div class="row mt-2">
                <div class="d-flex col-lg-12 mt-1">
                  
                  
                </div>
              </div>
            </section>
          <!-- Update Cost Center & Date Hired -->
            <section>
              <div class="row mt-3">
                <div class="col-lg-6">
                  <p class="note note-success">Update Cost Center</p>
                </div>
                <div class="col-lg-6">
                  <p class="note note-success">Update Date Hired</p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <form enctype="multipart/form-data" class="d-flex justify-content-end">
                    <span class="btn btn-blue waves-effect btn-lg btn-block mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Update Cost Center
                    <input type="file" id="uploadCost" name="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>
                  </form>
                  <a href="templates/Update Cost Center.xlsx" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Template</a>
                </div>
                <div class="col-lg-6">
                  <form enctype="multipart/form-data" class="d-flex justify-content-end">
                    <span class="btn btn-red waves-effect btn-lg btn-block mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Update Date Hired
                    <input type="file" id="uploadHired" name="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>
                  </form>
                  <a href="templates/Update Date Hired.xlsx" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Date Hired Template</a>
                </div>
              </div>
            <section>
          <!-- Update Probitionary -->
            <section>
              <div class="row mt-3">
                <div class="col-lg-12">
                  <p class="note note-success">Update Probationary</p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                <form enctype="multipart/form-data" class="d-flex justify-content-end">
                        <span class="btn btn-green waves-effect btn-lg btn-block mt-2 btn-file" ><i class="fas fa-upload" style="font-size:15px;"></i> Update Probationary
                        <input type="file" id="uploadProbi" name="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" ></span>
                </form>
                <a href="templates/Update Probationary.xlsx" class="btn btn-outline-info waves-effect btn-sm mt-2"> <i class="fas fa-file-download" style="font-size:15px;"></i> Download Probationary Template</a>
                </div>
            </section>
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
    displayLines();
  });
  // FUNCTIONS TO UI
    const displayLines = () => {
      $.ajax({
        url: '../functions/display/common_department.php?data=adjust_line',
        method: 'get',
        success: function(response){
          // console.log(response);
          $('#selectLine').html(response);
        },error: function(response){

        }
      });
    }
  // EXPORT DATA IN SAS
    // Export Data in Excel
      $('#btnExport').click(function(){
        var line = $('#selectLine').val();
        window.location.href = 'downloadData.php?line='+line;
      });
  // UPLOAD ADDITIONAL MANPOWER
    $('#uploadNewEmp').change(function(){
      $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
      $('#count').text('Adjusting Manpower.');
      $('.progress').hide();
      $('#loader').show();
      var form_data = new FormData();
      var ins = document.getElementById('uploadNewEmp').files.length;
        for (var x = 0; x < ins; x++) {
          form_data.append("file", document.getElementById('uploadNewEmp').files[x]);
        }
        $.ajax({
          url: 'uploadNewEmp.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function (response){
            Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Uploading Status',
              text: response
            })
              setTimeout(() => {
                Swal.fire(
                'Success!',
                'Uploading Status Done',
                'success'
                )
                setInterval(function(){
                  location.reload();
                },2000);
              },2000);
          },error: function (response){
          }
        });
    });
  //  UPLOAD EXCESS MANPOWER
    $('#uploadExcessEmp').change(function(){
      $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
      $('#count').text('Adjusting Excess Manpower.');
      $('.progress').hide();
      $('#loader').show();
      var form_data = new FormData();
      var ins = document.getElementById('uploadExcessEmp').files.length;
        for (var x = 0; x < ins; x++) {
          form_data.append("file", document.getElementById('uploadExcessEmp').files[x]);
        }
        $.ajax({
          url: 'uploadExcessEmp.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function (response){
            Swal.fire({
              icon: 'info',
              showConfirmButton: false,
              showCloseButton: true,
              title: 'Uploading Status',
              text: response
            })
              setTimeout(() => {
                Swal.fire(
                'Success!',
                'Uploading Status Done',
                'success'
                )
                setInterval(function(){
                  location.reload();
                },2000);
              },2000);
          },error: function (response){
          }
        });
    });
  // UPLOAD COST CENTER
    $('#uploadCost').change(function(){
      $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
      $('#count').text('Updating Manpower Cost Center.');
      $('.progress').hide();
      $('#loader').show();
        var form_data = new FormData();
        var ins = document.getElementById('uploadCost').files.length;
          for (var x = 0; x < ins; x++) {
            form_data.append("file", document.getElementById('uploadCost').files[x]);
          }
          $.ajax({
            url: 'uploadCostEmp.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response){
              Swal.fire({
                icon: 'info',
                showConfirmButton: false,
                showCloseButton: true,
                title: 'Uploading Status',
                text: response
              })
                setTimeout(() => {
                  Swal.fire(
                  'Success!',
                  'Uploading Status Done',
                  'success'
                  )
                  setInterval(function(){
                    location.reload();
                  },2000);
                },2000);
            },error: function (response){
            }
          });
      });
  // UPLOAD DATE HIRED
    $('#uploadHired').change(function(){
      $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
      $('#count').text('Updating Manpower Date Hired.');
      $('.progress').hide();
      $('#loader').show();
        var form_data = new FormData();
        var ins = document.getElementById('uploadHired').files.length;
          for (var x = 0; x < ins; x++) {
            form_data.append("file", document.getElementById('uploadHired').files[x]);
          }
          $.ajax({
            url: 'uploadDateHired.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response){
              Swal.fire({
                icon: 'info',
                showConfirmButton: false,
                showCloseButton: true,
                title: 'Uploading Status',
                text: response
              })
                setTimeout(() => {
                  Swal.fire(
                  'Success!',
                  'Uploading Status Done',
                  'success'
                  )
                  setInterval(function(){
                    location.reload();
                  },2000);
                },2000);
            },error: function (response){
            }
          });
    });
  // UPLOAD PROBI
    $('#uploadProbi').change(function(){
      $('#processingStatMod').modal({backdrop: 'static', keyboard: false});
      $('#count').text('Updating Probationary Manpower.');
      $('.progress').hide();
      $('#loader').show();
        var form_data = new FormData();
        var ins = document.getElementById('uploadProbi').files.length;
          for (var x = 0; x < ins; x++) {
            form_data.append("file", document.getElementById('uploadProbi').files[x]);
          }
          $.ajax({
            url: 'uploadProbi.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response){
              Swal.fire({
                icon: 'info',
                showConfirmButton: false,
                showCloseButton: true,
                title: 'Uploading Status',
                text: response
              })
                setTimeout(() => {
                  Swal.fire(
                  'Success!',
                  'Uploading Status Done',
                  'success'
                  )
                  setInterval(function(){
                    location.reload();
                  },2000);
                },2000);
            },error: function (response){
            }
          });
    });
    
</script>