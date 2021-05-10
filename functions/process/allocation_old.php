<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  // Variables
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $dateToday = date('Y-m-d');
    $timeNow = date('H:i:s');
    // Generate Date For
    if(($timeNow >= '07:59:59' && $timeNow <= '19:59:59')){
      $dateFor = $dateToday;
    }else{
      if($timeNow >= '20:00:00' &&  $timeNow <= '23:59:59'){
        $dateFor = $dateToday;
      }else if($timeNow >= '00:00:00' && $timeNow <= '07:59:59'){
        $dateFor = date('Y-m-d', strtotime($dateToday . ' -1 day'));
      }
    }
    if(isset($_GET['process'])){
      $process = $_GET['process'];
      $user = $_GET['user'];
      if($process == 'submitAllocation'){
        $idUser = $_GET['idUser'];
        $shift = $_GET['shift'];
        $handle = $_GET['handle'];
        // Delete Existing Data
            // Delete Outgoing
              $sqlDelOFiled = "DELETE FROM `sas_d_outgoing` WHERE `filedFor` = '$handle' AND `datePresent` = '$dateFor' AND shift = '$shift'";
              $queryDelO = $conn->query($sqlDelOFiled);
            //  Delete Absent
              $sqlDeleteAFiled = "DELETE FROM `sas_d_absent` WHERE `filedFor` = '$handle' AND `dateAbsent` = '$dateFor' AND shift = '$shift'";
              $queryDelA = $conn->query($sqlDeleteAFiled);
            // Delete Change Shuttle
              $sqlDeleteCFiled = "DELETE FROM `sas_d_change_shuttle` WHERE `filedFor` = '$handle' AND changeDate = '$dateFor' AND shift = '$shift'";
              $queryDelC = $conn->query($sqlDeleteCFiled);
        // PROCESS DATA
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
                    // Select if Filed by others
                    $sqlC = "SELECT COUNT(idNumber) AS `exist` FROM `sas_d_outgoing` WHERE datePresent = '$dateFor' AND `idNumber` = '$empId' AND `shift` = '$empShift'";
                    $query = $conn->query($sqlC);
                    $dataC = $query->fetch_assoc();
                    $fileds = $dataC['exist'];
                    if($fileds == '1'){
                      // Update
                      $sqlInsertOutGoing ="UPDATE `sas_d_outgoing` SET `filedFor`= '$handle',`dtFiled`='$dateToday',`timeFiled`= (SELECT CURRENT_TIME()),`deptCode`='$empDept',`deptGrp`='$empGrp',`lineNo`=(SELECT lineNo FROM a_m_employee WHERE idNumber = '$empId'),`outGoing`='$empOut',`route`='$empRoute',`empArea`='$empArea',`filedBy`='$idUser',`shift`='$empShift' WHERE `datePresent`='$dateFor' AND `idNumber`='$empId' AND `shift` = '$empShift'";
                    }else{
                      // Insert new record
                      $sqlInsertOutGoing ="INSERT INTO `sas_d_outgoing`(`datePresent`,`filedFor`,`dtFiled`, `timeFiled`, `empName`, `idNumber`, `deptCode`, `deptGrp`, `lineNo`, `outGoing`, `route`, `empArea`, `filedBy`, `shift`) VALUES ('$dateFor','$handle','$dateToday',(SELECT CURRENT_TIME()),'$empName','$empId','$empDept','$empGrp',(SELECT lineNo FROM a_m_employee WHERE idNumber = '$empId'),'$empOut','$empRoute','$empArea', '$idUser','$empShift')";
                    }
                    
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
                // if($category == 'N'){
                //   $category = 'NW';
                // }else if($category == 'R'){
                //   $category = 'RD';
                // }
                  $getEmpNameSql = "SELECT * FROM a_m_employee WHERE idNumber = '$empId'";
                  $query = $conn->query($getEmpNameSql);
                  while($empData = $query->fetch_assoc()){
                    $empName = $empData['empName'];
                    $empDept = $empData['empDeptCode'];
                    $empGrp = $empData['empDeptSection'];
                  }
                  // Select if Filed by others
                    $sqlC = "SELECT COUNT(idNumber) as exist FROM `sas_d_absent` WHERE dateAbsent = '$dateFor' AND `idNumber` = '$empId'";
                    $query = $conn->query($sqlC);
                    $dataC = $query->fetch_assoc();
                    $fileds = $dataC['exist'];
                    if($fileds == '1'){
                      $sqlInsertAbsent = "UPDATE `sas_d_absent` SET `filedFor`='$handle',`deptCode`='$empDept',`deptGrp`='$empGrp',`lineNo`= (SELECT lineNo FROM a_m_employee WHERE idNumber = '$empId'),`dtFiled`= (SELECT CURRENT_TIMESTAMP()),`category`='$category',`filedBy`='$idUser',`shift`='$shift' WHERE `dateAbsent`= '$dateFor' AND `idNumber`='$empId'";
                    }else{
                      $sqlInsertAbsent = "INSERT INTO `sas_d_absent`(`dateAbsent`,`filedFor`,`idNumber`, `empName`, `deptCode`, `deptGrp`, `lineNo`, `dtFiled`, `category`, `filedBy`, `shift`) VALUES ('$dateFor','$handle','$empId','$empName','$empDept','$empGrp',(SELECT lineNo FROM a_m_employee WHERE idNumber = '$empId'),(SELECT CURRENT_TIMESTAMP()),'$category','$idUser','$shift')";
                    }
                    $queryInsertAbs = $conn->query($sqlInsertAbsent);
              }
            }
          // Save Record
            // Record Filing
              $sqlRecFile = " INSERT INTO `sas_d_filing`(`filedFor`, `dateFor`, `dateFiled`, `timeFiled`, `shift`, `idUser`, `filedBy`) VALUES ('$handle','$dateFor','$dateToday',(SELECT CURRENT_TIME()),'$shift','$idUser','$user')";
                $queryRecF = $conn->query($sqlRecFile);
            //  Record User Activity
              $sqlInsertRec = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),'$idUser','$user','Submit Shuttle Allocation Outgoing Form','$ipAdd')";
              $query = $conn->query($sqlInsertRec);

        echo 'success';
        
      }else if($process == 'filingRemarks'){
        $remarks = $_GET['remarks'];
        $recNo = $_GET['recNo'];

        $sqlUpdateRecord = "UPDATE `sas_d_filing` SET `reFiledBy`='$user',`remarks`='$remarks' WHERE `listId`='$recNo'";
          $query = $conn->query($sqlUpdateRecord);
          echo 'done';
      }else if($process == 'empChangeShuttle'){
        $handle = $_GET['handle'];
        $idUser = $_GET['idUser'];
        $shift = $_GET['shift'];
        // Change Route MP Data
                $changeRouteMP = json_decode($_GET['changeRouteDat']);
                if($changeRouteMP != NULL){
                  foreach($changeRouteMP as $key => $c){
                    $empId = $c->idNumber;
                    $empFrom = $c->from;
                    $empTo = $c->to;
                    $sqlInsertRouteChange = "INSERT INTO `sas_d_change_shuttle`(`idNumber`,`filedFor`,`changeDate`, `routeFrom`, `routeTo`, `filedDate`, `userChanged`, `shift`) VALUES ('$empId','$handle','$dateFor','$empFrom','$empTo','$dateToday','$idUser','$shift')";
                      $query = $conn->query($sqlInsertRouteChange);
                  }
                }
      }
    }
?>