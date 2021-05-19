<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }
    $user = $_SESSION['empName'];
    include '../../db/config.php';
    include '../../functions/inc/inc.php';
    require '../../plugins/phpspreadsheet/vendor/autoload.php';

    // Variables
    $failRegister = array(); 
    $startRow = 2;
    $record = 1;
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $data = '';

    // Upload File
    $targetDir = "Transfer/";
    $fileName = pathinfo($_FILES["file"]["name"],PATHINFO_FILENAME);
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    // If Excel
    if ($fileType == "xls" || $fileType == "xlsx") {
       // File Naming
           $newFileName = $user.'-'.$fileName.'-'.round(microtime(true)).'.'.$fileType;
       // File Saving
         if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetDir . $newFileName)){
           // Fetch Excel Data
            // Read Excel File
              $file = $targetDir . $newFileName;
              $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
              $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
              $reader->setLoadSheetsOnly('Transfer Line');
              $reader->setReadDataOnly(true);
              $spreadsheet = $reader->load($file);
              $worksheet = $spreadsheet->getActiveSheet();
              $highestRow = $worksheet->getHighestRow();
              $highestRow = $highestRow - 1;
                // Fetching Data on Excel
                for ($i=0; $i < $highestRow; $i++) { 
                  // ID
                  $id = $worksheet->getCell('A'.$startRow)->getValue();
                  $idNumber = str_replace(" ","",$id);
                  if($idNumber != ''){
                    // Check if Already exist in master
                    if(in_array($idNumber,$existingIds)){
                      $lineNo = $worksheet->getCell('B'.$startRow)->getValue();
                      // Check if Line exist in master
                      if(in_array($lineNo,$lineList)){
                        // Transfer MP
                          // Get Employee Details
                            $sqlEmpName = "SELECT `empName`, `empHandler`,`lineNo`,`empDeptSection`,`empPosition`,`empCostCenter` FROM a_m_employee WHERE `idNumber` = '$idNumber'";
                            $queryx = $conn->query($sqlEmpName);
                            $nameDat = $queryx->fetch_assoc();
                            $empName = $nameDat['empName'];
                            $empPosition = $nameDat['empPosition'];
                            $oldCost = $nameDat['empCostCenter'];
                            $prevSect = $nameDat['empDeptSection'];
                            $empLine = $nameDat['lineNo'];
                            $empPrevHandler = $nameDat['empHandler'];
                          // Get Line Details
                            $sqlLine = "SELECT `deptCode`, `section`, `subSect` FROM `a_m_line` WHERE `lineNo`= '$lineNo'";
                            $queryy = $conn->query($sqlLine);
                            $lineDat = $queryy->fetch_assoc();
                            $newDept = $lineDat['deptCode'];
                            $newSection = $lineDat['section'];
                            $newSubSect = $lineDat['subSect'];
                          // Activity Details
                            // Notif Data
                              $data = $data .''.$idNumber .' - '. $empName .' from &nbsp;<i>'.$prevSect.' - '.$empLine.'&nbsp;</i> &nbsp;to &nbsp;'.$newSection.' / '.$newSubSect.' - '.$lineNo;
                            // Cost Center
                              $keyofDept = array_search($newSubSect,array_column($subCodesList,'subSection'));
                              $code = $subCodesList[$keyofDept]["code"];
                              $key = array_search($empPosition,array_column($positionList,'position'));
                              $rank = $positionList[$key]["rank"];
                              $costCenter = $code.'.'.$rank.'_'.$newSubSect;
                            // Update MP
                              $sqlUpdate = "UPDATE `a_m_employee` SET `empDeptCode` = '$newDept',`empDeptSection`= '$newSection',`empSubSect`= '$newSubSect', `empHandler`= '$newSection', `lineNo` = '$lineNo', `empCostCenter` = '$costCenter' WHERE idNumber = '$idNumber'";
                              $queryUpdate = $conn->query($sqlUpdate);
                              if($queryUpdate){
                                // Send notif to Clerk
                                  $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$newSection','Transfer Employees','$data',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                                  $queryNotif = $conn->query($sqlInsertNotif);
                                // Send notif to Line Leader
                                  if($lineNo != 'N/A'){
                                    $sqlInsertNotifL = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$lineNo','Transfer Employees','$data',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                                    $queryNotifL = $conn->query($sqlInsertNotifL);
                                  }
                                // Insert Record
                                  $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Transfer to <br>$newSection  - $lineNo <br>from<br> $empPrevHandler,$prevSect - $empLine','$user')";
                                  $queryRec = $conn->query($sqlInsertRec);
                              }
                      }else{
                        $failRegister[] = array(
                          "idNumber" => $idNumber, 
                          "error" => 'Line Number is not registered. Check Line Number.'
                        );
                      }
                    }else{
                      $failRegister[] = array(
                        "idNumber" => $idNumber, 
                        "error" => 'ID Number is not registered. Check ID Number.'
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
      echo 'false';
    }
