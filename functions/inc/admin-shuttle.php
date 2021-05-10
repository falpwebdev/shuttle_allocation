<?php
  date_default_timezone_set("Asia/Manila");
  // QUERIES TO DISPLAY
    // GENERATING OF DATA TO DISPLAY IN TABLE HEADERS
      $sqlGetOut = "SELECT outGoing FROM a_m_outgoing";
      $queryOut = $conn->query($sqlGetOut);
      $countofCol = mysqli_num_rows($queryOut);
      $countofCol++;
    // GENERATING ROUTES TO DISPLAY IN TABLE
      $sqlGetRoute = "SELECT * FROM `sas_m_route` ORDER BY `listOrder`  ASC";
      $queryRoute = $conn->query($sqlGetRoute);
      $countofRow = mysqli_num_rows($queryRoute);
  // Variables
    $numRow = 0;
    $numRow1 = 0; 
    $timeNow = date('H:i:s');
    $dateToday = date('Y-m-d');
    // $timeNow = '24:00:00';

  // Generate FILING COUNT WHEN OPENED
    if(($timeNow >= '07:59:59' && $timeNow <= '19:59:59')){
      $datePresent = $dateToday;
      $shift = 'DS';
    }else{
      if($timeNow >= '20:00:00' &&  $timeNow <= '23:59:59'){
        $datePresent = $dateToday;
        $shift = 'NS';
      }else if($timeNow >= '00:00:00' && $timeNow <= '07:59:59'){
        $datePresent = date('Y-m-d', strtotime($dateToday . ' -1 day'));
        $shift = 'NS';
      }
    }
  // QUERIES TO COUNT
    $sql = "SELECT COUNT(`listId`) AS totalCount FROM `sas_d_outgoing` WHERE `datePresent` = '$datePresent' AND `shift` = '$shift'";
    $queryCount = "SELECT COUNT(listId) AS total,empArea FROM `sas_d_outgoing` WHERE `datePresent` = '$datePresent' AND `shift` = '$shift' GROUP BY empArea";
    $queryCountAll = "SELECT COUNT(listId) AS totalA FROM `sas_d_outgoing` WHERE `datePresent` = '$datePresent' AND `shift` = '$shift'";
    $sqlGetTot = "SELECT COUNT(listId) AS count FROM `sas_d_outgoing` WHERE `datePresent` = '$datePresent' AND `shift` = '$shift'";
    $sqlTotCount = "SELECT COUNT(listId) AS count FROM sas_d_outgoing WHERE `datePresent` = '$datePresent' AND `shift` = '$shift'";
    $query = $conn->query($sql);
      $dat = $query->fetch_assoc();
      $totCount = $dat['totalCount'];
?>
