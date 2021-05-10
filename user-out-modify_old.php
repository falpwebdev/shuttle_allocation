<!DOCTYPE html>
<html>
<head>
<title>SAS - Modify Out</title>
<?php
  include 'db/config.php';
  include 'src/style.php';
  include 'functions/inc/inc.php';
?>
</head>
<body>
<?php
  include 'modals/changeRoute.php';
?>
<div class="container-fluid">
  <div class="col-lg-12 mt-2">
    <div class="card">
      <h4 class="card-title text-center mt-2">Modify Outgoing Data</h4>
      <div class="card-body">
        <div class="row d-flex justify-content-center ">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                  <!-- Generate Code Filed Today -->
                    <div class="md-form">
                      <input type="text" id="outCode" name="outCode" class="form-control mb-4">
                      <label class="font-weight-bold inputs">Input Code</label>
                    </div>
                    <button type="button" id="btnCode" class="btnCancel btn btn-primary btn-md btn-block">Submit</button>

                  <!-- /Generate Code Filed Today -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 mt-3" id="codeTbl">
            <div class="card">
              <h4 class="card-title text-center mt-1" id="modifyInfo"></h4>
              <div class="card-body">
                <table class="table table-sm table-bordered" id="tblHandle" style="zoom:95%">  
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Route</th>
                    <th></th>
                    <th>Area</th>
                    <th></th>
                      <?php
                        foreach ($outGoingList as $key => $timeOut){
                      ?>         
                     <th>
                        <button type="button" class="btn btn-primary btn-sm btnCheck" id="<?=$timeOut?>"><i class="fas fa-check"></i></button>
                        </th>
                      <?php
                        }
                      ?>
                        <th>A = Absent <br> NW = No Work <br> RD = Restday</th>
                      </tr>
                    </thead>
                    <tbody id="dat">
                    </tbody>
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
?>
<script>
var changeData = [];
$(document).ready(function(){
});
  // FUNCTIONS TO UI

  // Get Code Details
    $('#btnCode').click(function(){
      var outCode = $('#outCode').val();
      // Get Code Details
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=checkCode&code='+outCode,
          method: 'get',
          dataType: 'json',
          success: function(response){
            if(typeof response == 'number'){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'error',
                text: 'Code have been used or do not exist.',
                showConfirmButton: true,
              })
            }else{
              for (var i in response) {
                var date = response['date'];
                var handle = response['handle'];
                var shift = response['shift'];
              }
                generateTable(date,handle,shift);
              $('#modifyInfo').text(handle+' ('+date+' '+shift+')');
            }
          },error: function(response){
            
          }
        });
    });
  // Generate Table
    // Display Table
      const generateTable = (date,handle,shift) => {
        // Present
          $.ajax({
            url: 'functions/display/modify_outgoing.php?data=filedPresentMP&date='+date+'&handle='+handle+'&shift='+shift,
            method: 'get',
            success: function(response){
              $('#dat').html(response);
            },error: function(response){
            }
          });
        // Absent
          $.ajax({
              url: 'functions/display/modify_outgoing.php?data=filedAbsentMP&date='+date+'&handle='+handle+'&shift='+shift,
              method: 'get',
              success: function(response){
                $('#dat').html(response);
              },error: function(response){
              }
          });
      }
    // Check Filed Data 
      const getData = (date,handle,shift) => {
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=filedData&date='+date+'&handle='+handle+'&shift='+shift,
          method: 'get',
          success: function(response){
          },error: function(response){
          }
        });
      }
  // Change Route
    // Select Temp Route
      const changeRoute = (x) => {
        var data = x.split("/");
        empId = data[0];
        empRoute = data[1];
        $('#routeIdNum').val(empId);
        $('#routeFrom').val(empRoute);
        $('#routeTo').val($('#routeFrom').val());
        $('#changeRouteMod').modal();
      }
    // Change Route
      $('#setTempRoute').click(function(){
        var id = $('#routeIdNum').val();
        var from = $('#routeFrom').val();
        var to = $('#routeTo').val();
        var data = id+'@'+from+'@'+to;
        changeData.push(data);
        $('#empR'+id).text(to);
        $('#changeRouteMod').modal('toggle');
      });

  // Change Area
    const changeArea = (x) => {
      var data = $('#empA'+x).text();
      empArea = data.trim();
      if(empArea == 'A'){
        $('#empA'+x).text('B');
        $('#empA'+x).css('color','red');
      }else{
        $('#empA'+x).text('A');
        $('#empA'+x).css('color','blue');
      }
    }
