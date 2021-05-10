<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'handleMP'){
      $handle = $_GET['handle'];
      $handle = str_replace("@","&",$handle);
      $count = 1;
      $sql = "SELECT * FROM `a_m_employee` WHERE empHandler = '$handle' AND `status` = 'Active'";
      $query = $conn->query($sql);
        while ($empData = $query->fetch_assoc()) {
          $idNumber = $empData['idNumber'];
          $empName = $empData['empName'];
          $empContact = $empData['empContact'];
          $empPosition = $empData['empPosition'];
          $empAgency = $empData['empAgency'];
          $empSection = $empData['empDeptSection'];
          $empSubSect = $empData['empSubSect'];
          $empArea = $empData['empArea'];
          $empRoute = $empData['empRoute'];
          $empShift = $empData['empShift'];
          $empShiftTime = $empData['empShiftTime'];
          $empDept = $empData['empDeptCode'];
          $dateHired = $empData['dateHired'];
          $lineNo = $empData['lineNo'];
          $elemId = $idNumber.'/'.$empName.'/'.$empDept.'/'.$empPosition.'/'.$empShift;
          echo '<tr id="'.$idNumber.'">
          <td>
          <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input empC" id="C'.$idNumber.'" value="'.$elemId.'">
          <label class="custom-control-label" for="C'.$idNumber.'"></label>
          </div>
          </td>
          <td>'.$idNumber.'</td>
          <td onclick="displayMenu(&quot;'.$idNumber.'/'.$empName.'&quot;);"><i class="d-flex justify-content-end fas fa-mouse-pointer" style="font-size:8px;"></i>'.$empName.'</td>
          <td>'.$dateHired.'</td>
          <td>'.$empContact.'</td>
          <td>'.$empDept.'</td>
          <td>'.$empPosition.'</td>
          <td>'.$empShift.'</td>
          <td>'.$empArea.'</td>
          <td>'.$empRoute.'</td>';
          if (in_array($empDept, $withLineDept) || $handle == 'Recruitment and Training'){
            echo '<td>'.$lineNo.'</td>';
          }
          echo  
          '<td>'.$empShiftTime.'</td>
          <td>'.$empSection.'</td>
          <td>'.$empSubSect.'</td>
          <td>'.$empAgency.'</td>
            </tr>';
          $count++;
        }
    }else if($rqst == 'filterData'){
      $host = $_GET['handler'];
      $category = $_GET['categ'];
        // Dept
          if($category == 'dept'){
            $column = 'empDeptCode';
          }else if($category == 'sect'){
            $column = 'empDeptSection';
          }else if($category == 'sub'){
            $column = 'empSubSect';
          }else if($category == 'line'){
            $column = 'lineNo';
          }
        // Query
          $sqlQuery = "SELECT DISTINCT(".$column.") AS data FROM `a_m_employee` WHERE empHandler = '$host'";
          $query = $conn->query($sqlQuery);
          while($data = $query->fetch_assoc()){
            echo '<option value="'.$data['data'].'">'.$data['data'].'</option>';
          }
    }else if($rqst == 'filterTable'){
      $filterDept = $_GET['filterDept'];
      $filterSect1 = $_GET['filterSect'];
        $filterSect = str_replace("@","&",$filterSect1);
      $filterSub1 = $_GET['filterSub'];
        $filterSub = str_replace("@","&",$filterSub1);

      $line = $_GET['line'];
      $host = $_GET['host'];
      $dateHired = $_GET['dateHired'];

      $sql = "SELECT * FROM `a_m_employee` WHERE empDeptCode = '$filterDept' AND `empHandler` = '$host'";
      if($filterSect != 'none'){
        $sql = $sql . "AND `empDeptSection` = '$filterSect'";
      }
      if($filterSub != 'none'){
        $sql = $sql . "AND `empSubSect` = '$filterSub'";
      }
      if($line != '0'){
        $sql = $sql . "AND `lineNo` = '$line'";
      }
      if($dateHired != ''){
        $sql = $sql . "AND `dateHired` = '$dateHired'";
      }
      $query = $conn->query($sql);
      $count = 1;
      while ($empData = $query->fetch_assoc()) {
        $idNumber = $empData['idNumber'];
        $empName = $empData['empName'];
        $empContact = $empData['empContact'];
        $empPosition = $empData['empPosition'];
        $empAgency = $empData['empAgency'];
        $empSection = $empData['empDeptSection'];
        $empSubSect = $empData['empSubSect'];
        $empArea = $empData['empArea'];
        $empRoute = $empData['empRoute'];
        $empShift = $empData['empShift'];
        $empShiftTime = $empData['empShiftTime'];
        $empDept = $empData['empDeptCode'];
        $dateHired = $empData['dateHired'];
        $lineNo = $empData['lineNo'];
        $elemId = $idNumber.'/'.$empName.'/'.$empDept.'/'.$empPosition.'/'.$empShift;
        echo '<tr id="'.$idNumber.'">
        <td>
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input empC" id="C'.$idNumber.'" value="'.$elemId.'">
        <label class="custom-control-label" for="C'.$idNumber.'"></label>
        </div>
        </td>
        <td>'.$idNumber.'</td>
        <td onclick="displayMenu(&quot;'.$idNumber.'/'.$empName.'&quot;);"><i class="d-flex justify-content-end fas fa-mouse-pointer" style="font-size:8px;"></i>'.$empName.'</td>
        <td>'.$dateHired.'</td>
        <td>'.$empContact.'</td>
        <td>'.$empDept.'</td>
        <td>'.$empPosition.'</td>
        <td>'.$empShift.'</td>
        <td>'.$empArea.'</td>
        <td>'.$empRoute.'</td>';
        if (in_array($empDept, $withLineDept) || $handle == 'Recruitment and Training'){
          echo '<td>'.$lineNo.'</td>';
        }
        echo  
        '<td>'.$empShiftTime.'</td>
        <td>'.$empSection.'</td>
        <td>'.$empSubSect.'</td>
        <td>'.$empAgency.'</td>
          </tr>';
        $count++;
      }
    }else if($rqst == 'lineMP'){
      $handle = $_GET['handle'];
      $sql = "SELECT * FROM `a_m_employee` WHERE `lineNo` = '$handle' AND `status` = 'Active'";
      $query = $conn->query($sql);
        while ($empData = $query->fetch_assoc()) {
          $idNumber = $empData['idNumber'];
          $empName = $empData['empName'];
          $empAgency = $empData['empAgency'];
          $empPosition = $empData['empPosition'];
          $empShift = $empData['empShift'];
          $empDept = $empData['empDeptCode'];

          $elemId = $idNumber.'/'.$empName.'/'.$empDept.'/'.$empPosition.'/'.$empShift;
          echo '<tr id="'.$idNumber.'">
            <td>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input empC" id="C'.$idNumber.'" value="'.$elemId.'">
                <label class="custom-control-label" for="C'.$idNumber.'"></label>
              </div>
            </td>
            <td>'.$idNumber.'</td>
            <td>'.$empName.'</td>
            <td>'.$empShift.'</td>
            <td>'.$empAgency.'</td>
          </tr>';
          $count++;
        }

    }else if($rqst == 'attendanceMP'){
      $idNumber = $_GET['id'];
      $filter = $_GET['monthYear'];
      $sqlPresent = "SELECT `datePresent`,`outgoing`,(SELECT `empName` FROM `sas_m_accounts` WHERE `idNumber` = `filedBy`) FROM `sas_d_outgoing` WHERE `datePresent` LIKE '%$filter%' AND idNumber = '$idNumber'";
      $query = $conn->query($sqlPresent); 
      while ($data = $query->fetch_array()) {
        $date = $data[0];
        $out = $data[1];
        $filed = $data[2];
        $history[] = array("date" => $date, "out" => $out, "filed" => $filed);
      }
      $sqlAbsent = "SELECT `dateAbsent`,`category`,`filedBy` FROM `sas_d_absent` WHERE `dateAbsent` LIKE '%$filter%' AND `idNumber` = '$idNumber'";
      $query1 = $conn->query($sqlAbsent); 
      while ($data1 = $query1->fetch_array()) {
        $date1 = $data1[0];
        $out1 = $data1[1];
        $filed1 = $data1[2];
        $history[] = array("date" => $date1, "out" => $out1, "filed" => $filed1);
      }
      asort($history);
      foreach ($history as $key => $x) {
        echo '<tr>
        <td>'.$x['date'].'</td>
        <td>'.$x['out'].'</td>
        <td>'.$x['filed'].'</td>
        </tr>';
      }
    }
  }