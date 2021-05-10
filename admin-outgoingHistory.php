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
<title>SAS - Shuttle Allocation Reports</title>
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
        <h4 class="card-title text-center mt-2">Shuttle Allocation Summary History</h4>
        <div class="card-body">
          <!-- Filter Data -->
          <div class="row">
            <div class="col-lg-12">
              <form action="#" method="get">
                <div class="form-row">
                  <div class="col-lg-3">
                    <input type="date" name="date" id="dateFiled" class="form-control">
                  </div>
                  <div class="col-lg-3">
                    <select class="browser-default custom-select" id="shift" name="shift">
                    <option value="" selected>Select Shift</option>
                    <option value="DS">Day Shift</option>
                    <option value="NS">Night Shift</option>
                  </select>
                  </div>
                  <div class="col-lg-6">
                    <button type="submit" class="btn btn-sm btn-primary" id="btnSubmit">Generate</button>
                    <button class="btn btn-sm btn-danger" id="btnExportSummary"><i class="fas fa-download"></i> Export Summary</button>
                  </div>
                <div>
              </form>
            </div>
          </div>
          <div id="summary">
            <!-- Data Input -->
            <div class="row">
              <div class="col-lg-12 mt-2">
                <p class="text-center">Outgoing Report for: <span id="date" class="font-weight-bolder"> </span>  <span id="shiftT" class="font-weight-bolder"> </span></p>
              </div>
            </div>
            <!-- Data Generated -->
            <div class="row mt-2">
              <?php
                //  GET DATA TO GENERATE 
                  if(isset($_GET['date']) && isset($_GET['shift'])){
                    $date = $_GET['date'];
                    $shift = $_GET['shift'];
                    $dateDisp = date('F j, Y',strtotime($date));
                  }else{
                    $date = '';
                    $shift = '';
                  }
              ?>
              <div class="col-lg-12">
                <table class="mt-1 table table-sm table-bordered text-center" border="1">
                  <thead>
                      <tr>
                        <th>Total Area A</th>
                        <th>Total Area B</th>
                        <th>Total MP Filed</th>
                      </tr>
                  </thead>
                    <tbody>
                    <?php
                        if($shift == 'DS'){
                          $queryCount = "SELECT COUNT(listId) AS total,empArea FROM `sas_d_outgoing` WHERE dtFiled = '$date' AND shift = '$shift' GROUP BY empArea";
                          $queryCountAll = "SELECT COUNT(listId) AS totalA FROM `sas_d_outgoing` WHERE dtFiled = '$date' AND shift = '$shift'";
                        }else{
                          $dateScope = date('Y-m-d', strtotime($date . ' +1 day'));
                          $queryCount = "SELECT COUNT(listId) AS total,empArea FROM `sas_d_outgoing` WHERE dtFiled BETWEEN '$date' AND '$dateScope' AND shift = '$shift' GROUP BY empArea";
                          $queryCountAll = "SELECT COUNT(listId) AS totalA FROM `sas_d_outgoing` WHERE dtFiled BETWEEN '$date' AND '$dateScope' AND shift = '$shift'";
                        }
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
                      <tr>
                        <td><?=$totA?></td>
                        <td><?=$totB?></td>
                        <td><?=$totAll?></td>
                      </tr>
                    </tbody>
                    </table>
              </div>
              <div class="col-lg-6">
                <table class="table table-bordered text-center table-sm" id="sumAreaA">
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
                        if($date != '' && $shift != ''){
                          foreach($queryRoute as $key => $route){
                            $route = $route['route'];
                            echo '<td>'.$route.'</td>';
                            foreach($queryOut as $key => $timeOut){
                              $timeOut = $timeOut['outGoing'];
                              if($shift == 'DS'){
                                $sqlGetTotPrev = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE `route` = '$route' AND `outGoing` = '$timeOut' AND `dtFiled` = '$date' AND `shift` = '$shift' AND `empArea` = 'A'";
                              }elseif($shift == 'NS'){
                                $sqlGetTotPrev = "SELECT COUNT(listId) AS count FROM `sas_d_outgoing` WHERE `route` = '$route' AND `outGoing` = '$timeOut' AND `dtFiled` BETWEEN '$date' AND '$dateScope' AND `shift` = '$shift' AND `empArea` = 'A'";
                              }
                              $sqlCount = $conn->query($sqlGetTotPrev);
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
                              if($shift == 'DS'){
                                $sqlTotCountPrev = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE outGoing = '$timeOut' AND `dtFiled` = '$date' AND `shift` = '$shift' AND `empArea` = 'A'";
                              }elseif($shift == 'NS'){
                                $sqlTotCountPrev = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE outGoing = '$timeOut' AND `dtFiled` BETWEEN '$date' AND '$dateScope' AND `shift` = '$shift' AND `empArea` = 'A'";
                              }
                              $queryCnt = $conn->query($sqlTotCountPrev);
                              $data = $queryCnt->fetch_assoc();
                              $totalCount = $data['count'];
                              echo '<td>'.$totalCount.'</td>';
                            }
                            echo '<tr>';
                          }
                        }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-6">
                <table class="table table-bordered text-center table-sm" id="sumAreaB">
                  <thead>
                    <tr>
                      <th colspan="<?=$countofCol?>">Area B</th>
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
                        if($date != '' && $shift != ''){
                          foreach($queryRoute as $key => $route){
                            $route = $route['route'];
                            echo '<td>'.$route.'</td>';
                            foreach($queryOut as $key => $timeOut){
                              $timeOut = $timeOut['outGoing'];
                              if($shift == 'DS'){
                                $sqlGetTotPrevB = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE `route` = '$route' AND `outGoing` = '$timeOut' AND `dtFiled` = '$date' AND `shift` = '$shift' AND `empArea` = 'B'";
                              }elseif($shift == 'NS'){
                                $sqlGetTotPrevB = "SELECT COUNT(listId) AS count FROM `sas_d_outgoing` WHERE `route` = '$route' AND `outGoing` = '$timeOut' AND `dtFiled` BETWEEN '$date' AND '$dateScope' AND `shift` = '$shift' AND `empArea` = 'B'";
                              }
                              $sqlCount = $conn->query($sqlGetTotPrevB);
                                $count = $sqlCount->fetch_assoc();
                                $outCount = $count['count'];
                                echo '<td>'.$outCount.'</td>';
                            }
                            $numRow1++;
                            echo '</tr>';
                          }
                          if($numRow1 == $countofRow){
                            echo '<tr><td>Total</td>';
                            foreach($queryOut as $key => $timeOut){
                              $timeOut = $timeOut['outGoing'];
                              if($shift == 'DS'){
                                $sqlTotCountPrevB = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE outGoing = '$timeOut' AND `dtFiled` = '$date' AND `shift` = '$shift' AND `empArea` = 'B'";
                              }elseif($shift == 'NS'){
                                $sqlTotCountPrevB = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE outGoing = '$timeOut' AND `dtFiled` BETWEEN '$date' AND '$dateScope' AND `shift` = '$shift' AND `empArea` = 'B'";
                              }
                              $queryCnt = $conn->query($sqlTotCountPrevB);
                              $data = $queryCnt->fetch_assoc();
                              $totalCount = $data['count'];
                              echo '<td>'.$totalCount.'</td>';
                            }
                            echo '<tr>';
                          }
                        }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            <!-- Filing Status -->
         <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <h5 class="card-title text-center mt-1">Filing Status</h5>
              <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-sm table-bordered text-center" id="filersTbl">
                      <thead>
                          <tr>
                            <th>Section</th>
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
  displayFilingStat('<?=$date?>/<?=$shift?>');
});
  // FUNCTIONS TO UI
    // Display Filing Status
      const displayFilingStat = (x) => {
        if(x != ''){
          var filter = x.split("/");
          let date = filter[0];
          let shift = filter[1];
          $('#date').text('<?=$dateDisp?>');
          $('#shiftT').text(shift);
          $.ajax({
            url: 'functions/display/shuttle_allocation.php?data=filers&shift='+shift+'&date='+date,
            method: 'get',
            success: function(response){
              console.log(response);
              $('#tblFilingStat').html(response);
              $('#filersTbl').DataTable();
            },error: function(){
            }
          });
        }
      }
    // Display Filer Details
      const viewFiled = (x) => {
        var table = $('#detailsFiledTbl').DataTable();
        table.destroy();
        $('#filedDetails').modal();
        $('#section').html(x);
        $.ajax({
          url: 'functions/display/shuttle_allocation.php?data=filedDetails&deptCode='+x+'&shift=<?=$shift?>&date=<?=$date?>',
          method: 'get',
          success: function(response){
            $('#tblfiledMP').html(response);
            $('#detailsFiledTbl').dataTable();
          },error: function(response){
          }
        })
        $.ajax({
          url: 'functions/display/shuttle_allocation.php?data=filedCDetails&deptCode='+x+'&shift=<?=$shift?>&date=<?=$date?>',
          method: 'get',
          success: function(response){
            $('#detailsCFiledTbl').html(response);
          },error: function(response){
          }
        })
      }
  // Export Summary 
    $('#btnExportSummary').click(function (e) {
      window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=summary]').html()));
      e.preventDefault();
    });
  // Export Department Summary
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
            


                      