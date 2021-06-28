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
                // Check if Already exist in master
                if(!in_array($idNumber,$existingIds)){
                  // Check Agency ID, Check pattern
                  $key = array_search($agency,array_column($agencyList,'agency'));
                  $pattern = $agencyList[$key]["pattern"];
                  if(strpos($idNumber, $pattern) !== false) {
                  // NAME
                    $eName = $worksheet->getCell('B'.$startRow)->getValue();
                    $empName1 = mb_strtolower($eName);
                      $empName2 = ucwords($empName1);
                    //  GENDER
                    $eGender1 = $worksheet->getCell('C'.$startRow)->getValue();
                    $gender = mb_strtoupper($eGender1);
                    if($gender == 'F' || $gender == 'M'){
                      // DATE HIRED
                        $yearHired = $worksheet->getCell('D'.$startRow)->getValue();
                        if(is_numeric($yearHired) && $yearHired >= '2012'){
                          $monthHired = $worksheet->getCell('E'.$startRow)->getValue();
                          if(is_numeric($monthHired) && $monthHired <= '12'){
                            $dayHired = $worksheet->getCell('F'.$startRow)->getValue();
                            if(is_numeric($dayHired) && $dayHired <= '31'){
                                $dateHired = $yearHired.'-'.$monthHired.'-'.$dayHired;
                                // BATCH NO
                                  $batchNo = $worksheet->getCell('G'.$startRow)->getValue();
                                  if($batchNo != ''){
                                    // NICKNAME
                                      $nName = $worksheet->getCell('H'.$startRow)->getValue();
                                      $nickName1 = mb_strtolower($nName);
                                        $nickName2 = ucwords($nickName1," ");
                                      // CONTACT NO
                                        $contactNo = $worksheet->getCell('I'.$startRow)->getValue();
                                      //  POSITION
                                      $empPos = $worksheet->getCell('J'.$startRow)->getValue();
                                      if($empPos == 'SPE' || $empPos == 'HK Reliever'){
                                        $empPosition = $empPos;
                                      }else{
                                        $empPos1 = mb_strtolower($empPos);
                                        $empPosition = ucwords($empPos1," ");
                                      }
                                      
                                        if(in_array($empPosition,array_column($positionList,'position'))){
                                          // DEPARTMENT CODE
                                          $dept = $worksheet->getCell('K'.$startRow)->getValue();
                                          $deptDat = explode(' (',$dept);
                                            $deptCode = $deptDat[0];
                                            if(in_array($deptCode,$deptList)){
                                              if(in_array($deptCode,$specialDept)){
                                                $deptSection = 'N/A';
                                                $depSubSection = 'N/A';
                                                $empHandler = $agency;
                                                $costCenter = 'N/A';
                                              }else{
                                                $deptSection = 'Recruitment & Training';
                                                $depSubSection = 'PD Technical Training';
                                                $empHandler = 'Recruitment & Training';
                                                  $key = array_search($empPosition,array_column($positionList,'position'));
                                                  $rank = $positionList[$key]["rank"];
                                                $costCenter = '501.'.$rank.'_PD Technical Training';
                                              }
                                              // AREA
                                              $eArea = $worksheet->getCell('L'.$startRow)->getValue();
                                              $empArea = mb_strtoupper($eArea);
                                                if($empArea == 'A' || $empArea == 'B'){
                                                  // ROUTE
                                                    $eRoute = $worksheet->getCell('M'.$startRow)->getValue();
                                                    $empRoute = mb_strtoupper($eRoute);
                                                      if (in_array($empRoute,$routeList)){
                                                        // SHIFT
                                                          $eShift = $worksheet->getCell('N'.$startRow)->getValue();
                                                          $empShift = mb_strtoupper($eShift);
                                                          if(in_array($empShift,$shiftList)){
                                                            // SHIFT SCHED
                                                              $empSt = $worksheet->getCell('O'.$startRow)->getValue();
                                                              if(in_array($empSt,$schedList)){
                                                                // JOB TYPE
                                                                  $eJT = $worksheet->getCell('P'.$startRow)->getValue();
                                                                  $empJobType1 = mb_strtolower($eJT);
                                                                    $empJobType = ucwords($empJobType1," ");
                                                                  if(in_array($empJobType,$jtList)){
                                                                    // Ignore Special Characters
                                                                      $empName = mysqli_real_escape_string($conn,$empName2);
                                                                      $nickName = mysqli_real_escape_string($conn,$nickName2);
                                                                        // INSERT IN DB
                                                                          $sqlInsertNewEmp = "INSERT INTO `a_m_employee`(`idNumber`, `empName`, `gender`, `dateHired`, `batchNo`, `empNickname`, `empContact`, `empPosition`, `empCostCenter`, `empAgency`, `empDeptCode`, `empDeptSection`, `empSubSect`, `lineNo`, `empArea`, `empRoute`, `empShift`, `empShiftTime`, `empHandler`, `status`, `jobType`) VALUES ('$idNumber','$empName','$gender','$dateHired','$batchNo','$nickName','$contactNo','$empPosition','$costCenter','$agency','$deptCode','$deptSection','$depSubSection','N/A','$empArea','$empRoute','$empShift','$empSt','$empHandler','Active','$empJobType')";
                                                                          $query = $conn->query($sqlInsertNewEmp);
                                                                          // Insert Logs
                                                                          if($query){
                                                                            $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Employee Added to Master by Bulk Upload <br> ID Number: $idNumber','$user')";
                                                                            $query1 = $conn->query($sqlInsertRec);
                                                                            // Send notif to handler
                                                                            if($query1){
                                                                              $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','New Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                                                                              $queryNotif = $conn->query($sqlInsertNotif);
                                                                              if($record == 1){
                                                                                $ipAdd = $_SERVER['REMOTE_ADDR'];
                                                                                  $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'$user','Added Employee to Master (Bulk)','$ipAdd')";
                                                                                  $query2 = $conn->query($sqlInsertLogs);
                                                                                  $record++;
                                                                              }
                                                                            }
                                                                          }
                                                                  }else{
                                                                    $failRegister[] = array(
                                                                      "idNumber" => $idNumber, 
                                                                      "error" => 'Wrong input in Job Type'
                                                                    );
                                                                  }
                                                              }else{
                                                                $failRegister[] = array(
                                                                  "idNumber" => $idNumber, 
                                                                  "error" => 'Wrong input in Schedule'
                                                                );
                                                              }
                                                          }else{
                                                            $failRegister[] = array(
                                                              "idNumber" => $idNumber, 
                                                              "error" => 'Wrong input in Shift'
                                                            );
                                                          }
                                                      }else{
                                                        $failRegister[] = array(
                                                          "idNumber" => $idNumber, 
                                                          "error" => 'Wrong input in Route'
                                                        );
                                                      }
                                                }else{
                                                  $failRegister[] = array(
                                                    "idNumber" => $idNumber, 
                                                    "error" => 'Wrong input in Area'
                                                  );
                                                }
                                            }else{
                                              $failRegister[] = array(
                                                "idNumber" => $idNumber, 
                                                "error" => 'Wrong input in Department'
                                              );
                                            }
                                        }else{
                                          $failRegister[] = array(
                                            "idNumber" => $idNumber, 
                                            "error" => $empPosition
                                          );
                                        }
                                  }else{
                                    $failRegister[] = array(
                                      "idNumber" => $idNumber, 
                                      "error" => 'No Batch Number'
                                    );
                                  }
                            }else{
                              $failRegister[] = array(
                                "idNumber" => $idNumber, 
                                "error" => 'Wrong Input in Date Hired (Date)'
                              );
                            }
                          }else{
                            $failRegister[] = array(
                              "idNumber" => $idNumber, 
                              "error" => 'Wrong Input in Date Hired (Month)'
                            );
                          }
                        }else{
                          $failRegister[] = array(
                            "idNumber" => $idNumber, 
                            "error" => 'Wrong Input in Date Hired (Year)'
                          );
                        }
                    }else{
                      $failRegister[] = array(
                        "idNumber" => $idNumber, 
                        "error" => 'Wrong Input in Gender'
                      );
                    }
                  }else{
                    $failRegister[] = array(
                      "idNumber" => $idNumber, 
                      "error" => 'Invalid ID format'
                    );
                  }
                }else{
                  $failRegister[] = array(
                    "idNumber" => $idNumber, 
                    "error" => 'ID Number is already registered. Check ID Number.'
                  );
                }
              }
              $startRow++;
          }
          if(empty($failRegister)){
            echo '<tr>
              <td colspan="2">All employees successfully uploaded.</td>
            </tr>';
          }else{
            foreach ($failRegister as $key => $dat) {
              echo '<tr>
                <td>'.$dat['idNumber'].'</td>
                <td>'.$dat['error'].'</td>
              </tr>';
            }
          }
        }
    }else{
      echo "Incorrect File Format";
    }

    

?>