</script>
</body>
</html><!DOCTYPE html>
<html>
<head>
<title>SAS - Modify Out</title>
<?php
  include 'db/config.php';
  include 'src/style.php';
  include 'functions/inc/inc.php';
?>
</head>
<body>
<?php
  include 'modals/changeRoute.php';
?>
<div class="container-fluid">
  <div class="col-lg-12 mt-2">
    <div class="card">
      <h4 class="card-title text-center mt-2">Modify Outgoing Data</h4>
      <div class="card-body">
        <div class="row d-flex justify-content-center ">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                  <!-- Generate Code Filed Today -->
                    <div class="md-form">
                      <input type="text" id="outCode" name="outCode" class="form-control mb-4">
                      <label class="font-weight-bold inputs">Input Code</label>
                    </div>
                    <button type="button" id="btnCode" class="btnCancel btn btn-primary btn-md btn-block">Submit</button>

                  <!-- /Generate Code Filed Today -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 mt-3" id="codeTbl">
            <div class="card">
              <h4 class="card-title text-center mt-1" id="modifyInfo"></h4>
              <div class="card-body">
                <table class="table table-sm table-bordered" id="tblHandle" style="zoom:95%">  
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Route</th>
                    <th></th>
                    <th>Area</th>
                    <th></th>
                      <?php
                        foreach ($outGoingList as $key => $timeOut){
                      ?>         
                     <th>
                        <button type="button" class="btn btn-primary btn-sm btnCheck" id="<?=$timeOut?>"><i class="fas fa-check"></i></button>
                        </th>
                      <?php
                        }
                      ?>
                        <th>A = Absent <br> NW = No Work <br> RD = Restday</th>
                      </tr>
                    </thead>
                    <tbody id="dat">
                    </tbody>
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
?>
<script>
var changeData = [];
$(document).ready(function(){
});
  // FUNCTIONS TO UI

  // Get Code Details
    $('#btnCode').click(function(){
      var outCode = $('#outCode').val();
      // Get Code Details
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=checkCode&code='+outCode,
          method: 'get',
          dataType: 'json',
          success: function(response){
            if(typeof response == 'number'){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'error',
                text: 'Code have been used or do not exist.',
                showConfirmButton: true,
              })
            }else{
              for (var i in response) {
                var date = response['date'];
                var handle = response['handle'];
                var shift = response['shift'];
              }
                generateTable(date,handle,shift);
              $('#modifyInfo').text(handle+' ('+date+' '+shift+')');
            }
          },error: function(response){
            
          }
        });
    });
  // Generate Table
    // Display Table
      const generateTable = (date,handle,shift) => {
        // Present
          $.ajax({
            url: 'functions/display/modify_outgoing.php?data=filedPresentMP&date='+date+'&handle='+handle+'&shift='+shift,
            method: 'get',
            success: function(response){
              $('#dat').html(response);
            },error: function(response){
            }
          });
        // Absent
          $.ajax({
              url: 'functions/display/modify_outgoing.php?data=filedAbsentMP&date='+date+'&handle='+handle+'&shift='+shift,
              method: 'get',
              success: function(response){
                $('#dat').html(response);
              },error: function(response){
              }
          });
      }
    // Check Filed Data 
      const getData = (date,handle,shift) => {
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=filedData&date='+date+'&handle='+handle+'&shift='+shift,
          method: 'get',
          success: function(response){
          },error: function(response){
          }
        });
      }
  // Change Route
    // Select Temp Route
      const changeRoute = (x) => {
        var data = x.split("/");
        empId = data[0];
        empRoute = data[1];
        $('#routeIdNum').val(empId);
        $('#routeFrom').val(empRoute);
        $('#routeTo').val($('#routeFrom').val());
        $('#changeRouteMod').modal();
      }
    // Change Route
      $('#setTempRoute').click(function(){
        var id = $('#routeIdNum').val();
        var from = $('#routeFrom').val();
        var to = $('#routeTo').val();
        var data = id+'@'+from+'@'+to;
        changeData.push(data);
        $('#empR'+id).text(to);
        $('#changeRouteMod').modal('toggle');
      });

  // Change Area
    const changeArea = (x) => {
      var data = $('#empA'+x).text();
      empArea = data.trim();
      if(empArea == 'A'){
        $('#empA'+x).text('B');
        $('#empA'+x).css('color','red');
      }else{
        $('#empA'+x).text('A');
        $('#empA'+x).css('color','blue');
      }
    }
</script>
</body>
</html>