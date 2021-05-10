<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  // Variables
  $ipAdd = $_SERVER['REMOTE_ADDR'];
  $filedDate = date('Y-m-d');
  $timeNow = date('H:i:s');
  if(isset($_GET['process'])){
    $process = $_GET['process'];
    if($process == 'record_code'){
      $data = json_decode($_GET['data']);
      // Variables
        $date = $data->date;
        $filedFor = $data->item;
        $shift = $data->shift;
        $requestor = $data->requestor;
        $code = $data->code;
        $empName = $data->name;
      // Process
        $sqlInsert = "INSERT INTO `sas_m_resub_code`(`code`, `createdDate`, `filedFor`, `dateFor`, `shift`,`requestorId`, `requestorName`, `status`) VALUES ('$code',(SELECT CURRENT_TIMESTAMP()),'$filedFor','$date','$shift','$requestor','$empName','Open')";
        $query = $conn->query($sqlInsert);
        if($query){
          echo 'done';
        }else{
          echo 'failed';
        }
    }else if($process == 'alert_code'){
      $handle = $_GET['handle'];
      $code = $_GET['code'];
      $userId = $_GET['userId'];
      $sqlNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$handle','Reminder','Your code &nbsp;<b>$code </b>&nbsp; is still waiting for modification. Kindly close this code in the modify outgoing page now.',(SELECT CURRENT_TIMESTAMP()),'$userId','new')";
      $query = $conn->query($sqlNotif);
      if($query){
        echo 'done';
      }
    }else if($process == 'delete_code'){
      $code = $_GET['code'];
      $sql = "DELETE FROM `sas_m_resub_code` WHERE code = '$code'";
      $query = $conn->query($sql);
      if($query){
        echo 'Deleted Code'.$code;
      }
    }else if($process == 'reopen_code'){
      $code = $_GET['code'];
      $sqlClosed = "UPDATE `sas_m_resub_code` SET `usedDt`= '0000-00-00 00:00:00',`userClosed`='', `status` = 'Open' WHERE `code`='$code'";
      $query = $conn->query($sqlClosed);
      echo 'success';
    }else if($process == 'close_code'){
      $code = $_GET['code'];
      $user = $_GET['user'];
      $sqlClosed = "UPDATE `sas_m_resub_code` SET `usedDt`= (SELECT CURRENT_TIMESTAMP()),`userClosed`='$user', `status` = 'Closed' WHERE `code`='$code'";
      $query = $conn->query($sqlClosed);
      echo 'success';
    }else if($process == 'refiled_data'){
      $filedDate = $_GET['filedDate'];
      $filedFor = $_GET['filedFor'];
      $shift = $_GET['shift'];
      $idUser = $_GET['userID'];
      $user = $_GET['userName'];
        // Delete All Filed
          $sqlDelO = "DELETE FROM `sas_d_outgoing` WHERE `datePresent` = '$filedDate' AND `filedFor` = '$filedFor' AND `shift` = '$shift'";
          $queryDelO = $conn->query($sqlDelO);
          $sqlDelA = "DELETE FROM `sas_d_absent` WHERE dateAbsent = '$filedDate' AND `filedFor` = '$filedFor' AND shift = '$shift'";
          $queryDelA = $conn->query($sqlDelA);
        // Outgoing MP
          $empOut = json_decode($_GET['empOutGoing']);
          if($empOut != NULL){
            foreach($empOut as $key => $o){
              $empId = $o->idNumber;
              $empRoute = $o->route;
              $empArea = $o->area;
              $empOut = $o->outGoing;
              $empShift = $o->shift;
                $getEmpNameSql = "SELECT * FROM a_m_employee WHERE idNumber = '$empId'";
                $query = $conn->query($getEmpNameSql);
                  while($empData = $query->fetch_assoc()){
                    $empName = $empData['empName'];
                    $empGrp = $empData['empDeptSection'];
                    $empDept = $empData['empDeptCode'];
                  }
                  // Insert New Outgoing
                    $sqlInsertOutGoing ="INSERT INTO `sas_d_outgoing`(`datePresent`,`filedFor`,`dtFiled`, `timeFiled`, `empName`, `idNumber`, `deptCode`, `deptGrp`, `lineNo`, `outGoing`, `route`, `empArea`, `filedBy`, `shift`) VALUES ('$filedDate','$filedFor',(SELECT CURRENT_DATE()),(SELECT CURRENT_TIME()),'$empName','$empId','$empDept','$empGrp',(SELECT lineNo FROM a_m_employee WHERE idNumber = '$empId'),'$empOut','$empRoute','$empArea', '$idUser','$shift')";
                    $queryInsert = $conn->query($sqlInsertOutGoing);
            }
          }
        // Absent MP
          $empAbsent = json_decode($_GET['empAbsent']);
          if($empAbsent != NULL){
            foreach($empAbsent as $key => $a){
              $empId = $a->idNumber;
              $empShift = $a->shift;
              $category = $a->category;
                $getEmpNameSql = "SELECT * FROM a_m_employee WHERE idNumber = '$empId'";
                $query = $conn->query($getEmpNameSql);
                while($empData = $query->fetch_assoc()){
                  $empName = $empData['empName'];
                  $empDept = $empData['empDeptCode'];
                  $empGrp = $empData['empDeptSection'];
                }
                  // Insert New Absent
                    $sqlInsertAbsent = "INSERT INTO `sas_d_absent`(`dateAbsent`,`filedFor`,`idNumber`, `empName`, `deptCode`, `deptGrp`, `lineNo`, `dtFiled`, `category`, `filedBy`, `shift`) VALUES ('$filedDate','$filedFor','$empId','$empName','$empDept','$empGrp',(SELECT lineNo FROM a_m_employee WHERE idNumber = '$empId'),(SELECT CURRENT_TIMESTAMP()),'$category','$idUser','$shift')";
                    $queryInsertAbs = $conn->query($sqlInsertAbsent);
            }
          }
        // Change Route MP Data
          $changeRouteMP = json_decode($_GET['changeRouteDat']);
          if($changeRouteMP != NULL){
            foreach($changeRouteMP as $key => $c){
              $empId = $c->idNumber;
              $empFrom = $c->from;
              $empTo = $c->to;
              $sqlInsertRouteChange = "INSERT INTO `sas_d_change_shuttle`(`idNumber`,`filedFor`,`changeDate`, `routeFrom`, `routeTo`, `filedDate`, `userChanged`, `shift`) VALUES ('$empId','$filedFor','$filedDate','$empFrom','$empTo',(SELECT CURRENT_DATE()),'$idUser','$shift')";
              $query = $conn->query($sqlInsertRouteChange);
            }
          }
        // Save Record
          // Record Filing
            $sqlRecFile = " INSERT INTO `sas_d_filing`(`filedFor`, `dateFor`, `dateFiled`, `timeFiled`, `shift`, `idUser`, `filedBy`) VALUES ('$filedFor','$filedDate',(SELECT CURRENT_DATE()),(SELECT CURRENT_TIME()),'$shift','$idUser','$user')";
            $queryRecF = $conn->query($sqlRecFile);
          // Record User Activity
            $sqlInsertRec = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),'$idUser','$user','Adjust Submit Shuttle Allocation Outgoing Form - $filedDate','$ipAdd')";
            $query = $conn->query($sqlInsertRec);
        echo 'success';
    }
  }
?>