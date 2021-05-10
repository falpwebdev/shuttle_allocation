<?php
  if(isset($_SESSION['idNumber'])){
    $userID = $_SESSION['idNumber'];
    $userName = $_SESSION['empName'];
  }else{
    $userID = '';
    $userName = '';
  }
?>
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
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                  <!-- Generate Code Filed Today -->
                    <div class="md-form">
                      <input type="text" id="outCode" name="outCode" class="form-control mb-4">
                      <label class="font-weight-bold inputs">Input Code</label>
                    </div>
                    <button type="button" id="btnCode" class="btn btn-primary btn-md btn-block">Get Code</button>

                  <!-- /Generate Code Filed Today -->
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <p class="text-center"><b>Request Details</b></p>
                  </div>
                  <div class="col-lg-12">
                    <p id="codeDetails" class="text-center">
                    </p>
                  </div>
                  <div class="col-lg-12 d-flex justify-content-center">
                    <button type="button" id="btnConfirm" class="btnx btn btn-primary btn-md">Confirm</button>
                    <button type="button" id="btnCancel" class="btnx btn btn-danger btn-md" onclick="location.reload();">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 mt-3" id="codeTbl">
            <div class="card">
              <h4 class="card-title text-center mt-1" id="modifyInfo"></h4>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
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
                    </table>
                  </div>
                  <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-primary btn-sm" id="btnSubmit">Submit</button>
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
?>
<script type="text/javascript">
var changeData = [];
var shiftF = '';
var dateFor = '';
var filedFor = '';
var requestID = '';
var requestName = '';
$(function () {
$('[data-toggle="popover"]').popover()
});
$(document).ready(function(){
  $('.btnx').prop("disabled",true);
});
  // MAIN FUNCTIONS TO UI
    // Get Data
      $('#btnCode').click(function(){
        var code = $('#outCode').val();
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=code_details&code='+code,
          method: 'get',
          success: function(response){
            if(response != 'false'){
              $('.btnx').prop("disabled",false);
              $('#codeDetails').html(response);
            }else{
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'The code you enter is currently in used or already opened or not exisiting.',
                showConfirmButton: true,
              })
            }
          },error: function(response){
            
          }
        });
      });
    // Confirm Data
      $('#btnConfirm').click(function(){
        $(this).prop("disabled",true);
        $('#btnCancel').prop("disabled",true);
        var code = $('#outCode').val();
        $('#outCode').prop("disabled", true);
        $('#btnCode').prop("disabled", true);
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=code_confirm&code='+code,
          method: 'get',
          dataType: 'json',
          success: function(response){
            if(response == ''){
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'The code you enter is currently in used or already opened.',
                showConfirmButton: true,
              })
            }else{
              for(var i in response){
                dateFor = response[i].dateFor;
                filedFor = response[i].filedFor;
                shift = response[i].shift;
                requestID = response[i].requestor;
                requestName = response[i].requestorName;
              }
            generateUI();
            }
          },error: function(response){
            
          }
        });
      });
    // Generate User Interface
      const generateUI = () => {
        shiftF = shift;
        $.ajax({
          url: 'functions/display/modify_outgoing.php?data=code_data&date='+dateFor+'&handle='+filedFor+'&shift='+shift,
          method: 'get',
          success: function(response){
            $('#dat').html(response);
            $('#tblHandle').DataTable({
              scrollY: "800px",
              paging: false
            });
            $('#dat>tr').each(function(){
              var datID = $(this).attr('id');
              var idNumber = datID.substring(2);
              $.ajax({
                url: 'functions/display/modify_outgoing.php?data=filed_details&idNumber='+idNumber+'&dateFor='+dateFor+'&filedFor='+filedFor+'&shift='+shift,
                method: 'get',
                success: function(response){
                    document.getElementById('emp'+response+idNumber).checked = true;
                },error: function(response){

                }
              });
            });
          },error: function(response){

          }
        });
      }
  // Functions to UI
    // Change Route
      const changeRoute = (x) => {
        var data = x.split("/");
        empId = data[0];
        empRoute = data[1];
        $('#routeIdNum').val(empId);
        $('#routeFrom').val(empRoute);
        $('#routeTo').val($('#routeFrom').val());
        $('#changeRouteMod').modal();
      }
      $('#setTempRoute').click(function(){
        var id = $('#routeIdNum').val();
        var from = $('#routeFrom').val();
        var to = $('#routeTo').val();
        changeData.push({
          "idNumber":  id,
          "from":  from,
          "to":  to
        }); 
        $('#empR'+id).text(to);
        $('#changeRouteMod').modal('toggle');
      });
    // Change Area
      const changeArea = (x) => {
        var data = $('#empArea'+x).text();
        empArea = data.trim();
        if(empArea == 'A'){
          $('#empArea'+x).text('B');
          $('#empArea'+x).css('color','red');
        }else{
          $('#empArea'+x).text('A');
          $('#empArea'+x).css('color','blue');
        }
      }
    // Select All Out 
      $('.btnCheck').click(function(){
        var id = $(this).attr('id');
        $('#dat>tr').each(function(){
          var datID = $(this).attr('id');
          idNumber = datID.replace("id", "");
          document.getElementById('emp'+id+idNumber).checked = true;
        });
      });
  // Submit Allocation
    $('#btnSubmit').click(function(){
      var inc = 'false';
      var empOutGoing = [];
      var empAbsentDat = [];
      // $('#btnSubmit').prop("disabled",true);
      // Get Form Data
        $('#dat>tr').each(function(){
          var datID = $(this).attr('id');
          var idNumber = datID.replace("id", "");
          var empADat = $('#empArea'+idNumber).text();
          var empArea = empADat.trim();
          var outGoing = $('input[name="check'+idNumber+'"]:checked').val();
          var route = $('#empR'+idNumber).text();
          console.log(outGoing);
              if (outGoing){
                  if(outGoing == 'A' || outGoing == 'NW' || outGoing == 'RD' ){
                    //  Absent
                      empAbsentDat.push({
                        "idNumber":  idNumber,
                        "shift":  shift,
                        "category":  outGoing,
                      });
                  }else{
                    // Present
                      empOutGoing.push({
                        "idNumber":  idNumber,
                        "shift":  shift,
                        "outGoing":  outGoing,
                        "route":  route.trim(),
                        "area":  empArea,
                      }); 
                  }
              }else{
                Swal.fire({
                  position: 'center',
                  icon: 'error',
                  title: 'Please complete form',
                  showConfirmButton: false,
                  timer: 2000
                })
                inc = 'true';
                $('#btnSubmit').css('display','block');
              }
        });
      // If Complete Form
        if(inc == 'false'){
          // Convert Arrays to JSON
            var empOut = JSON.stringify(empOutGoing);
            var empAbsent = JSON.stringify(empAbsentDat);
            var changeRoute = JSON.stringify(changeData);
            // User
              var userID = '<?=$userID?>';
              var userName = '<?=$userName?>';

              if(userID == ''){
                var userID = requestID;
                var userName = requestName;
              }
          //  Submit Shuttle Allocation Form shiftF
            $.ajax({
              url: 'functions/process/modify_outgoing.php?process=refiled_data&filedDate='+dateFor+'&filedFor='+filedFor+'&shift='+shiftF+'&empOutGoing='+empOut+'&empAbsent='+empAbsent+'&changeRouteDat='+changeRoute+'&userID='+requestID+'&userName='+userName,
              success: function(response){
                console.log(response);
                if(response == 'success'){
                  var code = $('#outCode').val();
                  $.ajax({
                    url: 'functions/process/modify_outgoing.php?process=close_code&code='+code+'&user='+requestName,
                    method: 'get',
                    success: function(response){
                      console.log(response);
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Shuttle Allocation Adjusted',
                        showConfirmButton: false,
                        timer: 2000
                      });
                      setInterval(function(){
                        location.reload();
                      },'2000');
                    },error: function(response){

                    }
                  });
                }
              },error: function(response){
              }
            });
        }
    });
</script>
</body>
</html>