<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
    // Variables
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $dateToday = date('Y-m-d');
    $timeNow = date('H:i:s');
    if(isset($_GET['process'])){
      $process = $_GET['process'];
      if($process == 'add_admin_acc'){
        $data = json_decode($_GET['data']);
        $agency = $data->agency;
        $idNumber = $data->idNumber;
        $userName = $data->userName;
        $password = $data->password;
        $shift = $data->shift;
        $sql = "INSERT INTO `sas_m_adminacc`(`idNumber`, `adName`, `shift`, `adEmployer`, `password`) VALUES ('$idNumber','$userName','$shift','$agency','$password')";
        $query = $conn->query($sql);
        if($query){
          echo 'success';
        }else{
          echo 'false';
        } 
      }else if($process == 'update_admin_pw'){
        $idNumber = $_GET['acc'];
        $newPW = $_GET['newPW'];
        $sql = "UPDATE `sas_m_adminacc` SET `password`= '$newPW' WHERE `idNumber` = '$idNumber'";
        $query = $conn->query($sql);
        if($query){
          echo 'success';
        }else{
          echo 'failed';
        }
      }else if($process == 'deact_admin_user'){
        $idNumber = $_GET['acc'];
        $sql = "UPDATE `sas_m_adminacc` SET `password`= 'Deactivated' WHERE `idNumber` = '$idNumber'";
        $query = $conn->query($sql);
        if($query){
          echo 'success';
        }else{
          echo 'failed';
        }
      }else if($process == 'add_agency'){
        $code = $_GET['code'];
        $name = $_GET['name'];
        $sqlInsert = "INSERT INTO `a_m_agency`(`agencyCode`, `agencyName`) VALUES ('$code','$name')";
        $query = $conn->query($sqlInsert);
        if($query){
          echo 'Successfully Added Agency';
        }else{
          echo 'Error in Adding Agency. Please check if already exist in master.';
        }
      }else if($process == 'edit_agency'){
        $prev = $_GET['prev'];
        $code = $_GET['code'];
        $name = $_GET['name'];
        $sqlUpdate = "UPDATE `a_m_agency` SET `agencyCode`='$code',`agencyName`='$name' WHERE `agencyCode`='$prev'";
        $query = $conn->query($sqlUpdate);
        if($prev != $code){
          $sqlUpdateMstr = "UPDATE `a_m_employee` SET `empAgency`='$code' WHERE `empAgency`='$prev'";
          $query1 = $conn->query($sqlUpdateMstr);
        }
        if($query){
          echo 'Successfully Updated Agency: '.$prev;
        }else{
          echo 'Error in Updating Agency. Please try again later.';
        }
      }else if($process == 'delete_agency'){
        $item = $_GET['item'];
        $sqlDelete = "DELETE FROM `a_m_agency` WHERE `agencyCode` = '$item'";
        $query = $conn->query($sqlDelete);
        if($query){
          echo 'Successfully Deleted Agency: '.$item;
          $sqlUpdate = "UPDATE `a_m_employee` SET `status` = 'Cancel' WHERE `agencyCode`= '$item'";
          $query = $conn->query($sqlUpdate);
        }else{
          echo 'Error in Updating Out Time. Please try again later.';
        }
      }else if($process == 'add_position'){
        $position = $_GET['position'];
        $special = $_GET['special'];
        $sqlInsert = "INSERT INTO `a_m_position`(`position`, `special`) VALUES ('$position','$special')";
        $query = $conn->query($sqlInsert);
        if($query){
          echo 'Successfully Added Position';
        }else{
          echo 'Error in Adding Position. Please check if already exist in master.';
        }
      }else if($process == 'edit_position'){
        $prev = $_GET['prev'];
        $position = $_GET['position'];
        $special = $_GET['special'];
        $sqlUpdate = "UPDATE `a_m_position` SET `position`='$position',`special`='$special' WHERE `position`='$prev'";
        $query = $conn->query($sqlUpdate);
        if($prev != $position){
          $sqlUpdateMstr = "UPDATE `a_m_employee` SET `empPosition`='$position' WHERE `empPosition`='$prev'";
          $query1 = $conn->query($sqlUpdateMstr);
        }
        if($query1){
            $sqlUpdateUser = "UPDATE `sas_m_accounts` SET `empPosition`='$position' WHERE `empPosition`='$prev'";
            $query2 = $conn->query($sqlUpdateUser);
            echo 'Successfully Updated Position: '.$prev;
        }else{
          echo 'Error in Updating Position. Please try again later.';
        }
      }else if($process == 'delete_position'){
        $item = $_GET['item'];
        $sqlDelete = "DELETE FROM `a_m_position` WHERE `position` = '$item'";
        $query = $conn->query($sqlDelete);
        if($query){
          echo 'Successfully Deleted Position: '.$item;
        }else{
          echo 'Error in Updating Position. Please try again later.';
        }
      }else if($process == 'add_department'){
        $deptCode1 = $_GET['deptCode'];
        $deptCode = str_replace("@","&",$deptCode1);
          $deptName1 = $_GET['deptName'];
        $deptName = str_replace("@","&",$deptName1);
          $deptSect1 = $_GET['deptSect'];
        $deptSect = str_replace("@","&",$deptSect1);
          $subSect1 = $_GET['subSect'];
        $subSect = str_replace("@","&",$subSect1);
        $type1 = $_GET['type'];
        $type = str_replace("@","&",$type1);
        $sqlGetCount = "SELECT COUNT(`listID`) AS count1 FROM `a_m_department` WHERE deptCode = '$deptCode' AND  `deptName` = '$deptName' AND  `deptSection` = '$deptSect' AND  `deptSubSection` = '$subSect' AND `special` = '$type'";
        $query = $conn->query($sqlGetCount);
        $data = $query->fetch_assoc();
        $count = $data['count1'];
        if($count == 0){
          $sqlInsert = "INSERT INTO `a_m_department`( `deptCode`, `deptName`, `deptSection`, `deptSubSection`, `special`) VALUES ('$deptCode','$deptName','$deptSect','$subSect','$type')";
          $query = $conn->query($sqlInsert);
          if($query){
            echo 'Successfully Added Department';
          }
        }else{
          echo 'Error in adding department. Kindly check if data already exist in master.';
        }
      }else if($process == 'update_dept_item'){
          $itemNo = $_GET['itemNo'];
          $deptCode1 = $_GET['deptCode'];
          $deptCode = str_replace("@","&",$deptCode1);
          // $deptName = $_GET['deptName'];
          $sqlDeptName = "SELECT DISTINCT(deptName) AS deptName FROM a_m_department WHERE deptCode ='$deptCode'";
          $queryx = $conn->query($sqlDeptName);
          $data = $queryx->fetch_assoc();
          $deptName = $data['deptName'];
          $deptSection1 = $_GET['deptSection'];
          $deptSection = str_replace("@","&",$deptSection1);
          $subSect1 = $_GET['subSect'];
          $subSect = str_replace("@","&",$subSect1);
    
          $deptType = $_GET['deptType'];
          // Check if Existing 
          $sqlCheck = "SELECT COUNT(listID) AS count1 FROM `a_m_department` WHERE  `deptCode`='$deptCode' AND `deptName`='$deptName' AND `deptSection`='$deptSection' AND `deptSubSection`='$subSect' AND `special`='$deptType'";
          $query = $conn->query($sqlCheck);
          $data = $query->fetch_assoc();
          $count = $data['count1'];
          if($count == 0){
            $sqlSelectOldDat = "SELECT * FROM `a_m_department` WHERE `listID` = '$itemNo'";
            $queryOld = $conn->query($sqlSelectOldDat);
            while ($oldData = $queryOld->fetch_assoc()) {
              $oDeptCode = $oldData['deptCode'];
              $oDeptName = $oldData['deptName'];
              $oDeptSection = $oldData['deptSection'];
              $oDeptSubSection = $oldData['deptSubSection'];
            }
            $sqlUpdateMstr = "UPDATE `a_m_department` SET `deptCode`='$deptCode',`deptName`='$deptName',`deptSection`='$deptSection',`deptSubSection`='$subSect',`special`='$deptType' WHERE `listID`='$itemNo'";
            $query = $conn->query($sqlUpdateMstr);
            if($query){
              // Update Affected Line 
              $sqlUpdateLineMstr = "UPDATE `a_m_line` SET `deptCode`='$deptCode',`section`='$deptSection',`subSect`='$subSect' WHERE `deptCode` = '$oDeptCode' AND `section`='$oDeptSection' AND `subSect`='$oDeptSubSection'";
              $query2 = $conn->query($sqlUpdateLineMstr);
    
              // Update Affected MP
              $sqlUpdateEmp = "UPDATE `a_m_employee` SET `empDeptCode`='$deptCode',`empDeptSection`='$deptSection',`empSubSect`='$subSect',`empHandler`='$deptSection' WHERE  `empDeptCode`='$oDeptCode' AND`empDeptSection`='$oDeptSection' AND`empSubSect`='$oDeptSubSection'";
              $query1 = $conn->query($sqlUpdateEmp);
              if($query1){
                // Update Affected User
               $sqlUpdateUser = "UPDATE `sas_m_accounts` SET `empDeptCode`='$deptCode', `empHandleLine`='$deptSection' WHERE `empDeptCode`='$oDeptCode' AND `empHandleLine`='$oDeptSection'";
                $query2 = $conn->query($sqlUpdateUser);
                echo 'Department & Employee Masterlist have been updated.';
              }
            }
          }else{
            echo 'Error updating. Data already exist in Master.';
          }
      }else if($process == 'add_dept_item'){
        $deptCode1 = $_GET['deptCode'];
          $deptCode = str_replace("@","&",$deptCode1);
        $deptName1 = $_GET['deptName'];
          $deptName = str_replace("@","&",$deptName1);
        $section1 = $_GET['section'];
          $section = str_replace("@","&",$section1);
        $subSect1 = $_GET['subSect'];
          $subSect = str_replace("@","&",$subSect1);
        $special = $_GET['type'];
        $sqlSelect = "SELECT COUNT(listID) AS count1 FROM `a_m_department` WHERE deptCode = '$deptCode' AND deptName = '$deptName' AND deptSection = '$section' AND deptSubSection = '$subSect' AND special = '$special'";
        $query = $conn->query($sqlSelect);
        $data = $query->fetch_assoc();
        $count = $data['count1'];
          if($count == '0'){
            $sqlInsert = "INSERT INTO `a_m_department`(`deptCode`, `deptName`, `deptSection`, `deptSubSection`, `special`) VALUES ('$deptCode','$deptName','$section','$subSect','$special')";
            $query = $conn->query($sqlInsert);
            if($query){
              echo 'Successfully added item under '.$deptCode.' department';
            }
          }else{
            echo 'Error adding item under '.$deptCode.' department. Kindly check if Sub-Section already exist in Master.';
          }
      }else if($process == 'add_line'){
          $deptCode1 = $_GET['dept'];
        $deptCode = str_replace("@","&",$deptCode1);
          $deptSect1 = $_GET['sect'];
        $deptSect = str_replace("@","&",$deptSect1);
          $subSect1 = $_GET['subSect'];
        $subSect = str_replace("@","&",$subSect1);
        $carMaker = $_GET['model'];
        $process = $_GET['process1'];
        $line = $_GET['line'];
        $sqlInsert = "INSERT INTO `a_m_line`(`lineNo`, `carMaker`, `process`, `deptCode`, `section`, `subSect`) VALUES ('$line','$carMaker','$process','$deptCode','$deptSect','$subSect')";
        $query = $conn->query($sqlInsert);
        if($query){
          echo 'Successfully Added Line Number';
        }else{
          echo 'Error in adding Line Number. Check if existing in master.';
        }
      }else if($process == 'update_line_name'){
        $prev = $_GET['prev'];
        $deptCode1 = $_GET['dept'];
        $sect = $_GET['sect'];
        $subSect = $_GET['subSect'];
        $model = $_GET['model'];
        $process1 = $_GET['process1'];
        $line = $_GET['line'];
        $deptCode = str_replace("@","&",$deptCode1);
        $deptSect = str_replace("@","&",$sect);
        $deptSubSect = str_replace("@","&",$subSect);
  
        // Update Masterlist 
        $sql = "UPDATE `a_m_line` SET `lineNo`='$line',`carMaker`='$model',`process`='$process1',`deptCode`='$deptCode',`section`='$deptSect',`subSect`='$deptSubSect' WHERE `lineNo`='$prev'";
        $query = $conn->query($sql);
        if($query){
          // Update Employee Master
            $sqlUpdateEmp = "UPDATE `a_m_employee` SET `empDeptCode`='$deptCode',`empDeptSection`='$deptSect',`empSubSect`='$deptSubSect',`lineNo`='$line',`empHandler`='$deptSect' WHERE `lineNo`='$prev'";
            $query1 = $conn->query($sqlUpdateEmp);
          // Update Account Master 
          $sqlUpdateAcc = "UPDATE `sas_m_accounts` SET `empDeptCode`='$deptCode', `empHandleLine`='$line' WHERE `empHandleLine`='$prev'";
          $query2 = $conn->query($sqlUpdateAcc);
          echo 'Successfuly update Line, Employee and Account Master.';
        }else{
          echo 'Line Update Failed. Kindly check if line already exist in Master List';
        }
  
      }else if($process == 'delete_line'){
        $lineNo = $_GET['line'];
        $sqlDelete = "DELETE FROM `a_m_line` WHERE `lineNo` = '$lineNo'";
        $query = $conn->query($sqlDelete);
        if($query){
          echo 'Line Item already deleted. Kindly adjust Employee & Accounts master.';
        }
      }else if($process == 'add_outgoing'){
        $hr = $_GET['hr'];
        $min = $_GET['min'];
        $outGoing = $hr.':'.$min;
        
        $sqlOutGoing = "INSERT INTO `a_m_outgoing`(`outGoing`) VALUES ('$outGoing')";
        $query = $conn->query($sqlOutGoing);
        if($query){
          echo 'Successfully Added Out Time';
        }else{
          echo 'Error in Adding Out Time. Please check if already exist in master.';
        }
      }else if($process == 'update_outgoing'){
        $hr = $_GET['hr'];
        $min = $_GET['min'];
        $prev = $_GET['prev'];
        $outGoing = $hr.':'.$min;
        $sqlUpdate = "UPDATE `a_m_outgoing` SET `outGoing`='$outGoing' WHERE `outGoing`='$prev'";
        $query = $conn->query($sqlUpdate);
        $sqlUpdateOut = "UPDATE `sas_d_outgoing` SET `outGoing`='$outGoing' WHERE `outGoing`='$prev'";
        $query1 = $conn->query($sqlUpdateOut);
        if($query1){
          echo 'Successfully Updated Out Time: '.$prev;
        }else{
          echo 'Error in Updating Out Time. Please try again later.';
        }
      }else if($process == 'delete_outgoing'){
        $item = $_GET['item'];
        $sqlDelete = "DELETE FROM `a_m_outgoing` WHERE `outGoing` = '$item'";
        $query = $conn->query($sqlDelete);
        if($query){
          echo 'Successfully Deleted Out Time: '.$item;
        }else{
          echo 'Error in Updating Out Time. Please try again later.';
        }
      }else if($process == 'add_schedule'){
        $newS = $_GET['newS'];
        $sqlInsert = "INSERT INTO `a_m_sched`(`schedTime`) VALUES ('$newS')";
        $query = $conn->query($sqlInsert);
        if($query){
          echo 'Successfully Added Out Time';
        }else{
          echo 'Error in Adding Out Time. Please check if already exist in master.';
        }
      }else if($process == 'update_schedule'){
        $old = $_GET['prev'];
        $new = $_GET['new'];
        $sqlUpdate = "UPDATE `a_m_sched` SET `schedTime`='$new' WHERE `schedTime`='$old'";
        $query = $conn->query($sqlUpdate);
        $sqlUpdateMstr = "UPDATE `a_m_employee` SET `empShiftTime`='$new' WHERE `empShiftTime`='$old'";
        $query1 = $conn->query($sqlUpdateMstr);
        if($query1){
          echo 'Successfully Updated Out Time: '.$old;
        }else{
          echo 'Error in Updating Out Time. Please try again later.';
        }
      }else if($process == 'delete_schedule'){
        $item = $_GET['item'];
        $sqlDelete = "DELETE FROM `a_m_sched` WHERE `schedTime` = '$item'";
        $query = $conn->query($sqlDelete);
        if($query){
          echo 'Successfully Deleted Out Time: '.$item;
        }else{
          echo 'Error in Updating Out Time. Please try again later.';
        }
      }else if($process == 'update_alarm'){
        $data = json_decode($_GET['data']);
        $shift = $data->shift;
        $cutOff = $data->cutOff;
        $alarm = $data->alarm;
        $snooze = $data->snooze;

        $sql = "UPDATE `m_cutoff_time` SET `timeAlarm`='$alarm',`timeSnooze`='$snooze',`timeCutOff`='$cutOff' WHERE `shift` = '$shift'";
        $query = $conn1->query($sql);
        if($query){
          echo 'Time Successfully updated';
        }else{
          echo 'Please try again.';
        }
      }else if($process == 'add_user_acc'){
        $data = json_decode($_GET['data']);
        $idNumber = $data->idNumber;
        $userName = $data->userName;
        $dept = $data->dept;
          $handle1 = $data->handle;
        $handle = str_replace("@","&",$handle1);
        $password = $data->password;
        $type = $data->type;
        $userID = $data->userID;
        $sqlExist = "SELECT COUNT(idNumber) AS count FROM `sas_m_accounts` WHERE `idNumber` = '$idNumber' AND `password` = 'Deactivated'";
        $queryC = $conn->query($sqlExist);
        $qc = $queryC->fetch_assoc();
        $count = $qc['count'];
        if($count == 0){
          $sql = "INSERT INTO `sas_m_accounts`(`idNumber`, `empName`, `empDeptCode`, `empPosition`, `empShift`, `empHandleLine`, `password`, `userType`) VALUES ('$idNumber','$userName','$dept',(SELECT `empPosition` FROM a_m_employee WHERE idNumber = '$userID'),(SELECT `empShift` FROM a_m_employee WHERE idNumber = '$userID'),'$handle','$password','$type')";
        }else{
          $sql = "UPDATE `sas_m_accounts` SET `empName`='$userName',`empDeptCode`='$dept',`empShift`= (SELECT `empShift` FROM a_m_employee WHERE idNumber = '$userID'),`empHandleLine`='$handle',`password`='$password',`userType`='$type' WHERE `idNumber` = '$userID' AND `password` = 'Deactivated'";
        }
        $query = $conn->query($sql);
        if($query){
          echo 'success';
        }else{
          echo 'false';
        } 
      }else if($process == 'update_pw_acc'){
        $idNumber = $_GET['acc'];
        $newPW = $_GET['newPW'];
        $sql = "UPDATE `sas_m_accounts` SET `password`= '$newPW' WHERE `idNumber` = '$idNumber'";
        $query = $conn->query($sql);
        if($query){
          echo 'success';
        }else{
          echo 'failed';
        }
      }else if($process == 'deact_user_acc'){
        $idNumber = $_GET['acc'];
        $sql = "UPDATE `sas_m_accounts` SET `password`= 'Deactivated' WHERE `idNumber` = '$idNumber'";
        $query = $conn->query($sql);
        if($query){
          echo 'success';
        }else{
          echo 'failed';
        }
      }
  }