<?php
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
          $oldSubSect = $prevData['empSubSect'];
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
                    $keyofDept = array_search($oldSubSect,array_column($subCodesList,'subSection'));
                    $code = $subCodesList[$keyofDept]["code"];
                    $key = array_search($empPosition,array_column($positionList,'position'));
                    $rank = $positionList[$key]["rank"];
                    $empCost = $code.'.'.$rank.'_'.$deptSubSection;
                    $info = $info.'<br>  Updated Cost Center';
                  }else{
                    $empCost = $oldCost;
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
?>