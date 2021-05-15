<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }
    $user = $_SESSION['empName'];
    $agency = $_SESSION['agency'];
    include '../../db/config.php';
    include '../../functions/inc/inc.php';
    require '../../plugins/phpspreadsheet/vendor/autoload.php';

    // Get Exisiting ID's
      $sqlGetExisting = "SELECT `idNumber` FROM `a_m_employee` WHERE `status` = 'Active'";
      $query1 = $conn->query($sqlGetExisting);
        while ($dataId = $query1->fetch_assoc()) {
          $existingIds[] = $dataId['idNumber'];
        }
    // Variables
      $failRegister = array();
      $startRow = 3;
      $record = 1; 

    // Upload File
      $targetDir = "New Employees/";
      $fileName = pathinfo($_FILES["file"]["name"],PATHINFO_FILENAME);
      $targetFile = $targetDir . basename($_FILES["file"]["name"]);
      $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
      // If Excel
      if ($fileType == "xls" || $fileType == "xlsx") {
        // File Naming
            $newFileName = $agency.'-'.$fileName.'-'.round(microtime(true)).'.'.$fileType;
        // File Saving
          if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetDir . $newFileName)){
            // Fetch Excel Data
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
                for ($i=0; $i < $highestRow; $i++) { 
                  // ID
                  $id = $worksheet->getCell('A'.$startRow)->getValue();
                    $idNumber = str_replace(" ","",$id);
                  if($idNumber != ''){
                    // NAME
                    $eName = $worksheet->getCell('B'.$startRow)->getValue();
                    $empName1 = mb_strtolower($eName);
                      $empName2 = ucwords($empName1);
                    // Check if Already excist in master
                      if(in_array($idNumber,$existingIds)){
                        $failRegister[] = $idNumber. ' Name: '.$empName2; 
                      }else{
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
                        // COST CENTER
                          $empCost = $worksheet->getCell('J'.$startRow)->getValue();
                          if($empCost == ''){
                            $empCost = 'N/A';
                          }
                        // DEPARTMENT 
                          $dept = $worksheet->getCell('K'.$startRow)->getValue();
                          $deptDat = explode(' (',$dept);
                            $deptCode = $deptDat[0];
                            if(in_array($deptDat,$specialDept)){
                              $empHandler = $user;
                            }else{
                              $empHandler = 'Recruitment and Training';
                            }
                        // AREA
                          $eArea = $worksheet->getCell('L'.$startRow)->getValue();
                          if($eArea == 'A' || $eArea == 'B' || $eArea == 'a' || $eArea == 'b'){
                            $empArea = mb_strtoupper($eArea);
                          }else{
                            $empArea = "A";
                          }
                        // ROUTE
                          $eRoute = $worksheet->getCell('M'.$startRow)->getValue();
                          $empRoute = mb_strtoupper($eRoute);
                            if (!in_array($empRoute,$routeList)){
                              $empRoute = 'N/A';
                            }
                        // SHIFT
                          $eShift = $worksheet->getCell('N'.$startRow)->getValue();
                          $empShift = mb_strtoupper($eShift);
                        // SHIFT SCHED
                          $empSt = $worksheet->getCell('O'.$startRow)->getValue();
                        // JOB TYPE
                          $eJT = $worksheet->getCell('P'.$startRow)->getValue();
                          $empJobType1 = mb_strtolower($eJT);
                            $empJobType = ucwords($empJobType1," ");
                        
                        // Ignore Special Characters
                          $empName = mysqli_real_escape_string($conn,$empName2);
                          $nickName = mysqli_real_escape_string($conn,$nickName2);

                        // Insert Employee in Master
                          // Insert MP
                            $sqlInsertNewEmp = "INSERT INTO `a_m_employee` (`idNumber`, `empName`, `dateHired`, `batchNo`, `empNickname`, `empContact`, `empPosition`, `empCostCenter`, `empAgency`, `empDeptCode`, `empDeptSection`, `empSubSect`, `lineNo`, `empArea`, `empRoute`, `empShift`, `empShiftTime`, `empHandler`, `status`, `jobType`) VALUES ('$idNumber','$empName','$dateHired','$batchNo','$nickName','$contactNo','$empPosition','$empCost','$agency','$deptCode','N/A','N/A','0','$empArea','$empRoute', '$empShift','$empSt', '$empHandler','Active','$empJobType');";
                            $query = $conn->query($sqlInsertNewEmp);
                              if($query){
                                $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Employee Added to Master by Bulk Upload','$user')";
                                $query1 = $conn->query($sqlInsertRec);
                                // Send notif to handler
                                  if($query1){
                                    $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','New Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                                    $queryNotif = $conn->query($sqlInsertNotif);
                                  }
                                // Record User Log
                                if($record == 1){
                                  $ipAdd = $_SERVER['REMOTE_ADDR'];
                                  $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'$user','Added Employee to Master (Bulk)','$ipAdd')";
                                  $query2 = $conn->query($sqlInsertLogs);
                                  $record++;
                                }
                              }
                      }
                  }
                  $startRow++;
                }
                if(empty($failRegister)){
                  echo 'All new employees successfully inserted.';
                }else{
                  echo 'Please confirm! ID Numbers already exist in master: ';
                  foreach ($failRegister as $key => $x) {
                    echo $x .' ';
                  }
                }
          }
      }else{
        echo "Incorrect File Format";
      }
