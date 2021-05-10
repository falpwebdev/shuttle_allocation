<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['process'])){
    $process = $_GET['process'];
    if($process == 'check_transfer'){
      $sqlSelCount = "SELECT COUNT(listId) AS C FROM `sas_d_mp_transfer` WHERE dateBack = (SELECT CURRENT_DATE()) AND status = 'On Going' AND `filingDone` = '1'";
        $query1 = $conn->query($sqlSelCount);
        $datC = $query1->fetch_assoc();
          echo $count = $datC['C'];
    }else if ($process == 'return_transfer') {
      $listId = $_GET['listId'];
      $sqlSelDetails = "SELECT * FROM `sas_d_mp_transfer` WHERE listId = '$listId' AND `status` = 'On Going'";
      $query = $conn->query($sqlSelDetails);
      $cc = mysqli_num_rows($query);
      if($cc != '0'){
        while($data = $query->fetch_assoc()){
          $idNumber = $data['idNumber'];
          $empName = $data['empName'];
          $empDept = $data['deptCode'];
          $deptSect = $data['deptSect'];
          $deptSubSect = $data['deptSubSec'];
          $lineNo = $data['lineNo'];
          // Return Employee
            $sqlReturn = "UPDATE `a_m_employee` SET `empDeptCode` = '$empDept',`empDeptSection`= '$deptSect',`empSubSect`= '$deptSubSect', `empHandler`= '$deptSect', `lineNo` = '$lineNo' WHERE idNumber = '$idNumber'";
            $queryRet = $conn->query($sqlReturn);
            if($queryRet){
              // Close Item
              $sqlClose = "UPDATE `sas_d_mp_transfer` SET `status`= 'Done' WHERE listId = '$listId';";
                $querycls = $conn->query($sqlClose);
                if($querycls){
                  // Insert Notif
                    // Clerk
                    $sqlInsertNotifC = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$deptSect','Auto-Transfer Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'System Generated','new')";
                    $queryNotif = $conn->query($sqlInsertNotifC);
                  // Line Leader 
                    if($lineNo != '0'){
                      $sqlInsertNotifL = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$lineNo','Auto-Transfer Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'System Generated','new')";
                      $queryNotif = $conn->query($sqlInsertNotifL);
                    }
                  // If User Exist 
                    $sqlA = "SELECT * FROM `sas_m_accounts` WHERE idNumber = '$idNumber'";
                      $queryAC = $conn->query($sqlA);
                        $countU = mysqli_num_rows($queryAC);
                          if($countU == 1){
                            $datA = $queryAC->fetch_assoc();
                            $userType = $datA['userType'];
                            if($userType == 'Line Leader'){
                              $handle = $lineNo;
                            }else{
                              $handle = $deptSect;
                            }
                            $sqlUpdateAccMstr = "UPDATE `sas_m_accounts` SET `empDeptCode`='$empDept',`empHandleLine`='$handle' WHERE `idNumber` = '$idNumber'";
                            $queryAc = $conn->query($sqlUpdateAccMstr);
                          }
                  // Record Employee History
                    $sql = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Automatically transferred by the system. Details: <br>Department: $empDept <br>Section: $deptSect <br>Sub Section: $deptSubSect <br>Line No: $lineNo','System')";
                      $queryx = $conn->query($sql);
                        if($queryx){
                          echo 'Successfully Transfered '. $idNumber;
                        }
                }
            }
        }
      }else{
        echo 'Already Transferred';
      }
    }
  }
?>