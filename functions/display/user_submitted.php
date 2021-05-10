<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'fileds'){
      // Get Filing Items
      echo '<option selected value="0">Select Filed For</option>';
      $sqlGetFiled = "SELECT DISTINCT(filedFor) as filedItem FROM `sas_d_outgoing`";
      $queryGet = $conn->query($sqlGetFiled);
        while ($filedData = $queryGet->fetch_assoc()) {
          $filedItem = $filedData['filedItem'];
          echo '<option value="'.$filedItem.'">'.$filedItem.'</option>';
        }
    }else if($rqst == 'filedFor'){
      $filed = $_GET['filed'];
      // Get Dates submitted for Filed By
      echo '<option selected value="0">Select Filed Date & Shift</option>';
      $sqlGetFiled = "SELECT CONCAT(datePresent,' (',shift,')') as filedDates,datePresent,shift FROM `sas_d_outgoing` WHERE filedFor = '$filed' GROUP BY datePresent,shift";
      $queryGet = $conn->query($sqlGetFiled);
      while ($filedData = $queryGet->fetch_assoc()) {
        $filedDates = $filedData['filedDates'];
        $request = $filedData['datePresent'] .'@'. $filedData['shift'] .'@'. $filed;
        echo '<option value="'.$request.'">'.$filedDates.'</option>';
      } 
    }else if($rqst == 'filingDetails'){
      $filed = $_GET['filed'];
      $type = $_GET['type'];
      $datax = explode("@",$filed);
      $filedDate = $datax[0];
      $filedShift = $datax[1];
      $filedFor = $datax[2];
      if($type == 'details'){
        echo $filedFor .' ('. $filedDate .' '.$filedShift.')';
      }else if($type == 'outGoing'){
        echo '<table class="mt-2 table text-center table-sm table-bordered table-hover" border="1" id="tblOutGoing">
          <thead>
            <tr>
            <th colspan="8">OUTGOING</th>
            </tr>
            <tr>
              <th>ID Number</th>
              <th>Name</th>
              <th>Department</th>
              <th>Section</th>
              <th>Line</th>
              <th>Area</th>
              <th>Outgoing</th>
              <th>Route</th>
            </tr>
          </thead>
          <tbody>';
        $sqlGetOutGoing = "SELECT * FROM `sas_d_outgoing` WHERE filedFor = '$filedFor' AND datePresent = '$filedDate' AND shift = '$filedShift'";
        $queryGetO = $conn->query($sqlGetOutGoing);
        $countO = mysqli_num_rows($queryGetO);
        if($countO != '0'){
          while ($filedDataO = $queryGetO->fetch_assoc()) {
            $idNumber = $filedDataO['idNumber'];
            $empName = $filedDataO['empName'];
            $deptCode = $filedDataO['deptCode'];
            $deptGrp = $filedDataO['deptGrp'];
            $lineNo = $filedDataO['lineNo'];
            $outGoing = $filedDataO['outGoing'];
            $route = $filedDataO['route'];
            $empArea = $filedDataO['empArea'];
  
            echo '<tr>
              <td>'.$idNumber.'</td>
              <td>'.$empName.'</td>
              <td>'.$deptCode.'</th>
              <td>'.$deptGrp.'</td>
              <td>'.$lineNo.'</td>
              <td>'.$empArea.'</td>
              <td>'.$outGoing.'</td>
              <td>'.$route.'</td>
            </tr>';
  
          }
        }
        echo '</tbody></table>';
      }else if($type == 'absent'){
        echo '<table class="mt-2 table text-center table-sm table-bordered table-hover" border="1" id="tblAbsent">
          <thead>
            <tr>
            <th colspan="6">ABSENT MP</th>
            </tr>
            <tr>
              <th>ID Number</th>
              <th>Name</th>
              <th>Department</th>
              <th>Section</th>
              <th>Line</th>
              <th>Category</th>
            </tr>
          </thead>
          <tbody>';
         $sqlGetAbsent = "SELECT * FROM `sas_d_absent` WHERE filedFor = '$filedFor' AND dateAbsent = '$filedDate' AND shift = '$filedShift'";
          $queryGetA = $conn->query($sqlGetAbsent);
          $countA = mysqli_num_rows($queryGetA);
            if($countA != '0'){
              while ($filedDataA = $queryGetA->fetch_assoc()) {
                $idNumber = $filedDataA['idNumber'];
                $empName = $filedDataA['empName'];
                $deptCode = $filedDataA['deptCode'];
                $deptGrp = $filedDataA['deptGrp'];
                $lineNo = $filedDataA['lineNo'];
                $type = $filedDataA['category'];
                echo '<tr>
                  <td>'.$idNumber.'</td>
                  <td>'.$empName.'</td>
                  <td>'.$deptCode.'</td>
                  <td>'.$deptGrp.'</td>
                  <td>'.$lineNo.'</td>
                  <td>'.$type.'</td>
                </tr>';
      
              }
            }
          echo '</tbody></table>';
      }else if($type == 'filers'){
        echo '<table class="mt-2 table text-center table-sm table-bordered table-hover" border="1" id="tblFilers">
          <thead>
            <tr>
            <th colspan="6">FILING DETAILS</th>
            </tr>
            <tr>
              <th>Time Filed</th>
              <th>Filed By</th>
              <th>Refiled By</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>';
        $sqlFilers = "SELECT timeFiled,filedBy,reFiledBy,remarks FROM `sas_d_filing` WHERE filedFor = '$filedFor' AND dateFor = '$filedDate' AND shift = '$filedShift'";
        $queryGetF = $conn->query($sqlFilers);
        $countF = mysqli_num_rows($queryGetF);
          if($countF != '0'){
            while ($filedDataF = $queryGetF->fetch_assoc()) {
              $timeFiled = $filedDataF['timeFiled'];
              $filedBy = $filedDataF['filedBy'];
              $reFiledBy = $filedDataF['reFiledBy'];
              $remarks = $filedDataF['remarks'];
              echo '<tr>
                <td>'.$timeFiled.'</td>
                <td>'.$filedBy.'</td>
                <td>'.$reFiledBy.'</td>
                <td>'.$remarks.'</td>
              </tr>';
            }
          }
      }
    }
  }
?>