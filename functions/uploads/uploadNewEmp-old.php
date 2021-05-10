<?php
  session_start();
  if(!isset($_SESSION['idNumber'])){
    header('location: index.php');
  }else{
  }
  $user = $_SESSION['empName'];
  $agency =  $_SESSION['agency'];
  ?>
<?php
  include '../../db/config.php';
  $sqlGetDepts = "SELECT deptCode FROM `a_m_department` WHERE special = 'Yes'";
  $query = $conn->query($sqlGetDepts);
    while ($dataE = $query->fetch_assoc()) {
      $specialDept[] = $dataE['deptCode'];
    }

  $sqlGetExisting = "SELECT `idNumber` FROM `a_m_employee` WHERE `status` = 'Active'";
  $query1 = $conn->query($sqlGetExisting);
    while ($dataId = $query1->fetch_assoc()) {
      $existingIds[] = $dataId['idNumber'];
    }
  $failRegister = array();
  $targetDir = "New Employees/";
  // $targetFile = "New Employees/Upload New Employee.xlsx";
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
      $reader->setLoadSheetsOnly('New Employee');
      $reader->setReadDataOnly(true);
      $spreadsheet = $reader->load($targetFile);
      $worksheet = $spreadsheet->getActiveSheet();
      $highestRow = $worksheet->getHighestRow();
      $highestRow = $highestRow - 2;
      $startRow = 3;
      $record = 1; 
      for ($i=0; $i < $highestRow; $i++) { 
        $idNumber = $worksheet->getCell('A'.$startRow)->getValue();
        if($idNumber != ''){
          $eName = $worksheet->getCell('B'.$startRow)->getValue();
          $empName1 = mb_strtolower($eName);
          $empName = ucwords($empName1," ");
          if(in_array($idNumber,$existingIds)){
            $failRegister[] = $idNumber. ' Name: '.$empName; 
          }else{
            $yearHired = $worksheet->getCell('C'.$startRow)->getValue();
            $monthHired = $worksheet->getCell('D'.$startRow)->getValue();
            $dayHired = $worksheet->getCell('E'.$startRow)->getValue();
            $dateHired = $yearHired.'-'.$monthHired.'-'.$dayHired;
            $batchNo = $worksheet->getCell('F'.$startRow)->getValue();
            $nickName = $worksheet->getCell('G'.$startRow)->getValue();
            $contactNo = $worksheet->getCell('H'.$startRow)->getValue();
            $empPosition = $worksheet->getCell('I'.$startRow)->getValue();
            $empCost = $worksheet->getCell('J'.$startRow)->getValue();
            $dept = $worksheet->getCell('K'.$startRow)->getValue();
            $deptDat = explode(' (',$dept);
            $deptCode = $deptDat[0];
              if(in_array($deptDat,$specialDept)){
                $empHandler = $user;
              }else{
                $empHandler = 'Recruitment and Training';
              }
            $empArea = $worksheet->getCell('L'.$startRow)->getValue();
            $empRoute = $worksheet->getCell('M'.$startRow)->getValue();
            $empShift = $worksheet->getCell('N'.$startRow)->getValue();
            $empSt = $worksheet->getCell('O'.$startRow)->getValue();
            $empJobType = $worksheet->getCell('P'.$startRow)->getValue();
  
            // Ignore Special Characters
              $empNName = mysqli_real_escape_string($conn,$empName);
            // Capitalize Shift
              $empShift= strtoupper($empShift);
              $sqlInsertNewEmp = "INSERT INTO `a_m_employee`
              (`idNumber`, `empName`, `dateHired`, `batchNo`, `empNickname`, `empContact`, `empPosition`, `empCostCenter`, `empAgency`, `empDeptCode`, `empDeptSection`, `empSubSect`, `lineNo`, `empArea`, `empRoute`, `empShift`, `empShiftTime`, `empHandler`, `status`, `jobType`) VALUES 
              ('$idNumber','$empNName','$dateHired','$batchNo','$nickName','$contactNo','$empPosition','$empCost','$agency','$deptCode','N/A','N/A','0','$empArea','$empRoute', '$empShift','$empSt', '$empHandler','Active','$empJobType');";
              $query = $conn->query($sqlInsertNewEmp);
              if($query){
                $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Employee Added to Master by Bulk Upload',(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'))";
                $query1 = $conn->query($sqlInsertRec);
                $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','New Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'new')";
                $queryNotif = $conn->query($sqlInsertNotif);
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

  
?>