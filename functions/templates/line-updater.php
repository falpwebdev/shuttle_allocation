<?php
  include '../../db/config.php';
  require '../../plugins/phpspreadsheet/vendor/autoload.php';
  $targetFile = 'Line Transfer.xlsx';
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
    $startRow++;
  }
  $startRow = 2;
  // POSITION
  $sqlPosition = "SELECT * FROM `a_m_line`";
  $query = $conn->query($sqlPosition);
  while ($datPos = $query->fetch_assoc()) {
    $lineNo = $datPos['lineNo'];
    $deptCode = $datPos['deptCode'];
    $section = $datPos['section'];
    $subSect = $datPos['subSect'];
    $worksheet->getCell('A'.$startRow)->setValue($lineNo);
    $worksheet->getCell('B'.$startRow)->setValue($deptCode);
    $worksheet->getCell('C'.$startRow)->setValue($section);
    $worksheet->getCell('D'.$startRow)->setValue($subSect);
    $startRow++;
  }
  $writer->save($targetFile);

  header('Location: Line Transfer.xlsx');
?>