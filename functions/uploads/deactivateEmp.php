<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  $user = $_SESSION['empName'];
  $agency =  $_SESSION['agency'];

  include '../../db/config.php';
  require '../../plugins/phpspreadsheet/vendor/autoload.php';

  // Get Active Employees
    $sqlGetExisting = "SELECT `idNumber` FROM `a_m_employee` WHERE `status` = 'Active'";
    $query1 = $conn->query($sqlGetExisting);
      while ($dataId = $query1->fetch_assoc()) {
        $existingIds[] = $dataId['idNumber'];
      }
  //  Variables
    $failDeact = array();
    $record = 1;
    $startRow = 2;
  // Upload File
    $targetDir = "Deactivate Employees/";
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
                $reader->setLoadSheetsOnly('For Deactivate');
                $reader->setReadDataOnly(true);
                $spreadsheet = $reader->load($file);
                $worksheet = $spreadsheet->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();
                $highestRow = $highestRow - 1;

              // Fetching Data on Excel
                for ($i=0; $i < $highestRow; $i++) {
                  $id = $worksheet->getCell('A'.$startRow)->getValue();
                    $idNumber = str_replace(" ","",$id);
                  if($idNumber != ''){
                    if(in_array($idNumber,$existingIds)){
                      $category = $worksheet->getCell('B'.$startRow)->getValue();
                      if($category == 'A' || $category == 'a'){
                        $category = 'AWOL';
                      }else if($category == 'C' || $category == 'c'){
                        $category = 'Cancel';
                      }else if($category == 'R' || $category == 'r'){
                        $category = 'Resign'; 
                      }
                      else if($category == 'ML' || $category == 'ml'){
                        $category = 'ML'; 
                      }
                      // Update Employee
                        $sql = "UPDATE `a_m_employee` SET `status`= '$category' WHERE `idNumber` = '$idNumber'";
                        $query = $conn->query($sql);
                        if($query){
                          // Record Employee history
                            $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Employee Deactivated - $category',(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'))";
                            $query1 = $conn->query($sqlInsertRec);
                          if($query1){
                            // Send Notification to handler
                            $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ((SELECT empHandler FROM a_m_employee WHERE idNumber = '$idNumber'),'Deleted Employee (Bulk) - $category',(SELECT empName FROM a_m_employee WHERE idNumber = '$idNumber'),(SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'new')";
                            $queryNotif = $conn->query($sqlInsertNotif);
                            // Save to locker deactivate data table
                            $lkrDeact = "INSERT INTO `lms_deactivation` (`idNumber`,`lkrUpdateDate`) VALUES ('$idNumber','$server_date')";
                            $qry = $conn->query($lkrDeact);
                          }
                          if($record == 1){
                            // Record User Logs
                              $ipAdd = $_SERVER['REMOTE_ADDR'];
                              $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'$user','Deactivated Employees of Master (Bulk)','$ipAdd')";
                              $query2 = $conn->query($sqlInsertLogs);
                              $record++;
                          }
                        }
                    }else{
                      $failDeact[] = $idNumber; 
                    }
                  }
                  $startRow++;
                }
                // Fail Deactivations
                if(empty($failDeact)){
                  echo 'All employees successfully deactivated.';
                }else{
                  echo 'Please confirm! ID Numbers do not exist in master or already deactivated: ';
                  foreach ($failDeact as $key => $x) {
                    echo $x .' ';
                  }
                }
          }
      }else{
        echo "false";
      }