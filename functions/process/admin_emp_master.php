<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
   // Variables
   $ipAdd = $_SERVER['REMOTE_ADDR'];
   $dateToday = date('Y-m-d');
   $timeNow = date('H:i:s');
   if(isset($_GET['process'])){
    $process = $_GET['process'];
    $user = $_GET['user'];
    if($process == 'add_MP'){
      $data = json_decode($_GET['newData']);
        $newEmpId = $data->idNumber;
        //  Fix Name Format
        $eName = $data->empName;
          $eName = str_replace(",",", ",$eName);
          $empName1 = mb_strtolower($eName);
          $newEmpName = ucwords($empName1," ");
        $dateHired = $data->dateHired;
        $batchNo = $data->batchNo;
        $eNName = $data->empNickName;
        // Fix Nick name format
          $newEmpNickname1 = strtolower($eNName);
          $newEmpNickname = ucwords($newEmpNickname1," ");
        $newEmpContact = $data->empcontact;
        $newEmpPosition = $data->empPosition;
        $newEmpCostCent = $data->empCostCenter;
        $newEmpAgency = $data->empAgency;
        $newEmpAgency = strtoupper($newEmpAgency);
        $newEmpDept = $data->empDeptCode;
        $newEmpArea = $data->empArea;
        $newEmpRoute = $data->empRoute;
        $newEmpShift = $data->empShift;
        $newEmpSsched = $data->empShiftTime;
        $jobType = $data->jobType;
          // Set Handler of Employee
          if(in_array($newEmpDept,$specialDept)){
            $empHandler = $newEmpAgency;
          }else{
            $empHandler = 'Recruitment and Training';
          }
            // Insert New Employee
              $sqlInsertNewEmp = "INSERT INTO `a_m_employee`(`idNumber`, `empName`, `dateHired`,`batchNo`,`empNickname`, `empContact`, `empPosition`, `empCostCenter`, `empAgency`, `empDeptCode`, `empDeptSection`,`empSubSect`,`lineNo`, `empArea`, `empRoute`, `empShift`, `empShiftTime`, `empHandler`,`status`,`jobType`) VALUES ('$newEmpId','$newEmpName','$dateHired','$batchNo','$newEmpNickname','$newEmpContact','$newEmpPosition','$newEmpCostCent','$newEmpAgency','$newEmpDept','N/A','N/A','0','$newEmpArea','$newEmpRoute', '$newEmpShift','$newEmpSsched', '$empHandler','Active','$jobType');";
              $query = $conn->query($sqlInsertNewEmp);
                if($query){
                  // Record Employee History
                    $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$newEmpId',(SELECT CURRENT_TIMESTAMP()),'Employee Added to Master',(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'))";
                      $query1 = $conn->query($sqlInsertRec);
                  // Senc Notification to Handler
                    $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','New Employee','$newEmpId - $newEmpName',(SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'new')";
                      $queryNotif = $conn->query($sqlInsertNotif);
                  // Record User Logs 
                    $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'$user','Added Employee to Master (Single) - $newEmpId','$ipAdd')";
                      $query2 = $conn->query($sqlInsertLogs);
                      echo 'done';
                }else{
                  echo 'error';
                }
    }else if($process == 'deact_MP'){
      $idNumber = $_GET['idNumber'];
      $category = $_GET['categ'];
      $updateDeact = "UPDATE `a_m_employee` SET `status`= '$category' WHERE `idNumber` = '$idNumber'";
      $query = $conn->query($updateDeact);
      $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Deactivated Employee - $category',(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'))";
      $queryRec = $conn->query($sqlInsertRec);
      $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'$user','Deactivated Employee of Master (Single) - $idNumber','$ipAdd')";
      $query2 = $conn->query($sqlInsertLogs);
      $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ((SELECT empHandler FROM a_m_employee WHERE idNumber = '$idNumber'),'Deleted Employee - $category',(SELECT empName FROM a_m_employee WHERE idNumber = '$idNumber'),(SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'new')";
      $queryNotif = $conn->query($sqlInsertNotif);
      echo 'done';
    }else if($process == 'update_MP'){
      $userID = $_GET['userID'];
      $empData = json_decode($_GET['empData']);
      $type = $empData->type;
      $info = 'Updated Info: ';
      $oldId = $empData->oldID;
        // Get Old Values
          $sqlGetRec = "SELECT * FROM `a_m_employee`WHERE idNumber = '$oldId'";
          $query = $conn->query($sqlGetRec);
          $prevData = $query->fetch_assoc();
            $oldIdNum = $prevData['idNumber'];
            $oldName = $prevData['empName'];
            $oldHired = $prevData['dateHired'];
            $oldBatch = $prevData['batchNo'];
            $oldNN = $prevData['empNickname'];
            $oldContact = $prevData['empContact'];
            $oldPosition = $prevData['empPosition'];
            $oldCost = $prevData['empCostCenter'];
            $oldAgency = $prevData['empAgency'];
            $oldArea = $prevData['empArea'];
            $oldRoute = $prevData['empRoute'];
            $oldShift = $prevData['empShift'];
            $oldShiftTime = $prevData['empShiftTime'];
         // If Admin
            if($type == 'admin'){
              // Compare Values
                // ID Number
                  $id = $empData->idNumber;
                  $idNumber = str_replace(" ","",$id);
                  if($idNumber != $oldIdNum){
                    $info = $info.'<br> ID Number from '.$oldIdNum.' to '.$idNumber.'.';
                  }
                // Name
                  $eName = $empData->empName;
                  $empName1 = mb_strtolower($eName);
                      $empName = ucwords($empName1);
                  if($empName != $oldName){
                    $info = $info.'<br> Name to '.$empName;
                  }
                // Date Hired
                  $dateHired = $empData->dateHired;
                  if($dateHired != $oldHired){
                    $info = $info.'<br> Date hired to '.$dateHired;
                  }
                // Batch No
                  $batchNo = $empData->batchNo;
                  if($batchNo != $oldBatch){
                    $info = $info.'<br> Batch Number to '.$batchNo;
                  }
                // Nick name
                  $nName = $empData->nickName;
                  $nickName1 = mb_strtolower($nName);
                    $nickName = ucwords($nickName1);
                  if($nickName != $oldNN){
                    $info = $info.'<br> Nick Name to '.$nickName;
                  }
                // Contact No
                  $contactNo = $empData->contactNo;
                  if($contactNo != $oldContact){
                    $info = $info.'<br> Contact Number to '.$contactNo;
                  }
                // Position
                  $empPosition = $empData->empPosition;
                  if($empPosition != $oldPosition){
                    $info = $info.'<br> Promoted to '.$empPosition;
                  }
                // Cost Center
                  $empCost = $empData->empCost;
                  if($empCost != $oldCost){
                    $info = $info.'<br>  Updated Cost Center';
                  }
                // Agency
                  $empAgency = $empData->empAgency;
                  if($empAgency != $oldAgency){
                    $info = $info.'<br>  Directed to '.$empAgency;
                  }
                // Area
                  $empArea = $empData->empArea;
                  if($empArea != $oldArea){
                    $info = $info.'<br> Moved to Area '.$empArea.'.';
                  }
                // Route
                  $empRoute = $empData->empRoute;
                  if($empRoute != $oldArea){
                    $info = $info.'<br> Change route to '.$empRoute.'.';
                  }
                // Shift
                  $empShift = $empData->empShift;
                  if($empShift != $oldShift){
                    $info = $info.'<br> Change shift to '.$empShift.'.';
                  }
                // Shift Sched
                  $empShiftTime = $empData->empShiftTime;
                  if($empShiftTime != $oldShiftTime){
                    $info = $info.'<br> Change schedule to '.$empShiftTime.'.';
                  }
              // Update Change Values
                  $sqlUpdate = "UPDATE `a_m_employee` SET `idNumber`='$idNumber',`empName`='$empName',`dateHired`='$dateHired',`batchNo`='$batchNo',`empNickname`='$nickName',`empContact`='$contactNo',`empPosition`='$empPosition',`empCostCenter`='$empCost',`empAgency`='$empAgency', `empArea`='$empArea',`empRoute`='$empRoute',`empShift`='$empShift',`empShiftTime`='$empShiftTime' WHERE `idNumber`='$oldId'";
                  $mp = $idNumber;
            }else if($type == 'clerk'){
              //  Compare Values
                // Nick name
                  $nickName = $empData->nickName;
                  if($nickName != $oldNN){
                    $info = $info.'<br> Nick Name to '.$nickName;
                  }
                // Contact No
                  $contactNo = $empData->contactNo;
                  if($contactNo != $oldContact){
                    $info = $info.'<br> Contact Number to '.$contactNo;
                  }
                // Area
                  $empArea = $empData->empArea;
                  if($empArea != $oldArea){
                    $info = $info.'<br> Moved to Area '.$empArea.'.';
                  }
                // Route
                  $empRoute = $empData->empRoute;
                  if($empRoute != $oldArea){
                    $info = $info.'<br> Change route to '.$empRoute.'.';
                  }
                // Shift Sched
                  $empShiftTime = $empData->empShiftTime;
                  if($empShiftTime != $oldShiftTime){
                    $info = $info.'<br> Change schedule to '.$empShiftTime.'.';
                  }

                $sqlUpdate = "UPDATE `a_m_employee` SET `empNickname`='$nickName',`empContact`='$contactNo',`empArea`='$empArea',`empRoute`='$empRoute',`empShiftTime`='$empShiftTime' WHERE `idNumber` = '$oldId'";
                $mp = $oldId;
                $empName = $empData->empName;
                $empPosition = $empData->empPosition;
                $empShift = $empData->empShift;
                
            }
            // Update Master
              $queryUpdateMstr = $conn->query($sqlUpdate);
                if($queryUpdateMstr){
                  // Insert History
                    $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$mp',(SELECT CURRENT_TIMESTAMP()),'$info','$userID')";
                    $queryRec = $conn->query($sqlInsertRec);
                  // Insert Logs
                    $sqlRecordLog = "INSERT INTO `sas_logs`(`activityDate`, `userID`,`userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),'$userID','$user','Updated Details of $mp','$ipAdd')";
                      $queryLog = $conn->query($sqlRecordLog);
                    // Update MP User Account
                    $sqlUpdateUserAcc = "UPDATE `sas_m_accounts` SET `idNumber`='$mp',`empName`='$empName',`empPosition`= '$empPosition',`empShift`='$empShift' WHERE `idNumber`='$oldId'";
                    $query = $conn->query($sqlUpdateUserAcc);
                    echo 'success';
                  }else{
                    echo 'error';
                  }
    }else if($process == 'return_MP'){
      $idNumber = $_GET['idNumber'];
      $date = $_GET['date'];
      $remarks = $_GET['remarks'];
      $userName = $_GET['userName'];
      $empHandler = $_GET['handler'];
      $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Return Employee to Master on $date <br>Remarks: $remarks',(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$userName'))";
      $query1 = $conn->query($sqlInsertRec);
      $sqlDelete = "DELETE FROM `a_m_employee` WHERE `idNumber` = '$idNumber' AND `status` != 'Active'";
      $query2 = $conn->query($sqlDelete);
      $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),$user,'$userName','Reactivated Employee - $idNumber','$ipAdd')";
      $query3 = $conn->query($sqlInsertLogs);
      echo 'done';
    }
   }