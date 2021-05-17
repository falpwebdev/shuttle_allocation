<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  // Variables
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $dateToday = date('Y-m-d');
    $timeNow = date('H:i:s');
    if(isset($_GET['process'])){
      $process = $_GET['process'];
      if($process == 'filingMP_count'){
        $interface = $_GET['interface'];
        $userType = $_GET['type'];
        $handle = $_GET['handle'];
        $handle = str_replace("@","&",$handle); 
          $sqlHandleMP = "SELECT COUNT(`idNumber`) as handleMP FROM `a_m_employee` WHERE `status` = 'Active'";
          if(isset($_GET['shift'])){
            $shift = $_GET['shift'];
              if($shift == 'DS' || $shift == 'ADS'){
                $sqlShift = " AND `empShift` != 'NS'";
              }else{
                $sqlShift = " AND `empShift` = 'NS'";
              }
          }
          if($interface == 'shuttle'){
            if($userType == 'Clerk' || $userType == 'Agency'){
              $handleClause = " AND `empHandler` = '$handle' AND `lineNo` = 'N/A'".$sqlShift;
            }else if($userType == 'Line Leader'){
              $handleClause = " AND `lineNo` = '$handle'".$sqlShift;
            }
          }else if($interface == 'department'){
            if($userType == 'Clerk' || $userType == 'Agency'){
              $handleClause = " AND `empHandler` = '$handle'";
            }else if($userType == 'Line Leader'){
              $handleClause = " AND `lineNo` = '$handle'";
            }
          }
          $sqlHandleMP = $sqlHandleMP . $handleClause;
          $query = $conn->query($sqlHandleMP);
          $data = $query->fetch_assoc();
          echo $count = $data['handleMP'];
      }else if($process == 'outGoingMP_count'){
        $datePresent = $_GET['datePresent'];
        $shift = $_GET['shift']; 

        $sql = "SELECT COUNT(`listId`) AS totalCount FROM `sas_d_outgoing` WHERE `datePresent` = '$datePresent' AND `shift` = '$shift'";
        $query = $conn->query($sql);
        $data = $query->fetch_assoc();
        echo $count = $data['totalCount'];
      }else if($process == 'unreadNotif_count'){
        $handle = $_GET['handle'];
        $handle = str_replace("@","&",$handle); 
          $sqlGetCount = "SELECT COUNT(`listId`) AS toRead FROM `sas_notifs` WHERE `handler` = '$handle' AND `status` = 'new';";
          $queryGC = $conn->query($sqlGetCount);
          $datC = $queryGC->fetch_array();
            echo $notifCount = $datC['toRead']; 
      }else if($process == 'readNotif_count'){
        $handle = $_GET['handle'];
        $handle = str_replace("@","&",$handle); 
          $sqlUpdate = "UPDATE `sas_notifs` SET `status`='read' WHERE `handler` = '$handle' AND `status` = 'new'";
          $queryGC = $conn->query($sqlUpdate);
            echo '0'; 
      }
    }