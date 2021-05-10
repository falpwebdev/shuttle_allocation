<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';

  // Request Processing
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'code_type'){
      $dept = $_GET['dept'];
      $type = $_GET['type'];
        if($type == 'deptSection'){
          $table = "a_m_department";
        }else if($type == 'lineNo'){
          $table = "a_m_line";
        }
      $sql = "SELECT DISTINCT($type) FROM `$table` WHERE `deptCode` = '$dept'";
      $query = $conn->query($sql);
      while($data = $query->fetch_assoc()){
        echo '<option value="'.$data[$type].'">'.$data[$type].'</option>';
      }
    }else if($rqst == 'code_check_emp'){
      $idNumber = $_GET['emp'];
      $deptCode = $_GET['dept'];
      $categ = $_GET['categ'];
      $data = $_GET['sectLine'];
      $shift = $_GET['shift'];
      $sql = "SELECT `empName` FROM `a_m_employee` WHERE idNumber = '$idNumber' AND `empDeptCode` = '$deptCode' AND `$categ` = '$data' AND `empShift` = '$shift'";
        $query = $conn->query($sql);
        $count = mysqli_num_rows($query);
      if($count != '1'){
        echo 'false';
      }else{
        $dataz = $query->fetch_assoc();
        echo $empName = $dataz['empName'];
      }
    }else if($rqst == 'li_code_out'){
      $sqlSelect = "SELECT * FROM `sas_m_resub_code`";
      $query = $conn->query($sqlSelect);
      while($data = $query->fetch_assoc()){
        $code = $data['code'];
        $filedFor = $data['filedFor'];
        $dateFor = date_create($data['dateFor']);
        $dateFor = date_format($dateFor,"M d, Y");
        $createdDate = date_create($data['createdDate']);
        $created = date_format($createdDate,"M d, Y h:i:s");
        $requestorId = $data['requestorId'];
        $requestorName = $data['requestorName'];
        $dateClosed = date_create($data['usedDt']);
        if($dateClosed == '0000-00-00 00:00:00'){
          $dateClosed = '';
        }else{
          $dateClosed = date_format($dateClosed,"M d, Y h:i:s");
        }

        $status = $data['status'];
        if($status == 'Open'){
          $class = 'rgba-blue-light';
        }else{
          $class = '';
        }
        echo '<tr class="'.$class.'">
          <td>'.$code.'</td>
          <td>'.$filedFor.'</td>
          <td>'.$dateFor.'</td>
          <td>'.$created.'</td>
          <td>'.$requestorId.' / '.$requestorName.'</td>
          <td>'.$dateClosed.'</td>
          <td>'.$status.'</td>
          <td>';
            if($status == 'Open'){
              echo '<button class="btn btn-sm btn-blue" onclick="followUp(&quot;'.$filedFor.'&quot;,&quot;'.$code.'&quot;)"><i class="fas fa-bell" style="font-size:12px;"></i></button>
              
              <button class="btn btn-sm btn-red" onclick="deleteCode(&quot;'.$code.'&quot;)"><i class="fas fa-trash-alt" style="font-size:12px;"></i></button>';
            }else{
              echo '<button class="btn btn-sm btn-green" onclick="refreshCode(&quot;'.$code.'&quot;)"><i class="fas fa-undo"></i></i></button>';
            }
          echo '</td>
        </tr>';
      }
    }else if($rqst == 'code_details'){
      $code = $_GET['code'];
      $sql = "SELECT * FROM `sas_m_resub_code` WHERE `code` = '$code' AND `status` = 'Open'";
      $query = $conn->query($sql);
      $count = mysqli_num_rows($query);
      if($count != 0){
        while ($data = $query->fetch_assoc()) {
          $filedFor = $data['filedFor'];
          $dateFor = $data['dateFor'];
          $shift = $data['shift'];
        }
        echo '
          <b>Code</b>: '.$code.'<br>
          <b>Filed For</b>: '.$filedFor.'<br>
          <b>Filed Date</b>: '.$dateFor.'<br>
          <b>Shift</b>: '.$shift;
      }else{
        echo 'false';
      }
    }else if($rqst == 'code_confirm'){
      $code = $_GET['code'];
      // Variables
        $data = array();
      // Get Status
        $sql = "SELECT * FROM `sas_m_resub_code` WHERE `code` = '$code' AND `status` = 'Open'";
        $queryC = $conn->query($sql);
        $count = mysqli_num_rows($queryC);
        if($count == 1){
          // Update Filed Data
            $sqlUpdate = "UPDATE `sas_m_resub_code` SET `status`='Updating' WHERE `code`='$code' AND `status`='Open'";
            $queryU = $conn->query($sqlUpdate);
              if($queryU){
                while ($dataC = $queryC->fetch_assoc()) {
                  $filedFor = $dataC['filedFor'];
                  $dateFor = $dataC['dateFor'];
                  $shift = $dataC['shift'];
                  $requestorId = $dataC['requestorId'];
                  $requestorName = $dataC['requestorName'];
                  $data[] = array(
                    "filedFor" => $filedFor,
                    "dateFor" => $dateFor,
                    "shift" => $shift,
                    "requestor" => $requestorId,
                    "requestorName" => $requestorName
                  );
                }
              }
          echo json_encode($data);
        }else{
          $data = [];
          echo json_encode($data);
        }
    }else if($rqst == 'code_data'){
      $dateFor = $_GET['date'];
      $filedFor = $_GET['handle'];
      $shift = $_GET['shift'];
      // Variables
        $outgoingMP = array();
        $absentMP = array();
      // Get Filed Data
        // Outgoing
          $sqlGetOut = "SELECT * FROM `sas_d_outgoing` WHERE `datePresent` = '$dateFor' AND `filedFor` = '$filedFor' AND `shift` = '$shift'";
          $queryO = $conn->query($sqlGetOut);
            while ($datO = $queryO->fetch_assoc()) {
              $outgoingMP[] = array(
                "idNumber" => $datO['idNumber'],
                "empName" => $datO['empName'],
                "empArea" => $datO['empArea'],
                "route" => $datO['route'],
                "outGoing" => $datO['outGoing']
              );
            }
      // Absent
          $sqlGetAbsent = "SELECT * FROM `sas_d_absent` WHERE `dateAbsent` = '$dateFor' AND `filedFor` = '$filedFor' AND `shift` = '$shift'";
            $queryA = $conn->query($sqlGetAbsent);
            while ($datA = $queryA->fetch_assoc()) {
              $idNumber = $datA['idNumber'];
              $sqlGetOther = "SELECT `empArea`,`empRoute` FROM `a_m_employee` WHERE `idNumber`= '$idNumber'";
              $queryD = $conn->query($sqlGetOther);
              $datD = $queryD->fetch_assoc();

              $absentMP[] = array(
                "idNumber" => $idNumber,
                "empName" => $datA['empName'],
                "empArea" => $datD['empArea'],
                "route" => $datD['empRoute'],
                "outGoing" => $datA['category']
              );
            }
        // Merge Array
          $filedData = array_merge_recursive($outgoingMP,$absentMP);
          asort($filedData);
          foreach ($filedData as $key => $a) {
            $idNumber = $a['idNumber'];
            $empName = $a['empName'];
            $route = $a['route'];
            $empArea = $a['empArea'];
            $outGoing = $a['outGoing'];
            
            // Display UI
              echo '<tr id="id'.$idNumber.'">
                <td>'.$idNumber.'</td>
                <td>'.$empName.'</td>
                <td id="empR'.$idNumber.'">'.$route.'</td>
                <td><i class="fas fa-pencil-alt" onclick="changeRoute(&quot;'.$idNumber.'/'.$route.'&quot;)"></i></td>
                <td id="empArea'.$idNumber.'">'.$empArea.'</td>
                <td><i class="fas fa-sync-alt" onclick="changeArea(&quot;'.$idNumber.'&quot;);"></i></td>';
                foreach ($outGoingList as $key => $outGoing) {
                  echo '<td>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input check'.$outGoing.' check'.$idNumber.'" id="emp'.$outGoing.''.$idNumber.'" value="'.$outGoing.'" name="check'.$idNumber.'">
                    <label class="custom-control-label" for="emp'.$outGoing.''.$idNumber.'">'.$outGoing.'</label>
                  </div>
                </td>';
              }
              echo '<td>
              <div class="custom-control custom-radio custom-control-inline" id="divA'.$idNumber.'">
              <input type="radio" class="custom-control-input checkAbsent check'.$idNumber.'" id="empA'.$idNumber.'" value="A" name="check'.$idNumber.'">
                <label class="custom-control-label" for="empA'.$idNumber.'">A</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input checkAbsent check'.$idNumber.'" id="empNW'.$idNumber.'" value="NW" name="check'.$idNumber.'">
                <label class="custom-control-label" for="empNW'.$idNumber.'">NW</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input checkAbsent check'.$idNumber.'" id="empRD'.$idNumber.'" value="RD" name="check'.$idNumber.'">
                <label class="custom-control-label" for="empRD'.$idNumber.'">RD</label>
              </div>
            </td>';
               echo '</tr>';
          }
    }else if($rqst == 'filed_details'){
      $dateFor = $_GET['dateFor'];
      $filedFor = $_GET['filedFor'];
      $shift = $_GET['shift'];
      $idNumber = $_GET['idNumber'];

      $sqlSelO = "SELECT `outGoing`  FROM `sas_d_outgoing` WHERE `datePresent` = '$dateFor' AND `filedFor` = '$filedFor' AND `shift` = '$shift' AND `idNumber` = '$idNumber'";
      $queryO = $conn->query($sqlSelO);
      $count = mysqli_num_rows($queryO);
      // Present
      if($count == '1'){
        $datO = $queryO->fetch_assoc();
        echo $datO['outGoing'];
      }else{
        // Absent
        $sqlSelA = "SELECT `category` FROM `sas_d_absent` WHERE  `dateAbsent` = '$dateFor' AND `filedFor` = '$filedFor' AND `idNumber` = '$idNumber' AND `shift` = '$shift'";
        $queryA = $conn->query($sqlSelA);
        $datA = $queryA->fetch_assoc();
        echo $datA['category'];
      }
    }
  }
