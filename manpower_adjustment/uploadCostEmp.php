<?php
  include '../db/config.php';
  include '../functions/inc/inc.php';
  require '../plugins/phpspreadsheet/vendor/autoload.php';
// Variables 
  $ipAdd = $_SERVER['REMOTE_ADDR'];
  $ipAdd2 = str_replace(":","",$ipAdd);
  $startRow = 2;
// Upload File
  $targetDir = "cost/";
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
          $reader->setLoadSheetsOnly('Update Cost Center');
          $reader->setReadDataOnly(true);
          $spreadsheet = $reader->load($file);
          $worksheet = $spreadsheet->getActiveSheet();
          $highestRow = $worksheet->getHighestRow();
          $highestRow = $highestRow - 1;
        // Fetch Data on Excel
          for ($i=0; $i < $highestRow; $i++) { 
            // ID
              $id = $worksheet->getCell('A'.$startRow)->getValue();
              $idNumber = str_replace(" ","",$id);
            // Check if Exist in Master
              if($idNumber != ''){
                $sqlCheckExist = "SELECT COUNT(idNumber) AS exist FROM `a_m_employee` WHERE idNumber = '$idNumber'";
                $query = $conn->query($sqlCheckExist);
                $data = $query->fetch_assoc();
                $count = $data['exist'];
                if($count != 0){
                  // COST CENTER
                    $costCenter = $worksheet->getCell('B'.$startRow)->getValue();
                  // Update Employee Cost Center
                    $sql = "UPDATE `a_m_employee` SET `empCostCenter`='$costCenter' WHERE `idNumber` = '$idNumber'";
                    $query = $conn->query($sql);
                    if($query){
                      // Record Emp History
                      $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Update Cost Center via Manpower Adjustment','Basic User')";
                      $query1 = $conn->query($sqlInsertRec);
                    }
                }
              }
              $startRow++;
          }
        // Record User Logs
          $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),'Basic User','Basic User','Update Cost Center of MP via Manpower Adjustment','$ipAdd')";
          $query2 = $conn->query($sqlInsertLogs);
          if($query2){
            echo 'All employees successfully updated Cost Center.';
          }
      }
    }else{
      echo "Incorrect File Format";
    }
?>