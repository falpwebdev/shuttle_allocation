<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  // Variables 
    $timeNow = date('H:i:s');
    $dateToday = date('Y-m-d');
  // Datefiled Clause
    if($timeNow >= '07:59:59' && $timeNow <= '19:59:59'){
      $dateFor = $dateToday;
      $shift = 'DS';
    }else{
      $shift = 'NS';
      if($timeNow >= '20:00:00' &&  $timeNow <= '23:59:59'){
        $dateFor = $dateToday;
      }else if($timeNow >= '00:00:00' && $timeNow <= '07:59:59'){
        $dateFor = date('Y-m-d', strtotime($dateToday . ' -1 day'));
      }
    }
  // If Shift is defined
    if(isset($_GET['shift'])){
      $shift = $_GET['shift'];
      $dateFor = $_GET['date'];
    }
  // Request Processing
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if ($rqst == 'filers'){
      // Filers of Shuttle Allocation Today
        $sql = "SELECT `deptCode`,COUNT(`idNumber`) AS totCount FROM `sas_d_outgoing` WHERE `datePresent` = '$dateFor' AND `shift` = '$shift' GROUP BY `deptCode`";
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
      $sql = "SELECT * FROM `sas_d_outgoing` WHERE `datePresent` = '$dateFor' AND `shift` = '$shift' AND deptCode = '$deptCode'";
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
        $sql = "SELECT COUNT(idNumber) AS `count` FROM `sas_d_outgoing` WHERE `datePresent` = '$dateFor' AND `shift` = '$shift' AND `outGoing` = '$x' AND deptCode = '$deptCode'";
        $query = $conn->query($sql);
        while($data = $query->fetch_assoc()){
          echo '<td>'.$data['count'].'</td>';
        }
      }
      echo '</tr></tbody>';
    }
  }
    