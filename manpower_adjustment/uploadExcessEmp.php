<?php
  include '../db/config.php';
  include '../functions/inc/inc.php';
  require '../plugins/phpspreadsheet/vendor/autoload.php';
  // Variables 
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $ipAdd2 = str_replace(":","",$ipAdd);
    $startRow = 2;
  // Upload File
    $targetDir = "excess/";
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
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file);
            $spreadsheet->getSheet(1);
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
                  $sqlCheckExist = "SELECT COUNT(idNumber) AS exist, lineNo FROM `a_m_employee` WHERE idNumber = '$idNumber'";
                  $query = $conn->query($sqlCheckExist);
                  $data = $query->fetch_assoc();
                  $count = $data['exist'];
                  $lineNo = $data['lineNo'];
                    if($count != 0){
                      // FROM LINE 
                        $exLine = $worksheet->getCell('B'.$startRow)->getValue();
                      // Check if still on previous line 
                        if($lineNo == $exLine){
                          $sql = "UPDATE `a_m_employee` SET `empDeptCode`='PDX',`empDeptSection`='N/A',`empSubSect`='N/A',`lineNo`='0', `empHandler`= 'PDX' WHERE idNumber = '$idNumber'";
                          $update = $conn->query($sql);
                        }
                    }
                }
                $startRow++;
            }
            // Record User Logs
              $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),'Basic User','Basic User','Update excess MP via Manpower Adjustment','$ipAdd')";
              $query2 = $conn->query($sqlInsertLogs);
              if($query2){
                echo 'All excess employees successfully transferred to Production Excess Department.';
              }
        }
      }else{
        echo "Incorrect File Format";
      }
?>