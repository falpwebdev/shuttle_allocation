<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'admin_users'){
      $sql = "SELECT * FROM `sas_m_adminacc` WHERE `password` != 'Deactivated'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $idNumber = $data['idNumber'];
        $adName = $data['adName'];
        $empShift = $data['shift'];
        $employer = $data['adEmployer'];
        $password = $data['password'];
        if($employer == 'FAS'){
          $class = 'rgba-blue-light';
        }else{
          $class = '';
        }
        echo '<tr onclick="editAdAcc(&quot;'.$idNumber.'&quot;,&quot;'.$password.'&quot;)" class="'.$class.'">
          <td>'.$employer.'</td>
          <td>'.$idNumber.'</td>
          <td>'.$adName.'</td>
          <td style="-webkit-text-security: disc;">'.$password.'</td>
          <td>'.$empShift.'</td>
        </tr>';
      }
    }else if($rqst == 'li_agency'){
      $count = 1;
      $sql = "SELECT * FROM `a_m_agency` ORDER BY agencyCode ASC";
      $query = $conn->query($sql);
        while ($data = $query->fetch_assoc()) {
          $agencyCode = $data['agencyCode'];
          $agencyName = $data['agencyName'];
          echo '<tr>
            <td>'.$agencyCode.'</td>
            <td>'.$agencyName.'</td>
            <td>
              <button class="btn btn-sm btn-primary" onclick="editAgency(&quot;'.$agencyCode.'@'.$agencyName.'&quot;)"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger" onclick="deleteAgency(&quot;'.$agencyCode.'&quot;)"><i class="fas fa-trash"></i></button>
            </td>
          </tr>';
          $count++;
        }
    }else if($rqst == 'li_position'){
      $count = 1;
      $sql = "SELECT * FROM `a_m_position`";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $position = $data['position'];
        $special = $data['special'];
        echo '<tr>
          <td>'.$position.'</td>';
          if($special == 'Y'){
            $text = 'For Agency Only';
          }else if($special == 'N'){
            $text = 'For FAS Only';
          }else if($special == 'O'){
            $text = 'Applicable for All';
          }
        echo '<td>'.$text.'</td>
          <td>
            <button class="btn btn-sm btn-primary" onclick="editPosition(&quot;'.$position.'@'.$special.'&quot;)"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" onclick="deletePosition(&quot;'.$position.'&quot;)"><i class="fas fa-trash"></i></button>
          </td>
        </tr>';
        $count++;
      }
    }else if($rqst == 'li_department'){
      $sql = "SELECT deptCode,deptName, COUNT(DISTINCT(deptSection)) AS section, COUNT(DISTINCT(deptSubSection)) AS subSect,special FROM `a_m_department` GROUP BY deptCode";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $deptCode = $data['deptCode'];
        $deptName = $data['deptName'];
        $section = $data['section'];
        $subSect = $data['subSect'];
        $special = $data['special'];
        if($special == 'No'){
          $text = 'FAS';
        }else{
          $text = 'Agency';
        }
          echo '<tr onclick="viewDept(&quot;'.$deptCode.'&quot;,&quot;'.$deptName.'&quot;)">
          <td>'.$deptCode.'</td>
          <td>'.$deptName.'</td>
          <td>Section ('.$section .') Sub-Section ('.$subSect.')</td>
          <td>'.$text .'</td>
          </tr>';
      }
    }else if($rqst == 'li_dept_details'){
      $deptCode = $_GET['dept'];
      $sql = "SELECT * FROM `a_m_department` WHERE deptCode = '$deptCode'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $listID = $data['listID'];
        $deptCode = $data['deptCode'];
        $section = $data['deptSection'];
        $deptName = $data['deptName'];
        $subSect = $data['deptSubSection'];
        $special = $data['special'];
        if($special == 'No'){
          $text = 'For FAS';
        }else{
          $text = 'For Agency';

        }
        echo '<tr>
        <td>'.$deptName.'</td>
        <td>'.$section.'</td>
        <td>'.$subSect.'</td>
        <td>'.$text.'</td>
        <td>
          <button class="btn btn-sm btn-primary" onclick="editDeptColumn(&quot;'.$listID.'&quot;,&quot;'.$deptCode.'&quot;,&quot;'.$deptName.'&quot;,&quot;'.$section.'&quot;,&quot;'.$subSect.'&quot;,&quot;'.$special.'&quot;)"><i class="fas fa-edit"></i></button>
        </td>
        </tr>';
      }
    }else if($rqst == 'li_dept_sect'){
      $deptCode = $_GET['dept'];
      $sql = "SELECT DISTINCT(deptSection) AS deptSection FROM `a_m_department` WHERE deptCode = '$deptCode'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $section = $data['deptSection'];
        echo '<option value="'.$section.'">'.$section.'</option>';
      }
    }else if($rqst == 'li_dept_sub'){
      $deptCode = $_GET['dept'];
      $deptSect = $_GET['sect'];
      $deptSect = str_replace("@","&",$deptSect);
      $sql = "SELECT DISTINCT(deptSubSection) AS deptSubSection FROM `a_m_department` WHERE deptCode = '$deptCode' AND deptSection = '$deptSect'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $subSect = $data['deptSubSection'];
        echo '<option value="'.$subSect.'">'.$subSect.'</option>';
      }

    }else if($rqst == 'li_line'){
      $sql = "SELECT deptCode,COUNT(section) AS section,COUNT(subSect) AS subSect,COUNT(lineNo) AS lineNo FROM `a_m_line` GROUP BY deptCode";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {

        $deptCode = $data['deptCode'];
        $deptSection = $data['section'];
        $deptSub = $data['subSect'];
        $lineNo = $data['lineNo'];
        echo '<tr onclick="viewLines(&quot;'.$deptCode.'&quot;)">
          <td>'.$deptCode.'</td>
          <td>'.$deptSection.'</td>
          <td>'.$deptSub.'</td>
          <td>'.$lineNo.'</td>
        </tr>';
      }
    }else if($rqst == 'li_dept_line'){
      $deptCode = $_GET['dept'];
      $sqlSelect = "SELECT * FROM `a_m_line` WHERE `deptCode` = '$deptCode'";
      $query = $conn->query($sqlSelect);
      while ($data = $query->fetch_assoc()) {
        $lineNo = $data['lineNo'];
        $carMaker = $data['carMaker'];
        $process = $data['process'];
        $deptCode = $data['deptCode'];
        $deptSection = $data['section'];
        $subSect = $data['subSect'];
        echo '<tr>
          <td>'.$lineNo.'</td>
          <td>'.$deptCode.'</td>
          <td>'.$deptSection.'</td>
          <td>'.$subSect.'</td>
          <td>'.$carMaker.'</td>
          <td>'.$process.'</td>
          <td>
            <button class="btn btn-sm btn-primary" onclick="editLine(&quot;'.$lineNo.'&quot;)"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" onclick="deleteLine(&quot;'.$lineNo.'&quot;,&quot;'.$deptCode.'&quot;)"><i class="fas fa-trash"></i></button>
          </td>
        </tr>';
      }
    }else if($rqst == 'line_details'){
      $line = $_GET['line'];
      $sql = "SELECT * FROM `a_m_line` WHERE `lineNo` = '$line'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $lineNo = $data['lineNo'];
        $carMaker = $data['carMaker'];
        $process = $data['process'];
        $deptCode = $data['deptCode'];
        $section = $data['section'];
        $subSect = $data['subSect'];
      }
      $data = array(
        "lineNo" => $lineNo,
        "carMaker" => $carMaker,
        "process" => $process,
        "dept" => $deptCode,
        "section" => $section,
        "subSect" => $subSect
      );
      echo json_encode($data);
    }else if($rqst == 'li_route'){
      $sql = "SELECT * FROM sas_m_route ORDER BY listOrder ASC";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $route = $data['route'];
        $shuttle = $data['shuttle'];
        $pickup = $data['pickup'];
        $listOrder = $data['listOrder'];
        echo '<tr>
          <td>'.$route.'</td>
          <td>'.$pickup.'</td>
          <td>'.$shuttle.'</td>
          <td>'.$listOrder.'</td>
        </tr>';
      }
    }else if($rqst == 'li_out_going'){
      $count = 1;
      $sql = "SELECT * FROM `a_m_outgoing` ORDER BY outGoing ASC";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $outGoing = $data['outGoing'];
        echo '<tr>
          <td>'.$count.'</td>
          <td>'.$outGoing.'</td>
          <td>
            <button class="btn btn-sm btn-primary" onclick="editOut(&quot;'.$outGoing.'&quot;)"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" onclick="deleteOut(&quot;'.$outGoing.'&quot;)"><i class="fas fa-trash"></i></button>
          </td>
        </tr>';
        $count++;
      }
    }else if($rqst == 'li_schedule'){
      $count = 1;
      $sql = "SELECT * FROM `a_m_sched` ORDER BY schedTime ASC";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $schedTime = $data['schedTime'];
        echo '<tr>
          <td>'.$count.'</td>
          <td>'.$schedTime.'</td>
          <td>
            <button class="btn btn-sm btn-primary" onclick="editSched(&quot;'.$schedTime.'&quot;)"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" onclick="deleteSched(&quot;'.$schedTime.'&quot;)"><i class="fas fa-trash"></i></button>
          </td>
        </tr>';
        $count++;
      }
    }else if($rqst == 'li_alarm'){
      $sql = "SELECT * FROM `m_cutoff_time`";
      $query = $conn1->query($sql);
      while ($data = $query->fetch_assoc()) {
        $shift = $data['shift'];
        $cutOff = $data['timeCutOff'];
        $alarmTime = $data['timeAlarm'];
        $snoozeTime = $data['timeSnooze'];
        echo '<tr onclick="editAlarm(&quot;'.$shift.'&quot;,&quot;'.$cutOff.'&quot;,&quot;'.$alarmTime.'&quot;,&quot;'.$snoozeTime.'&quot;)">
          <td>'.$shift.'</td>
          <td>'.$cutOff.'</td>
          <td>'.$alarmTime.'</td>
          <td>'.$snoozeTime.'</td>
        </tr>';
      }
    }else if($rqst == 'm_dept_line'){
      $deptCode = $_GET['dept'];
     $sql = "SELECT `lineNo` FROM `a_m_line` WHERE `deptCode` = '$deptCode'";
      $query = $conn->query($sql);
      $count = mysqli_num_rows($query);
      if($count != '0'){
        while ($data = $query->fetch_assoc()) {
          $lineNo = $data['lineNo'];
          echo '<option value="'.$lineNo.'">'.$lineNo.'</option>';
        }
      }else{
        echo 'false';
      }
    }else if($rqst == 'li_users'){
      $sql = "SELECT * FROM `sas_m_accounts` WHERE `password` != 'Deactivated'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $idNumber = $data['idNumber'];
        $empName = $data['empName'];
        $empDeptCode = $data['empDeptCode'];
        $empPosition = $data['empPosition'];
        $empShift = $data['empShift'];
        $empHandleLine = $data['empHandleLine'];
        $password = $data['password'];
        $userType = $data['userType'];
        if($userType == 'Clerk'){
          $class = 'rgba-blue-light'; 
        }else if($userType == 'Line Leader'){
          $class = '';
        }
        echo '<tr onclick="editAcc(&quot;'.$idNumber.'&quot;,&quot;'.$password.'&quot;)" class="'.$class.'">
          <td>'.$idNumber.'</td>
          <td>'.$empName.'</td>
          <td style="-webkit-text-security: disc;">'.$password.'</td>
          <td>'.$empDeptCode.'</td>
          <td>'.$empHandleLine.'</td>
          <td>'.$empPosition.'</td>
          <td>'.$empShift.'</td>
          <td>'.$userType.'</td>
        </tr>';
      }
    }else if($rqst == 'm_id_employee'){
      $deptCode = $_GET['dept'];
      $handler = $_GET['handler'];
      $type = $_GET['type'];
      if($type == 'Clerk'){
        $column = 'empDeptSection';
      }else if($type == 'Line Leader'){
        $column = 'lineNo';
      }
      $handle = str_replace("@","&",$handler);
      $sql = "SELECT `idNumber` FROM `a_m_employee` WHERE `empDeptCode` = '$deptCode' AND $column = '$handle' AND status = 'Active'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        echo '<option value="'.$data['idNumber'].'">'.$data['idNumber'].'</option>';
      }
    }else if($rqst == 'm_name_emp'){
      $idNumber = $_GET['idNumber'];
      $sql = "SELECT `empName` FROM `a_m_employee` WHERE `idNumber` = '$idNumber' AND status = 'Active'";
      $query = $conn->query($sql);
      $count = mysqli_num_rows($query);
      if($count != '0'){
        $data = $query->fetch_assoc();
        echo $data['empName'];
      }else{
        echo 'false';
      }
    }else if($rqst == 'm_carMaker'){
      $sql = "SELECT * FROM `a_m_maker`";
      if(isset($_GET['section'])){
        $section = $_GET['section'];
        $sql = $sql . " WHERE `section`  = '$section'";
      }else{
        $dept = $_GET['dept'];
        $sql = $sql . " WHERE `deptCode`  = '$dept'";
      }
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $carMaker = $data['carMaker'];
        echo '<option value="'.$carMaker.'">'.$carMaker.'</option>';
      }
    }
}