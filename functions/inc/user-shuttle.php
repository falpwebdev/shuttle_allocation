<?php
  date_default_timezone_set("Asia/Manila");
  // GET USER INFO
  $userId = $_SESSION['idNumber'];
  $userEmpName = $_SESSION['empName'];
  $userHandle = $_SESSION['handle'];
  $handlex = $userHandle;
  $shift = $_SESSION['shift'];
  $userType = $_SESSION['userType'];
  $dateFor = date('Y-m-d');
  if($userType == 'Agency'){
    $sql = "SELECT * FROM sas_m_adminacc WHERE idNumber = '$userId' AND adName = '$userEmpName'";
    $query = $conn->query($sql);
    $count = mysqli_num_rows($query);
    while ($userData = $query->fetch_assoc()) {
      $handle = $userData['adEmployer'];
    }
    $dpmt = $handle;

  }else if($userType == 'Clerk' || $userType = 'Line Leader'){
    $sql = "SELECT * FROM sas_m_accounts WHERE idNumber = '$userId' AND empName = '$userEmpName'";
    $query = $conn->query($sql);
    $count = mysqli_num_rows($query);
    if($count == 1){
      while ($userData = $query->fetch_assoc()) {
        $handle = $userData['empHandleLine'];
        $dpmt = $userData['empDeptCode'];
      }
    }else{
      $dpmt = '';
    }
  }
// Disable Submit Button Get Time first
  $timeNow = date("H:i:s");
  $sql = "SELECT `timeCutoff` FROM `m_cutoff_time` WHERE shift = '$shift';";
  $query = $conn1->query($sql);
  $data = $query->fetch_assoc();
  $cutOff = $data['timeCutoff'];
  // $timeNow = '12:00';
  if($shift == 'DS' || $shift == 'ADS'){
    $forShift = "DS";
    // Filing time for DS 8am - 3pm
    if($timeNow >= '08:00:00' && $timeNow <= $cutOff){
      $SubBtnStat = 'file';
    }else{
      $SubBtnStat = 'disable';
    }
  }elseif($shift == 'NS'){
    $forShift = "NS";
    // Filing time for NS 8pm - 3am
    if(($timeNow >= '20:00:00' &&  $timeNow <= '24:00:00') || ($timeNow <= '24:00:00' && $timeNow <= $cutOff)){
      $SubBtnStat = 'file';
    }else{
      $SubBtnStat = 'disable';
    }
  }
// GENERATE HANDLE COUNT WHEN OPENED AND EMPLOYEES DATA
  //  Column for Handle
    if($userType == 'Clerk' || $userType == 'Agency'){
      $filedClause = "empHandler = '$handle' AND (`lineNo` = '' OR `lineNo` = '0')";
    }elseif($userType == 'Line Leader'){
      $filedClause = "lineNo = '$handle'";
    }
  // Shift Handle
  if($shift == 'DS' || $shift == 'ADS'){
    $sqlShift = " AND `empShift` != 'NS'";
  }else{
    $sqlShift = " AND `empShift` = 'NS'";
    if($timeNow >= '00:00:00' && $timeNow <= '07:59:59'){
      $dateFor = date('Y-m-d', strtotime($dateFor . ' -1 day'));
    }
  }
  // CHECK IF ALREADY FILED
    $sqlSelectRec = "SELECT * FROM `sas_d_filing` WHERE filedFor = '$handle' AND `dateFor` = '$dateFor' AND `shift` = '$shift' AND remarks = '' ORDER BY listId DESC LIMIT 1";
    $querySearch = $conn->query($sqlSelectRec);
    $count = mysqli_num_rows($querySearch);
    $buttonSub = '';
    if($count != "0"){
      $buttonSub = 'true';
      $dat = $querySearch->fetch_assoc();
      $recId = $dat['listId']; 
    }else{
      $buttonSub = 'false';
      $recId = '';
    }
  
  // Get Handled MP
    // Count
      $sqlHandleMP = "SELECT COUNT(`idNumber`) as handleMP FROM `a_m_employee` WHERE `status` = 'Active'";
      $sqlMPDat = "SELECT * FROM `a_m_employee` WHERE `status` = 'Active'";
      // Interface
        
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
      $sqlMPDat = $sqlMPDat . $handleClause;
      
      $query = $conn->query($sqlHandleMP);
          $data = $query->fetch_assoc();
          $totcount = $data['handleMP'];

      $queryMP = $conn->query($sqlMPDat);
      

?>

