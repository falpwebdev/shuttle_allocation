<?php
date_default_timezone_set('Asia/Manila');
  $interface = 'shuttle';
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
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
  <title>File Shuttle Allocation Outgoing </title>
  <?php
    include 'src/style.php';
  ?>
<style>
</style>
</head>
<body>
<?php
  if($userType == 'Clerk'){
    include 'src/navs/topnav.php';
  }elseif($userType == 'Line Leader'){
    include 'src/navs/line-topnav.php';
  }elseif($userType = 'Agency'){
    include 'src/navs/agency-topnav.php';
  }
  include 'modals/changeRoute.php';
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <h6 class="card-title text-center font-weight-bold mt-3 text-uppercase">Shuttle Allocation (<?=$handle?> <?=$forShift?>)</h6>
        <input type="hidden" id="countStatus" value="<?=$totcount?>">

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <table class="table table-sm table-bordered" id="tblHandle" style="zoom:95%">  
                <thead>
                    <tr>
                      <th>No.</th>
                      <th>Section/Sub Section</th>
                      <th>ID Number</th>
                      <th>Name</th>
                      <th>Route</th>
                      <th></th>
                      <th>Area</th>
                      <th></th>
                      <?php
                        foreach ($outGoingList as $key => $outGoing) {
                      ?>
                      <th>
                        <button type="button" class="btn btn-primary btn-sm btnCheck" id="<?=$outGoing?>"><i class="fas fa-check"></i></button>
                      </th>
                      <?php
                        }
                      ?>
                      <th>A = Absent <br> NW = No Work <br> RD = Restday</th>
                    </tr>
                </thead>
                <tbody id="dat">
                    <?php
                      $num = 1;
                      while ($empData = $queryMP->fetch_assoc()) {
                        $idNumber = $empData['idNumber'];
                        $empName = $empData['empName'];
                        $empRoute = $empData['empRoute'];
                        $empSubSection = $empData['empSubSect'];
                        $empSection = $empData['empDeptSection'];
                        $empArea = $empData['empArea'];
                    ?>
                      <tr id="id<?=$idNumber?>">
                        <td><?=$num?></td>
                        <td class="text-wrap">
                          <?php
                            if(in_array($handle,$withLineDept)){
                              echo $empSection;
                            }else{
                              echo $empSubSection;
                            }
                          ?>
                        </td>
                        <td><?=$idNumber?></td>
                        <td class="text-wrap"><?=$empName?></td>
                        <td id="empR<?=$idNumber?>">
                          <?=$empRoute?>
                        </td>
                        <td>
                        <i class="fas fa-pencil-alt" onclick="changeRoute('<?=$idNumber.'/'.$empRoute?>')"></i>
                        </td>
                        <td id="empArea<?=$idNumber?>">
                          <?=$empArea?>
                        </td>
                        <td>
                          <i class="fas fa-sync-alt" onclick="changeArea('<?=$idNumber?>');"></i>
                        </td>
                        <?php
                          foreach ($outGoingList as $key => $outGoing) {
                        ?>
                          <td>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input check<?=$outGoing?> check<?=$idNumber?>" id="emp<?=$outGoing?><?=$idNumber?>" value="<?=$outGoing?>" name="check<?=$idNumber?>">
                              <label class="custom-control-label" for="emp<?=$outGoing?><?=$idNumber?>"><?=$outGoing?></label>
                            </div>
                          </td>
                        <?php
                          }
                        ?>
                        <td>
                          <div class="custom-control custom-radio custom-control-inline" id="divA<?=$idNumber?>">
                          <input type="radio" class="custom-control-input checkAbsent check<?=$idNumber?>" id="empA<?=$idNumber?>" value="A" name="check<?=$idNumber?>">
                            <label class="custom-control-label" for="empA<?=$idNumber?>">A</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input checkAbsent check<?=$idNumber?>" id="empNW<?=$idNumber?>" value="NW" name="check<?=$idNumber?>">
                            <label class="custom-control-label" for="empNW<?=$idNumber?>">NW</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input checkAbsent check<?=$idNumber?>" id="empRD<?=$idNumber?>" value="RD" name="check<?=$idNumber?>">
                            <label class="custom-control-label" for="empRD<?=$idNumber?>">RD</label>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $num++;
                    }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex justify-content-end">
              <button type="button" id="btnResubmit" class="btn btn-default btn-sm" style="display:none;">Resubmit</button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSubmit">Submit</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7"></div>
            <div class="col-lg-5 d-flex justify-content-end">
              <p id="notes" class="note note-danger"><strong>Note: </strong><span id="note"></span></p>   
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
  var changeData = [];
  $(function () {
$('[data-toggle="popover"]').popover()
});
$(document).ready(function(){
  // Nav
    $('#navHome').addClass('font-weight-bold');
    $('#navHome').css('color','#CC0000');
  // Employee Table
    $('#tblHandle').DataTable({
      scrollY: "800px",
      paging: false
    });
  // Button Status
    $('#notes').hide();
    var btnStat = '<?=$SubBtnStat?>';
    if(btnStat == 'disable'){
      $('#btnSubmit').prop('disabled',true);
      $('#btnResubmit').prop('disabled',true);
      $('#notes').show();
      $('#note').text(' Submission of Shuttle Allocation is until 3:00 am/pm only.');
    }
  // Functions to UI
    determineBtn();
  // Real time
    filingMPCount();
    notifNum();
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
        url: 'functions/process/realtime_count.php?process=filingMP_count&shift=<?=$shift?>&handle='+handle+'&type=<?=$userType?>&interface=<?=$interface?>',
        method: 'get',
        success: function(response){
          console.log(response);
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
  // Notifications
  // FUNCTIONS TO UI
    // Button
      const determineBtn = () => {
        var buttonSub = '<?=$buttonSub?>';
        if(buttonSub == 'true'){
          $('#btnSubmit').prop('disabled','true');
          $('#btnResubmit').show();
        }else{

        }
      }
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
          // $('input[name="check'+idNumber+'"]').val(id);
        });
      });
  // Submit Allocation
    $('#btnSubmit').click(function(){
        var inc = 'false';
        var empOutGoing = [];
        var empAbsentDat = [];
        var dataH = '<?=$handle?>';
        var handle = dataH.replace("&","@");
        $('#btnSubmit').css('display','none');
        // Get Form Data
          $('#dat>tr').each(function(){
            var datID = $(this).attr('id');
            var idNumber = datID.replace("id", "");
            var empADat = $('#empArea'+idNumber).text();
            var empArea = empADat.trim();
            var outGoing = $('input[name="check'+idNumber+'"]:checked').val();
            console.log(outGoing);
            var route = $('#empR'+idNumber).text();
            route = route.trim();
            var dept = '<?=$dpmt?>';
            var shift = '<?=$forShift?>';
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
                });
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
            // Submit Change Shuttle Form
                $.post('functions/process/allocation.php', 
                  {
                    process:'empChangeShuttle', 
                    changeRouteDat:changeRoute,
                    user: '<?=$userEmpName?>',
                    idUser: '<?=$userId?>',
                    shift: '<?=$shift?>',
                    handle: handle
                  }
                ).done(function(response){
                      alert(response);
                });
            
            //  Submit Shuttle Allocation Form
                $.post('functions/process/allocation.php', 
                  {
                    process:'submitAllocation', 
                    empOutGoing:empOut,
                    empAbsent: empAbsent,
                    idUser: '<?=$userId?>',
                    user: '<?=$userEmpName?>',
                    shift: '<?=$shift?>',
                    handle: handle
                  }
                ).done(function(response){
                  if(response == 'success'){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Shuttle Allocation Submitted',
                      showConfirmButton: false,
                      timer: 2000
                    })
                    setInterval(function(){
                      location.reload();
                    },'2000');
                  }
                });
          }
    });
  // Resubmit Allocation
    $('#btnResubmit').click(function(){
      var data = '<?=$handle?>';
      var handle = data.replace("&","@");
      (async () => {
        const { value: remarks } = await Swal.fire({
          title: 'Remarks',
          input: 'text',
          inputPlaceholder: 'Remarks'
        })
        if (remarks) {
          $.ajax({
            url: 'functions/process/allocation.php?process=filingRemarks&recNo=<?=$recId?>&remarks='+remarks+'&user=<?=$userEmpName?>',
            method: 'get',
            success: function(response){
              if(response == 'done'){
                $('#btnSubmit').prop('disabled', false);
                $('#btnResubmit').css('display','none');
                $.ajax({
                  url: 'functions/display/user_allocation.php?data=filedDetailsNow&handle='+handle+'&shift=<?=$shift?>',
                  method: 'get',
                  dataType: 'json',
                  success: function(data){
                    for (var i in data){
                      var id = data[i].idNumber;
                      var route = data[i].route;
                      var outGoing = data[i].outGoing;
                      // Route
                        if(route != ''){
                          $('#empR'+id).text(route);
                        }
                      // OutGoing
                        document.getElementById('emp'+outGoing+id).checked = true
                    }
                  },error: function(response){

                  }
                });
              }
            },error: function(response){

            }
          });
        }
      })();
    });
</script>
</body>
</html>

  

