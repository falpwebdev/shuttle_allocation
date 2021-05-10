<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  $user = $_SESSION['empName'];
  $agency =  $_SESSION['agency'];

  include '../../db/config.php';
  // Get Active Employees
    $sqlGetExisting = "SELECT `idNumber` FROM `a_m_employee` WHERE `status` = 'Active'";
    $query1 = $conn->query($sqlGetExisting);
      while ($dataId = $query1->fetch_assoc()) {
        $existingIds[] = $dataId['idNumber'];
      }
  //  Variables
    $failDeact = array();
    $record = 1;
  // Upload File
    $targetDir = "Deactivate Employees/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $fileName = basename($_FILES['file']['name']);
    $file = $_FILES['file']['name'];
  if ($FileType == "xls" || $FileType == "xlsx") {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
      require '../../plugins/phpspreadsheet/vendor/autoload.php';
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFile);
      $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
      $reader->setLoadSheetsOnly('For Deactivate');
      $reader->setReadDataOnly(true);
      $spreadsheet = $reader->load($targetFile);
      $worksheet = $spreadsheet->getActiveSheet();
      $highestRow = $worksheet->getHighestRow();
      $highestRow = $highestRow - 1;
      $startRow = 2;
      for ($i=0; $i < $highestRow; $i++) { 
          $idNumber = $worksheet->getCell('A'.$startRow)->getValue();
        if($idNumber != ''){
          if(in_array($idNumber,$existingIds)){
            $category = $worksheet->getCell('B'.$startRow)->getValue();
            if($category == 'A' || $category == 'a'){
              $category = 'AWOL';
            }elseif($category == 'C' || $category == 'c'){
              $category = 'Cancel';
            }elseif($category == 'R' || $category == 'r'){
              $category = 'Resign'; 
            }
            elseif($category == 'ML' || $category == 'ml'){
              $category = 'ML'; 
            }
            $sql = "UPDATE `a_m_employee` SET `status`= '$category' WHERE `idNumber` = '$idNumber'";
            $query = $conn->query($sql);
            if($query){
              $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Employee Deactivated - $category',(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'))";
              $query1 = $conn->query($sqlInsertRec);

              $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ((SELECT empHandler FROM a_m_employee WHERE idNumber = '$idNumber'),'Deleted Employee (Bulk) - $category',(SELECT empName FROM a_m_employee WHERE idNumber = '$idNumber'),(SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'new')";
              $queryNotif = $conn->query($sqlInsertNotif);
        
              if($record == 1){
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
