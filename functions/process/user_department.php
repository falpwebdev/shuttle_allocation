<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  // Common Variables
    $dateToday = date('Y-m-d h:i:s');
    $ipAdd = $_SERVER['REMOTE_ADDR'];
  if(isset($_GET['process'])){
    $process = $_GET['process'];
    $user = $_GET['user'];
    if($process == 'changeShiftEmp'){
      $idNumber = $_GET['empID'];
      // Select Current Shift
        $sqlShift = "SELECT IF(empShift = 'NS','DS','NS') AS shift FROM `a_m_employee` WHERE `idNumber` = '$idNumber'";
        $query = $conn->query($sqlShift);
        $data = $query->fetch_assoc();
        $shiftTo = $data['shift'];
      // Update Shift of Employee
        $sqlUpdate = "UPDATE `a_m_employee` SET `empShift`='$shiftTo' WHERE `idNumber` = '$idNumber'";
        $queryUpdate = $conn->query($sqlUpdate);
      // Update Shift of User
        $sqlUpdateUser = "UPDATE `sas_m_accounts` SET `empShift`= '$shiftTo' WHERE `idNumber` = '$idNumber'";
        $queryx = $conn->query($sqlUpdateUser);
      // Record Employee Record
        if($queryUpdate){
            $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Change Shift: $shiftTo','$user')";
            $queryRec = $conn->query($sqlInsertRec);
        }
        echo 'Successfuly Change Shift '.$idNumber;
    }else if($process == 'transferEmp'){
      // Variables 
        $idNumber = $_GET['empID'];
        $empDept = $_GET['empDept'];
        $deptSect1 = $_GET['deptSect'];
          $deptSect = str_replace("@","&",$deptSect1);
        $deptSubSect1 = $_GET['deptSubSect'];
          $deptSubSect = str_replace("@","&",$deptSubSect1);
        $lineNo = $_GET['lineNo']; 
        $transDate = $_GET['transDate']; 
        $data = '';
        $empHandler = $deptSect;
      // Temporary Transfer
        if($transDate != 'permanent'){
          $sqlInsTrans = "INSERT INTO `sas_d_mp_transfer`(`idNumber`, `empName`, `dateTrans`, `dateBack`, `filedBy`, `deptCode`, `deptSect`, `deptSubSec`, `lineNo`, `status`) VALUES ('$idNumber',(SELECT `empName` FROM a_m_employee WHERE `idNumber` = '$idNumber'),(SELECT CURRENT_TIME()),'$transDate','$user',(SELECT `empDeptCode` FROM a_m_employee WHERE `idNumber` = '$idNumber'),(SELECT `empDeptSection` FROM a_m_employee WHERE `idNumber` = '$idNumber'),(SELECT `empSubSect` FROM a_m_employee WHERE `idNumber` = '$idNumber'),(SELECT `lineNo` FROM a_m_employee WHERE `idNumber` = '$idNumber'),'On Going');";
          $recTransDate = $conn->query($sqlInsTrans);
        }
      // Transfer MP
        // Get other details
          $sqlEmpName = "SELECT `empName`, `empHandler`,`lineNo`,`empDeptSection` FROM a_m_employee WHERE `idNumber` = '$idNumber'";
            $queryx = $conn->query($sqlEmpName);
              $nameDat = $queryx->fetch_assoc();
                $empName = $nameDat['empName'];
                $prevSect = $nameDat['empDeptSection'];
                $empLine = $nameDat['lineNo'];
                $empPrevHandler = $nameDat['empHandler'];
                // Activity Details
                  $data = $data .''.$idNumber .' - '. $empName .' from &nbsp;<i>'.$prevSect.' - '.$empLine.'&nbsp;</i> &nbsp;to &nbsp;'.$deptSect.' - '.$lineNo;
                 // Update MP
                    $sqlUpdate = "UPDATE `a_m_employee` SET `empDeptCode` = '$empDept',`empDeptSection`= '$deptSect',`empSubSect`= '$deptSubSect', `empHandler`= '$empHandler', `lineNo` = '$lineNo' WHERE idNumber = '$idNumber'";
                    $queryUpdate = $conn->query($sqlUpdate);
                    if($queryUpdate){
                      // Send notif to Clerk
                        $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','Transfer Employees','$data',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                        $queryNotif = $conn->query($sqlInsertNotif);
                      // Send notif to Line Leader
                        if($lineNo != '0'){
                          $sqlInsertNotifL = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$lineNo','Transfer Employees','$data',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                          $queryNotifL = $conn->query($sqlInsertNotifL);
                        }
                      // If User Exist
                        $sqlA = "SELECT * FROM `sas_m_accounts` WHERE idNumber = '$idNumber'";
                        $queryAC = $conn->query($sqlA);
                        $count = mysqli_num_rows($queryAC);
                        if($count == 1){
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
                      // Insert Record
                        $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Transfer to <br>$empHandler  - $lineNo <br>from<br> $empPrevHandler,$prevSect - $empLine','$user')";
                        $queryRec = $conn->query($sqlInsertRec);
                        if($queryRec){
                          echo 'Successfully transfered '.$idNumber;
                        }
                    }
    }else if($process == 'finishedTrans'){
      $transDate = $_GET['transDate'];
      $sqlUpdate = "UPDATE `sas_d_mp_transfer` SET `filingDone`='1' WHERE  `dateTrans`= (SELECT CURRENT_DATE()) AND `dateBack`='$transDate' AND `filedBy`='$user'";
      $query = $conn->query($sqlUpdate);
    }
  }
?>