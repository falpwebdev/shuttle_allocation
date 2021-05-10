<?php
  include '../../../../db/config.php';
      $targetDir = "";
      $targetFile = $targetDir . basename($_FILES["file"]["name"]);
      $uploadOk = 1;
      $FileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
      $fileName = basename($_FILES['file']['name']);
      $file = $_FILES['file']['name'];
      if ($FileType == "xlsx") {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            require '../../../../plugins/phpspreadsheet/vendor/autoload.php';
              $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
              $spreadsheet = $reader->load($targetFile);
              $reader->setReadDataOnly(true);
              // $spreadsheet->getSheet(1);
              $worksheet = $spreadsheet->getActiveSheet();
                $sqlDel = "DELETE FROM sas_m_route";
                $query = $conn->query($sqlDel);
                if($query){
                  $highestRow = $worksheet->getHighestRow();
                  $highestRow = $highestRow - 1;
                  $startRow = 2;
                  for ($i=0; $i < $highestRow; $i++) {
                    $route1 = $worksheet->getCell('A'.$startRow)->getValue();
                    if($route1 != ''){
                      $pickupPoint1 = $worksheet->getCell('B'.$startRow)->getValue();
                      $shuttle1 = $worksheet->getCell('C'.$startRow)->getValue();
                      $order = $worksheet->getCell('D'.$startRow)->getValue();
                      // Route
                        $route2 = strtoupper($route1);
                        // $route3 = ucwords($route2);
                          $route = mysqli_real_escape_string($conn, $route2);
                      // Pickup
                        $pickupPoint2 = strtolower($pickupPoint1);
                        $pickupPoint3 = ucwords($pickupPoint2);
                          $pickupPoint = mysqli_real_escape_string($conn, $pickupPoint1);
                      // Shuttle Provider
                        // $shuttle2 = strtolower($shuttle1);
                        // $shuttle3 = ucwords($shuttle2);
                          $shuttle = mysqli_real_escape_string($conn, $shuttle1);

                      $sqlInsert = "INSERT INTO `sas_m_route`(`route`, `shuttle`, `pickup`, `listOrder`) VALUES ('$route','$shuttle','$pickupPoint','$order')";
                      $query = $conn->query($sqlInsert);
                      $startRow++;
                    }
                  }
                }
                echo 'Successfully Update Route Masterlist';
              }
      }else{
        echo 'Error in uploading file. Please check the file type must be saved as Excel Workbook.';

      }


