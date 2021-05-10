<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'master_dept'){
      $type = $_GET['type'];
      $data = $_GET['data1'];
      if($type == 'dept'){  
        $column = 'empDeptCode';
      }else if($type == 'idNum'){
        $column = 'idNumber';
      }
      if($type == 'dept' || $type == 'idNum'){  
        $sql = "SELECT * FROM `a_m_employee` WHERE `status` = 'Active' AND $column = '$data'";
      }
      if($type == 'section'){
        $data1 = explode("/",$data);
        $deptCode = $data1[0];
        $deptSection = $data1[1];
        $deptSect = str_replace("@","&",$deptSection);

        $sql = "SELECT * FROM `a_m_employee` WHERE `status` = 'Active' AND `empDeptCode` = '$deptCode' AND `empDeptSection` = '$deptSect'";
      }

      if(isset($_GET['agency'])){
        $employer = $_GET['agency'];
        $sql = $sql . " AND `empAgency` = '$employer'";
      }
      // echo $sql;
      $query = $conn->query($sql);
      $count = 1;
        while ($empData = $query->fetch_assoc()) {
          $idNumber = $empData['idNumber'];
          $empName = $empData['empName'];
          $empContact = $empData['empContact'];
          $empPosition = $empData['empPosition'];
          $empCostCenter = $empData['empCostCenter'];
          $empAgency = $empData['empAgency'];
          $empSection = $empData['empDeptSection'];
          $empSubSect = $empData['empSubSect'];
          $empLineNo = $empData['lineNo'];
          $empArea = $empData['empArea'];
          $empRoute = $empData['empRoute'];
          $empShift = $empData['empShift'];
          $empShiftTime = $empData['empShiftTime'];
          $dateHired = $empData['dateHired'];
          $empHandler = $empData['empHandler'];
          $empBatch = $empData['batchNo'];
          $empDeptCode = $empData['empDeptCode'];
          $empSection = $empData['empDeptSection'];
    
          echo '<tr onclick="displayMenu(&quot;'.$idNumber.'/'.$empName.'&quot;);">
            <td>'.$count.'</td>
            <td>'.$idNumber.'</td>
            <td>'.$dateHired.'</td>
            <td>'.$empBatch.'</td>
            <td>'.$empName.'</td>
            <td>'.$empContact.'</td>
            <td>'.$empPosition.'</td>
            <td>'.$empCostCenter.'</td>
            <td>'.$empAgency.'</td>
            <td>'.$empDeptCode.'</td>
            <td>'.$empSection.'</td>
            <td>'.$empSubSect.'</td>
            <td>'.$empLineNo.'</td>
            <td>'.$empArea.'</td>
            <td>'.$empRoute.'</td>
            <td>'.$empShift.'</td>
            <td>'.$empShiftTime.'</td>
            <td>'.$empHandler.'</td></tr>
          ';
            $count++;
        }
    }else if($rqst == 'active_emp_count'){
      // Variables
        $totA = 0;
        $totS = 0;
        $totM = 0;
      // Select Agencies in the Master
        $sqlSelAgency = "SELECT DISTINCT(empAgency) As agency FROM a_m_employee";
        $query = $conn->query($sqlSelAgency);
      // Get MP Count of the Agencies in the Master
        while ($dataA = $query->fetch_assoc()) {
          $agency = $dataA['agency'];
          echo '<tr>
            <td>'.$agency.'</td>';
          // Active
            $sqlCountAct = "SELECT COUNT(idNumber) AS active FROM `a_m_employee` WHERE `status` = 'Active' AND  `empAgency` = '$agency'";
            $queryA = $conn->query($sqlCountAct);
            $datA = $queryA->fetch_assoc();
            echo '<td>'.$datA['active'].'</td>';
              $totA = $totA + $datA['active'];
          // Suspended
            $sqlCountS = "SELECT COUNT(idNumber) AS suspended FROM `a_m_employee` WHERE `status` = 'Suspended' AND  `empAgency` = '$agency'";
            $queryS = $conn->query($sqlCountS);
            $datS = $queryS->fetch_assoc();
            echo '<td>'.$datS['suspended'].'</td>';
              $totS = $totS + $datS['suspended'];
          // ML
            $sqlCountM = "SELECT COUNT(idNumber) AS ml FROM `a_m_employee` WHERE `status` = 'ML' AND  `empAgency` = '$agency'";
            $queryM = $conn->query($sqlCountM);
            $datM = $queryM->fetch_assoc();
            echo '<td>'.$datM['ml'].'</td>';
              $totM = $totM + $datM['ml'];
        }
        echo '</tr>';
        // Display Total
          echo '<tr>
            <td>Total</td>
            <td>'.$totA.'</td>
            <td>'.$totS.'</td>
            <td>'.$totM.'</td>
          </tr>';
    }else if($rqst == 'emp_inactive'){
      $task = $_GET['task'];
      $field = $_GET['filterBy'];
      $data = $_GET['data1'];
      $employer = $_GET['employer'];

      if($field == 'monthYear'){
        $field = 'dateHired';
        $sql = "SELECT * FROM a_m_employee WHERE $field LIKE '$data' AND `status` != 'Active' AND empAgency = '$employer'";
      }else{
        $data = '%'.$data.'%';
        $sql = "SELECT * FROM a_m_employee WHERE $field LIKE '$data' AND `status` != 'Active' AND empAgency = '$employer'";
      }
      if($task == 2){
        $category = json_decode($_GET['category']);
        if(count($category) != 0){
          $sql = $sql . " AND (";
          $y = 0;
          foreach ($category as $key => $x) {
            if($y == 0){
              $sql = $sql. "`status` = '$x' ";
            }else{
              $sql = $sql . " OR `status` = '$x'";
            }
            $y++;
          }
          $sql = $sql .")";
        }else{
          $sql = $sql . " AND `status` != 'Active'";
        }
      }
      $count = 1;
      $query = $conn->query($sql);
      $countData = mysqli_num_rows($query);
      if($countData != 0){
        while ($empData = $query->fetch_assoc()) {
          $idNumber = $empData['idNumber'];
            $empName = $empData['empName'];
            $empContact = $empData['empContact'];
            $empPosition = $empData['empPosition'];
            $empCostCenter = $empData['empCostCenter'];
            $empDept = $empData['empDeptCode'];
            $empAgency = $empData['empAgency'];
            $empSection = $empData['empDeptSection'];
            $empSubSect = $empData['empSubSect'];
            $empLineNo = $empData['lineNo'];
            $empArea = $empData['empArea'];
            $empRoute = $empData['empRoute'];
            $empShift = $empData['empShift'];
            $empShiftTime = $empData['empShiftTime'];
            $dateHired = $empData['dateHired'];
            $empHandler = $empData['empHandler'];
            $empBatch = $empData['batchNo'];
            $empStat = $empData['status'];
            if($empStat == 'AWOL'){
              $class = 'rgba-pink-strong';
            }elseif($empStat == 'Cancel'){
              $class = 'rgba-red-strong';
            }elseif($empStat == 'Resign'){
              $class = 'rgba-blue-light';
            }elseif($empStat == 'Suspended'){
              $class = 'rgba-indigo-strong';
            }else{
              $class = 'rgba-grey-light';
            }
            echo '<tr class="'.$class.'">
            <td>'.$count.'</td>
            <td class="grey lighten-5">
              <a class="btn btn-sm btn-info" href="emp-view-history.php?empId='.$idNumber.'&empName='.$empName.'&role=admin">History</a>
              <button class="btn btn-sm btn-primary" onclick="returnEmp(&quot;'.$idNumber.'/'.$empName.'/'.$empStat.'/'.$empHandler.'&quot;);">Return</button>
            </td>
            <td>'.$idNumber.'</td>
            <td>'.$dateHired.'</td>
            <td>'.$empBatch.'</td>
            <td>'.$empName.'</td>
            <td>'.$empContact.'</td>
            <td>'.$empPosition.'</td>
            <td>'.$empDept.'</td>
            <td>'.$empSection.'</td>
            <td>'.$empSubSect.'</td>
            <td>'.$empLineNo.'</td>
            <td>'.$empArea.'</td>
            <td>'.$empRoute.'</td>
            <td>'.$empShift.'</td>
            <td>'.$empShiftTime.'</td>
            <td>'.$empHandler.'</td>
            </tr>';
            $count++;
        }
      }else{
        echo '';
      }
    }
  }
