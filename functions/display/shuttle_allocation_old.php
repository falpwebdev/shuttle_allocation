<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';

  // Variables 
    $timeNow = date('H:i:s');
  // Datefiled Clause
    if($timeNow >= '07:59:59' && $timeNow <= '19:59:59')
    {
      $dtFiled = "`dtFiled` = (SELECT CURRENT_DATE()) AND `shift` = 'DS'";
    }else{
      if($timeNow >= '20:00:00' &&  $timeNow <= '23:59:59'){
        // Night 8PM - 11:59PM
          $dateFrom = date("Y-m-d");
          $dateTo = date('Y-m-d', strtotime($dateFrom . ' +1 day'));
        
      }else if($timeNow >= '00:00:00' && $timeNow <= '07:59:59'){
        // Morning 12AM - 7:59 AM
          $dateTo = date("Y-m-d");
          $dateFrom = date('Y-m-d', strtotime($dateTo . ' -1 day'));
      }
      $dtFiled = "`dtFiled` BETWEEN '$dateFrom' AND '$dateTo' AND `shift` = 'NS'";
    }
    // If Shift is defined
      if(isset($_GET['shift'])){
        $shift = $_GET['shift'];
        $date = $_GET['date'];
        if($shift == 'DS'){
          $dtFiled = "`dtFiled` = '$date' AND `shift` = 'DS'";
        }else if($shift == 'NS'){
          $dateFrom =  $date;
          $dateTo = date('Y-m-d', strtotime($date . ' +1 day'));
          $dtFiled = "`dtFiled` BETWEEN '$dateFrom' AND '$dateTo' AND `shift` = 'NS'";
        }
      }
  // Request Processing
    if(isset($_GET['data'])){
      $rqst = $_GET['data'];
      if ($rqst == 'filers'){
        // Filers of Shuttle Allocation Today
          $sql = "SELECT `deptCode`,COUNT(`idNumber`) AS totCount FROM `sas_d_outgoing` WHERE".$dtFiled." GROUP BY `deptCode`";
          $query = $conn->query($sql);
            while ($fileData = $query->fetch_assoc()) {
              $deptCode = $fileData['deptCode'];
              $totCount = $fileData['totCount'];
              echo '<tr onclick="viewFiled(&quot;'.$deptCode.'&quot;);">
                <td>'.$deptCode.'</td>
                <td>'.$totCount.'</td>
              </tr>';
            }
      }else if($rqst == 'filedDetails'){
        // Filing Details Department of Shuttle Allocation Today
        $deptCode = $_GET['deptCode'];
        $sql = "SELECT * FROM `sas_d_outgoing` WHERE ".$dtFiled." AND deptCode = '$deptCode'";
        $query = $conn->query($sql);
          while($data = $query->fetch_assoc()){ 
            $idNumber = $data['idNumber'];
            $deptGrp = $data['deptGrp'];
            $empName = $data['empName'];
            $route = $data['route'];
            $lineNo = $data['lineNo'];
            $outGoing = $data['outGoing'];
            $time = $data['timeFiled'];
            $timeFiled = date('h:i:s',strtotime($time));
            $filedBy = $data['filedBy'];

            echo '<tr>
            <td>'.$deptGrp.'</td>
            <td>'.$lineNo.'</td>
            <td>'.$idNumber.'</td>
            <td>'.$empName.'</td>
            <td>'.$route.'</td>
            <td>'.$outGoing.'</td>
            <td>'.$timeFiled.'</td>
            <td>'.$filedBy.'</td>
            </tr>';
          }
      }else if($rqst == 'filedCDetails'){
        $deptCode = $_GET['deptCode'];
        echo '<thead><tr>';
        foreach ($outGoingList as $key => $x) {
          echo '<th>'.$x.' (MP)</th>';
        }
        echo '</tr></thead>';
        echo '<tbody><tr>';
        foreach ($outGoingList as $key => $x) {
          $sql = "SELECT COUNT(idNumber) AS `count` FROM `sas_d_outgoing` WHERE".$dtFiled." AND `outGoing` = '$x' AND deptCode = '$deptCode'";
          $query = $conn->query($sql);
          while($data = $query->fetch_assoc()){
            echo '<td>'.$data['count'].'</td>';
          }
        }
        echo '</tr></tbody>';
      }
    }
?>