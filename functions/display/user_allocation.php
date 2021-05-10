<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  $dateToday = date('Y-m-d');
  $timeNow = date('H:i:s');
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'filedDetailsNow'){
      $handle = $_GET['handle'];
      $shift = $_GET['shift'];
      // Determine Date Filed For
      if($timeNow >= '00:00:00' && $timeNow <= '07:59:59'){
        $dateFor = date('Y-m-d', strtotime($dateToday . ' -1 day'));
      }else{
        $dateFor = $dateToday;
      }
      // Variables
        $changeShuttle = array();
        $outgoingMP = array();
        $absentMP = array();
        $filedData = array();
      // Get Handles
        $sqlGetHandle = "SELECT idNumber FROM `a_m_employee` WHERE `empHandler` = '$handle' AND `empShift` = '$shift'";
        $queryH = $conn->query($sqlGetHandle);
          while ($datH = $queryH->fetch_assoc()) {
            $idNumber = $datH['idNumber'];
              // Get Outgoing
                $sqlGetOut = "SELECT `idNumber`, `outGoing`, `route` FROM `sas_d_outgoing` WHERE `datePresent` = '$dateFor' AND `idNumber` = '$idNumber' AND `shift` = '$shift'";
                $queryO = $conn->query($sqlGetOut);
                  while ($datO = $queryO->fetch_assoc()) {
                    $outgoingMP[] = array(
                      "idNumber" => $datO['idNumber'],
                      "route" => $datO['route'],
                      "outGoing" => $datO['outGoing']
                    );
                  }
              // Get Absent
                $sqlGetAbsent = "SELECT `idNumber`, `category` FROM `sas_d_absent` WHERE `dateAbsent` = '$dateFor' AND `idNumber` = '$idNumber' AND `shift` = '$shift'";
                $queryA = $conn->query($sqlGetAbsent);
                  while ($datA = $queryA->fetch_assoc()) {
                    $absentMP[] = array(
                      "idNumber" => $datA['idNumber'],
                      "route" => '',
                      "outGoing" => $datA['category']
                    );
                  }
          }
      // Merge Array
       $filedData = array_merge_recursive($outgoingMP,$absentMP);
       echo json_encode($filedData);
    }elseif ($rqst == 'sas_m_route') {
      echo '<option selected value="0">Select Route</option>';
      $sql = "SELECT * FROM `sas_m_route`";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $route1 = $data['route'];
        $route2 = strtolower($route1);
          $route = ucwords($route2);
        echo '<option value="'.$route1.'">'.$route.'</option>';
      }
    }
  }