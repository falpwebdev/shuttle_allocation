<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  include 'db/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>SAS - Shuttle Allocation Today</title>
<?php
  include 'src/style.php';
?>
</head>
<body>
<?php
  include 'src/navs/admin-topnav.php';
  include 'functions/inc/admin-shuttle.php';
  include 'modals/filingDetails.php';
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <h4 class="card-title text-center mt-2">Shuttle Allocation Summary (<?=$shift?>)</h4>
          <!-- COUNT OF FILED MP -->
            <input type="hidden" id="countStatus" value="<?=$totCount?>">
          <!-- COUNT OF FILED MP -->
          
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 d-flex justify-content-end">
                <button class="btn btn-sm btn-danger" id="btnExportSummary"><i class="fas fa-download"></i> Export Summary</button>
                <a href="admin-outgoingHistory.php" class="btn btn-sm btn-primary"><i class="far fa-eye"></i> View History Data</a>
                <a href="admin-outgoingModify.php" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i> Modify Outgoing Data</a>
            </div>
          </div>
          <div id="summary">
            <div class="row">
              <div class="col-lg-12">
                <!-- GENERATE OUTGOING COUNT PER AREA -->
                  <?php
                    $query = $conn->query($queryCount);
                    $count = mysqli_num_rows($query);
                    if($count >= '1'){
                      $totA = 0;
                      $totB = 0;
                      while($data = $query->fetch_assoc()){
                        $total = $data['total'];
                        $area = $data['empArea'];
                          if($area == 'A'){
                            $totA = $total;
                          }
                          if($area == 'B'){
                            $totB = $total;
                          }
                      }
                      $queryA = $conn->query($queryCountAll);
                      $data = $queryA->fetch_assoc();
                      $totAll = $data['totalA'];
                    }else{
                      $totA = 0;
                      $totB = 0;
                      $totAll = 0;
                    }
                  ?>
                  <table class="mt-1 table table-sm table-bordered text-center" border="1">
                    <thead>
                      <tr>
                        <th>Total Area A</th>
                        <th>Total Area B</th>
                        <th>Total MP Filed</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?=$totA?></td>
                        <td><?=$totB?></td>
                        <td><?=$totAll?></td>
                      </tr>
                    </tbody>
                  </table>
                <!-- GENERATE OUTGOING COUNT PER AREA -->
              </div>
            </div>
            <div class="row mt-3">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <!-- AREA A -->
                      <td>
                        <table class="table table-bordered text-center table-sm" id="sumAreaA" border="1">
                          <thead>
                            <tr>
                              <th colspan="<?=$countofCol;?>">Area A</th>
                            </tr>
                            <tr>
                              <th>Route</th>
                              <?php
                                foreach ($queryOut as $key => $timeOut){
                                  $timeOut = $timeOut['outGoing'];
                              ?>
                                <th><?=$timeOut?> (MP) </th>
                              <?php
                                } 
                              ?>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <?php
                                foreach($queryRoute as $key => $route){
                                  $route = $route['route'];
                                  echo '<td>'.$route.'</td>';
                                  foreach($queryOut as $key => $timeOut){
                                    $timeOut = $timeOut['outGoing'];
                                    $sqlGetTotA = $sqlGetTot . "AND `route` = '$route' AND `outGoing` = '$timeOut' AND `empArea` = 'A'";
                                    $sqlCount = $conn->query($sqlGetTotA);
                                    $count = $sqlCount->fetch_assoc();
                                      $outCount = $count['count'];
                                      echo '<td>'.$outCount.'</td>';
                                  }
                                    $numRow++;
                                    echo '</tr>';
                                }
                                if($numRow == $countofRow){
                                  echo '<tr><td>Total</td>';
                                  foreach($queryOut as $key => $timeOut){
                                    $timeOut = $timeOut['outGoing'];
                                    $sqlTotCountA = $sqlTotCount . "AND outGoing = '$timeOut' AND `empArea` = 'A'";
                                    $queryCnt = $conn->query($sqlTotCountA);
                                    $data = $queryCnt->fetch_assoc();
                                    $totalCount = $data['count'];
                                    echo '<td>'.$totalCount.'</td>';
                                  }
                                  echo '</tr>';
                                }
                              ?>
                          </tbody>
                        </table>
                      </td>
                    <!-- END AREA A -->
                    <td>
                    </td>
                    <!-- AREA B -->
                      <td>
                        <table class="table table-bordered text-center table-sm" id="sumAreaB" border="1">
                          <thead>
                            <tr>
                            <th colspan="<?=$countofCol;?>">Area B</th>
                            </tr>
                            <tr>
                              <th>Route</th>
                              <?php
                                foreach ($queryOut as $key => $timeOut){
                                  $timeOut = $timeOut['outGoing'];
                              ?>
                                <th><?=$timeOut?> (MP) </th>
                              <?php
                                } 
                              ?>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <?php
                                foreach($queryRoute as $key => $route){
                                  $route = $route['route'];
                                  echo '<td>'.$route.'</td>';
                                  foreach($queryOut as $key => $timeOut){
                                    $timeOut = $timeOut['outGoing'];
                                    $sqlGetTotB = $sqlGetTot . "AND `route` = '$route' AND `outGoing` = '$timeOut' AND `empArea` = 'B'";
                                    $sqlCount1 = $conn->query($sqlGetTotB);
                                    $count1 = $sqlCount1->fetch_assoc();
                                      $outCountB = $count1['count'];
                                      echo '<td>'.$outCountB.'</td>';
                                  }
                                    $numRow1++;
                                    echo '</tr>';
                                }
                                if($numRow1 == $countofRow){
                                  echo '<tr><td>Total</td>';
                                  foreach($queryOut as $key => $timeOut){
                                    $timeOut = $timeOut['outGoing'];
                                    $sqlTotCountB = $sqlTotCount . "AND outGoing = '$timeOut' AND `empArea` = 'B'";
                                    $queryCnt = $conn->query($sqlTotCountB);
                                    $data = $queryCnt->fetch_assoc();
                                    $totalCountB = $data['count'];
                                    echo '<td>'.$totalCountB.'</td>';
                                  }
                                  echo '</tr>';
                                }
                              ?>
                          </tbody>
                        </table>
                      </td>
                      </tbody>
                        </table>
                      </td>
                    <!-- END AREA B -->
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="row">
            <!-- FILING STATUS SECTION -->
              <div class="col-lg-12">
                <div class="card">
                  <h5 class="card-title text-center mt-1">Filing Status</h5>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <table class="table table-sm table-bordered text-center" id="filersTbl">
                          <thead>
                              <tr>
                                <th>Department</th>
                                <th>Total MP</th>
                              </tr>
                          </thead>
                          <tbody id="tblFilingStat">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- END FINILING STATS -->
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
    $('#navHome').addClass('font-weight-bold');
    $('#navHome').css('color','#CC0000');
    displayFilingStat();
  });
  // RUNNING FUNCTIONS
    //  Realtime Count of Filed Outgoing
    setInterval(function(){
        $.ajax({
          url: 'functions/process/realtime_count.php?process=outGoingMP_count&shift=<?=$shift?>&datePresent=<?=$datePresent?>',
          method: 'get',
          success: function(response){
            console.log(response);
            if('<?=$totCount?>' != response){
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
          },error: function(reseponse){
          }
        });
      }, 3000);
    // Display Filing Status
      const displayFilingStat = () => {
        $.ajax({
          url: 'functions/display/shuttle_allocation.php?data=filers',
          method: 'get',
          success: function(response){
            $('#tblFilingStat').html(response);
            $('#filersTbl').DataTable();
          },error: function(){
          }
        });
      }
    // Display Details of Filers
      const viewFiled = (x) => {
        var table = $('#detailsFiledTbl').DataTable();
        table.destroy();
        $('#filedDetails').modal();
        $('#section').html(x);
        $.ajax({
          url: 'functions/display/shuttle_allocation.php?data=filedDetails&deptCode='+x,
          method: 'get',
          success: function(response){
            console.log(response);
            $('#tblfiledMP').html(response);
            $('#detailsFiledTbl').dataTable();
          },error: function(response){
          }
        })
        $.ajax({
          url: 'functions/display/shuttle_allocation.php?data=filedCDetails&deptCode='+x,
          method: 'get',
          success: function(response){
            $('#detailsCFiledTbl').html(response);
          },error: function(response){
          }
        })
      }
  // Export Outgoing Summary
    // Download Report Overall Summary
      $('#btnExportSummary').click(function (e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=summary]').html()));
        e.preventDefault();
      });
    // Download Report Department Summary
      $('#btnExportDSummary').click(function (e) {
        var table = $('#detailsFiledTbl').DataTable();
        table.destroy();
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=deptSummary]').html()));
        e.preventDefault();
        $('#detailsFiledTbl').dataTable();
      });
</script>
</body>
</html>                