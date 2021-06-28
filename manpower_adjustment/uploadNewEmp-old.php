<?php
  include '../db/config.php';
  include '../functions/inc/inc.php';
  require '../plugins/phpspreadsheet/vendor/autoload.php';
  set_time_limit(0);
  // Variables 
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $ipAdd2 = str_replace(":","",$ipAdd);
    $startRow = 3;
    set_time_limit(0);
  // Upload File
    $targetDir = "new/";
    $fileName = pathinfo($_FILES["file"]["name"],PATHINFO_FILENAME);
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    // If Excel
    if ($fileType == "xls" || $fileType == "xlsx") {
      // File Naming
        $newFileName = $ipAdd2.'-'.$fileName.'-'.round(microtime(true)).'.'.$fileType;
      // File Saving
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetDir . $newFileName)){
        // Read Excel File
          $file = $targetDir . $newFileName;
          $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
          $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
          $reader->setLoadSheetsOnly('New Employee');
          $reader->setReadDataOnly(true);
          $spreadsheet = $reader->load($file);
          $worksheet = $spreadsheet->getActiveSheet();
          $highestRow = $worksheet->getHighestRow();
          $highestRow = $highestRow - 2;
        // Fetching Data on Excel
          for ($i=0; $i < $highestRow; $i++){
            // ID
              $id = $worksheet->getCell('A'.$startRow)->getValue();
              $idNumber = str_replace(" ","",$id);
              if($idNumber != ''){
              // Fetch Data on Excel
                  // NAME
                  $eName = $worksheet->getCell('B'.$startRow)->getValue();
                  $empName1 = mb_strtolower($eName);
                    $empName2 = ucwords($empName1," ");
                // DATE HIRED
                  $yearHired = $worksheet->getCell('C'.$startRow)->getValue();
                  $monthHired = $worksheet->getCell('D'.$startRow)->getValue();
                  if(is_string($monthHired) && !is_numeric($monthHired)){
                    $dateObj = DateTime::createFromFormat('!F', $monthHired);
                    $monthHired = $dateObj->format('m'); 
                  }
                  $dayHired = $worksheet->getCell('E'.$startRow)->getValue();
                  $dateHired = $yearHired.'-'.$monthHired.'-'.$dayHired;
                // BATCH NO 
                  $batchNo = $worksheet->getCell('F'.$startRow)->getValue();
                // NICKNAME
                  $nName = $worksheet->getCell('G'.$startRow)->getValue();
                  $nickName1 = mb_strtolower($nName);
                    $nickName2 = ucwords($nickName1," ");
                // CONTACT NO
                  $contactNo = $worksheet->getCell('H'.$startRow)->getValue();
                // POSITION
                  $empPos = $worksheet->getCell('I'.$startRow)->getValue();
                  $empPos1 = mb_strtolower($empPos);
                    $empPosition = ucwords($empPos1," ");
                // AGENCY
                  $eAgency = $worksheet->getCell('J'.$startRow)->getValue();
                  $empAgency = strtoupper($eAgency);

                // DEPARTMENT
                  $dept = $worksheet->getCell('K'.$startRow)->getValue();
                  $deptDat = explode(' (',$dept);
                  $deptCode = $deptDat[0];
                // SECTION
                  $sect = $worksheet->getCell('L'.$startRow)->getValue();
                // SUB-SECTION
                  $subSect = $worksheet->getCell('M'.$startRow)->getValue();
                // LINE NO 
                  $lineNo = $worksheet->getCell('N'.$startRow)->getValue();
                      if (!in_array($lineNo,$lineList)){
                        $lineNo = '0';
                      }
                // AREA
                  $eArea = $worksheet->getCell('O'.$startRow)->getValue();
                  if($eArea == 'A' || $eArea == 'B' || $eArea == 'a' || $eArea == 'b'){
                    $empArea = mb_strtoupper($eArea);
                  }else{
                    $empArea = "A";
                  }
                // ROUTE
                  $eRoute = $worksheet->getCell('P'.$startRow)->getValue();
                  $empRoute = mb_strtoupper($eRoute);
                    if (!in_array($empRoute,$routeList)){
                      $empRoute = 'N/A';
                    }
                // SHIFT
                  $eShift = $worksheet->getCell('Q'.$startRow)->getValue();
                  $empShift = mb_strtoupper($eShift);
                //  SHIFT TIME
                  $empTime = $worksheet->getCell('R'.$startRow)->getValue();
              // Check if MP already exist
                  $sqlCheckExist = "SELECT COUNT(idNumber) AS exist FROM `a_m_employee` WHERE idNumber = '$idNumber'";
                  $query = $conn->query($sqlCheckExist);
                  $data = $query->fetch_assoc();
                  $count = $data['exist'];
                // Ignore Special Characters
                  $empName = mysqli_real_escape_string($conn,$empName2);
                  $nickName = mysqli_real_escape_string($conn,$nickName2);
                  if(in_array($deptCode,$specialDept)){
                    $empHandler = $empAgency;
                  }else{
                    $empHandler = $sect;
                  }
                
                  if($count == '1'){
                    // Update Data in System
                      $sqlQ = "UPDATE `a_m_employee` SET `empName`='$empName',`dateHired`='$dateHired',`batchNo`='$batchNo',`empNickname`='$nickName',`empContact`= '$contactNo',`empPosition`='$empPosition',`empAgency`='$empAgency',`empDeptCode`='$deptCode',`empDeptSection`='$sect',`empSubSect`='$subSect',`lineNo`='$lineNo',`empArea`='$empArea',`empRoute`='$empRoute',`empShift`='$empShift',`empShiftTime`='$empTime',`empHandler`='$empHandler',`status`='Active',`jobType`='Permanent' WHERE `idNumber` = '$idNumber'";
                  }else{
                    //  Insert new employee
                      $sqlQ = "INSERT INTO `a_m_employee`(`idNumber`, `empName`, `dateHired`, `batchNo`, `empNickname`, `empContact`, `empPosition`, `empCostCenter`, `empAgency`, `empDeptCode`, `empDeptSection`, `empSubSect`, `lineNo`, `empArea`, `empRoute`, `empShift`, `empShiftTime`, `empHandler`, `status`, `jobType`) VALUES ('$idNumber','$empName','$dateHired','$batchNo','$nickName','$contactNo','$empPosition','N/A','$empAgency','$deptCode','$empHandler','$subSect','$lineNo','$empArea','$empRoute','$empShift','$empTime','$empHandler','Active','Permanent')";
                  }
                  $action = $conn->query($sqlQ);
                  if($action){
                    // Record Emp History
                    $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Update details via Manpower Adjustment','Basic User')";
                      $query1 = $conn->query($sqlInsertRec);
                      if($query1){
                        // Send notif to Handler
                          $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','Adjusted Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'$ipAdd','new')";
                            $queryNotif = $conn->query($sqlInsertNotif);
                        //  Send notif to Line Leader
                          $sqlInsertNotifL = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$lineNo','Adjusted Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'$ipAdd','new')";
                            $queryNotifL = $conn->query($sqlInsertNotifL);
                      }
                  }
            }
            $startRow++;
          } 
      }
      // Record User Log
        $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),'Basic User','Basic User','Update details via Manpower Adjustment','$ipAdd')";
        $query2 = $conn->query($sqlInsertLogs);
        if($query2){
          echo 'All new employees successfully adjusted.';
        }
    }else{
      echo "Incorrect File Format";
    }
?>