<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';

  // Request Processing
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
      if ($rqst == 'checkCode'){
        $outCode = $_GET['code'];
        $sql = "SELECT * FROM `t_code_resubmit_outgoing` WHERE resubmitCode = '$outCode' AND usedDt IS NULL";
        $query = $conn->query($sql);
        $count = mysqli_num_rows($query);
        if($count == 1){
          while ($data = $query->fetch_assoc()) {
            $date = $data['modifyDate'];
            $handle = $data['modifyItem'];
            $shift = $data['shift'];
          }
          $codeData = array(
            "date" => $date,
            "handle" => $handle,
            "shift" => $shift
          );
          echo json_encode($codeData);
        }else{
          echo '0';
        }
      }else if($rqst == 'filedPresentMP'){
        $date = $_GET['date'];
        $handle = $_GET['handle'];
        $shift = $_GET['shift'];
        $count = 1;
        $sql = "SELECT `empName`, `idNumber`, `outGoing`, `route`, `empArea` FROM `sas_d_outgoing` WHERE `dtFiled` = '$date' AND `shift` = '$shift' AND (`deptGrp` = '$handle' OR  `lineNo` = '$handle');";
        $query = $conn->query($sql);
        
        while($data = $query->fetch_array()){
            $empName = $data['empName'];
            $idNumber = $data['idNumber'];
            $outGoing = $data['outGoing'];
            $route = $data['route'];
            $empArea = $data['empArea'];

            echo '<tr>
              <td>'.$count.'</td>
              <td class="text-wrap">'.$empName.'</td>
              <td id="empR'.$idNumber.'">'.$route.'</td>
              <td><i class="fas fa-pencil-alt" onclick="changeRoute(&quot;'.$idNumber.'/'.$route.'&quot;)"></i>
              </td>
              <td id="empA'.$idNumber.'">'.$empArea.'</td>
              <td><i class="fas fa-sync-alt" onclick="changeArea(&quot;'.$idNumber.'&quot;);"></i>
              </td>';
              foreach ($outGoingList as $key => $timeOut){
                echo '<td>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input check'.$timeOut.' check'.$idNumber.'" id="emp'.$timeOut.$idNumber.'" value="'.$timeOut.'" name="check'.$idNumber.'" onclick="turnBlk(&quot;'.$idNumber.'&quot;)">
                    <label class="custom-control-label" for="emp'.$timeOut.$idNumber.'">'.$timeOut.'</label>
                  </div>
                </td>';
              }
              echo '<td>
                <div class="custom-control custom-radio custom-control-inline" id="divA'.$idNumber.'">
                  <input type="radio" class="custom-control-input checkAbseny check'.$idNumber.'" id="empAbsent'.$idNumber.'" value="" name="check'.$idNumber.'">
                  <label class="custom-control-label" for="empAbsent'.$idNumber.'">
                  <span class="reason r'.$idNumber.'" id="A'.$idNumber.'">A</span> / 
                  <span class="reason r'.$idNumber.'" id="N'.$idNumber.'">NW</span> / 
                  <span class="reason r'.$idNumber.'" id="R'.$idNumber.'">RD</span>
                  </label>
                </div>
              </td>';
            echo '</tr>';
            $count++;
        }
      }else if($rqst == 'filedAbsentMP'){
        $date = $_GET['date'];
        $handle = $_GET['handle'];
        $shift = $_GET['shift'];
        $count = 1;
        $sql = "SELECT `empName`, `idNumber`, `outGoing`, `route`, `empArea` FROM `sas_d_outgoing` WHERE `dtFiled` = '$date' AND `shift` = '$shift' AND (`deptGrp` = '$handle' OR  `lineNo` = '$handle');";
        $query = $conn->query($sql);
        
        while($data = $query->fetch_array()){
            $empName = $data['empName'];
            $idNumber = $data['idNumber'];
            $outGoing = $data['outGoing'];
            $route = $data['route'];
            $empArea = $data['empArea'];

            echo '<tr>
              <td>'.$count.'</td>
              <td class="text-wrap">'.$empName.'</td>
              <td id="empR'.$idNumber.'">'.$route.'</td>
              <td><i class="fas fa-pencil-alt" onclick="changeRoute(&quot;'.$idNumber.'/'.$route.'&quot;)"></i>
              </td>
              <td id="empA'.$idNumber.'">'.$empArea.'</td>
              <td><i class="fas fa-sync-alt" onclick="changeArea(&quot;'.$idNumber.'&quot;);"></i>
              </td>';
              foreach ($outGoingList as $key => $timeOut){
                echo '<td>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input check'.$timeOut.' check'.$idNumber.'" id="emp'.$timeOut.$idNumber.'" value="'.$timeOut.'" name="check'.$idNumber.'" onclick="turnBlk(&quot;'.$idNumber.'&quot;)">
                    <label class="custom-control-label" for="emp'.$timeOut.$idNumber.'">'.$timeOut.'</label>
                  </div>
                </td>';
              }
              echo '<td>
                <div class="custom-control custom-radio custom-control-inline" id="divA'.$idNumber.'">
                  <input type="radio" class="custom-control-input checkAbseny check'.$idNumber.'" id="empAbsent'.$idNumber.'" value="" name="check'.$idNumber.'">
                  <label class="custom-control-label" for="empAbsent'.$idNumber.'">
                  <span class="reason r'.$idNumber.'" id="A'.$idNumber.'">A</span> / 
                  <span class="reason r'.$idNumber.'" id="N'.$idNumber.'">NW</span> / 
                  <span class="reason r'.$idNumber.'" id="R'.$idNumber.'">RD</span>
                  </label>
                </div>
              </td>';
            echo '</tr>';
            $count++;
        }
      }
  }
