<?php
  include '../../db/config.php';
  require '../../plugins/phpspreadsheet/vendor/autoload.php';
  $targetFile = 'Upload New Employee.xlsx';
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFile);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
  // $reader->setLoadSheetsOnly('Reference');
  $spreadsheet = $reader->load($targetFile);
  $worksheet = $spreadsheet->getSheetByName('Reference');
  $startRow = 2;
  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
  // Delete Prev Data in Excel
  $highestRow = $worksheet->getHighestRow();
  for ($i=0; $i < $highestRow; $i++) {
    $worksheet->getCell('A'.$startRow)->setValue('');
    $worksheet->getCell('B'.$startRow)->setValue('');
    $worksheet->getCell('C'.$startRow)->setValue('');
    $worksheet->getCell('D'.$startRow)->setValue('');
    $worksheet->getCell('E'.$startRow)->setValue('');
    $worksheet->getCell('F'.$startRow)->setValue('');
    $worksheet->getCell('G'.$startRow)->setValue('');
    $startRow++;
  }
  $startRow = 2;
  // POSITION
  $sqlPosition = "SELECT `position` FROM `a_m_position`";
  $query = $conn->query($sqlPosition);
  while ($datPos = $query->fetch_assoc()) {
    $position = $datPos['position'];
    $worksheet->getCell('A'.$startRow)->setValue($position);
    $startRow++;
  }
  // Department
  $startRow = 2;
  $sqlDept = "SELECT `deptCode`, `deptName` FROM `a_m_department` GROUP BY deptName";
  $query = $conn->query($sqlDept);
  while ($datDept = $query->fetch_assoc()) {
    $code = $datDept['deptCode'];
    $name = $datDept['deptName'];
    $dept = $code.' ('.$name.')';
    $worksheet->getCell('B'.$startRow)->setValue($dept);
    $startRow++;
  }
  // Area
  $worksheet->getCell('C2')->setValue('A');
  $worksheet->getCell('C3')->setValue('B');
  // Route
  $startRow = 2;
  $sqlRoute = "SELECT `route` FROM `sas_m_route`";
  $query = $conn->query($sqlRoute);
  while ($datRoute = $query->fetch_assoc()) {
    $route = $datRoute['route'];
    $worksheet->getCell('D'.$startRow)->setValue($route);
    $startRow++;
  }
  // Shift
  $worksheet->getCell('E2')->setValue('DS');
  $worksheet->getCell('E3')->setValue('ADS');
  $worksheet->getCell('E4')->setValue('NS');

  // Work Sched
  $startRow = 2;
  $sql = "SELECT `schedTime` FROM `a_m_sched`";
  $query = $conn->query($sql);
    while ($datRoute = $query->fetch_assoc()) {
        $schedTime = $datRoute['schedTime'];
        $worksheet->getCell('F'.$startRow)->setValue($schedTime);
        $startRow++;
    }
    
  //  Job Type 
  $worksheet->getCell('G2')->setValue('Temporary');
  $worksheet->getCell('G3')->setValue('Permanent');

  $writer->save($targetFile);

  header('Location: Upload New Employee.xlsx');
?>