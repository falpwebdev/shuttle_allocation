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
                        // Line Number
                          $lineNo = $worksheet->getCell('B'.$startRow)->getValue();
                        // Get in Master if Exist
                          $sqlLine = "SELECT deptCode,section,subSect FROM `a_m_line` WHERE lineNo = '$lineNo'";
                          $query = $conn->query($sqlLine);
                          $count = mysqli_num_rows($query);
                          if($count == '1'){
                            while($data = $query->fetch_assoc()){
                              $deptCode = $data['deptCode'];
                              $section = $data['section'];
                              $subSect = $data['subSect'];
                            }
                            $empHandler = $section;
                            $sqlUpdate = "UPDATE `a_m_employee` SET `empDeptCode`='$deptCode',`empDeptSection`='$section',`empSubSect`='$subSect',`lineNo`='$lineNo',`empHandler`='$empHandler' WHERE `idNumber` = '$idNumber'";
                            $query = $conn->query($sqlUpdate);
                            if($query){
                              $sqlInsertRec = "INSERT INTO `a_mp_history`(`idNumber`, `activityDate`, `actDescription`, `user`) VALUES ('$idNumber',(SELECT CURRENT_TIMESTAMP()),'Employee transfer by Bulk RTS','$user')";
                              $query1 = $conn->query($sqlInsertRec);
                              // Send notif to handler
                                $sqlEmpName = "SELECT empName FROM a_m_employee WHERE idNumber = '$idNumber'";
                                $query1 = $conn->query($sqlEmpName);
                                $dataE = $query1->fetch_assoc();
                                $empName = $dataE['empName'];
                                $sqlInsertNotif = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$empHandler','Transfer Employee','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                                $queryNotif = $conn->query($sqlInsertNotif);
                                $sqlInsertNotif1 = "INSERT INTO `sas_notifs`(`handler`, `remarks`, `data`, `dateFiled`, `userFiled`, `status`) VALUES ('$lineNo','Transfer Employees  by RTS','$idNumber - $empName',(SELECT CURRENT_TIMESTAMP()),'$user','new')";
                                $queryNotif1 = $conn->query($sqlInsertNotif1);
                            }
                            if($record == 1){
                              $sqlInsertLogs = "INSERT INTO `sas_logs`(`activityDate`, `userID`, `userName`, `actDescription`, `ipAdd`) VALUES ((SELECT CURRENT_TIMESTAMP()),(SELECT idNumber FROM sas_m_adminacc WHERE adName = '$user'),'$user','Added Employee to Master (Bulk)','$ipAdd')";
                              $query2 = $conn->query($sqlInsertLogs);
                              $record++;
                            }
                          }else{
                            $failRegister[] = $idNumber. ' Line: '.$lineNo; 
                          }
                      }
                    $startRow++;
                }
                if(empty($failRegister)){
                  echo 'All new employees successfully transferred to line.';
                }else{
                  echo 'Please confirm! Line does not exist in master: ';
                  foreach ($failRegister as $key => $x) {
                    echo $x .' ';
                  }
                }
          }
      }else{
        echo "Incorrect File Format";
      }
