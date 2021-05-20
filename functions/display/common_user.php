<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'user_notifs'){
      $handle = $_GET['handle'];
      $handle = str_replace("@","&",$handle); 
      // Get Data
        $sqlGetNotifs = "SELECT `remarks`,`status`,`dateFiled`,(SELECT empName FROM sas_m_accounts WHERE idNumber = `userFiled`) AS userFiled, (SELECT adName FROM sas_m_adminacc WHERE idNumber = `userFiled`) AS userFiled1,`data` FROM `sas_notifs` WHERE `handler` = '$handle' ORDER BY `dateFiled` DESC";
        $queryGet = $conn->query($sqlGetNotifs);
      //  Display Data
        echo '<p class="text-center">Notifications</p><ul class="list-group list-group-flush">';
        while ($notifs = $queryGet->fetch_assoc()) {
          $rem = $notifs['remarks'];
          $stat = $notifs['status'];
          $date = $notifs['dateFiled'];
          $dateFiled = date("F j, Y h:s a",strtotime($date));
          $data = $notifs['data'];
          if($notifs['userFiled'] == '' && $notifs['userFiled1'] == ''){
            $userFiled = 'System Generated';
          }elseif($notifs['userFiled1'] != ''){
            $userFiled = $notifs['userFiled1'];
          }else{
            $userFiled = $notifs['userFiled'];
          }
          
          if($stat == 'new'){
            $color = 'rgba-blue-slight'; 
          }else{
            $color = ''; 
          }
          echo '<li class="dropdown-item list-group-item '.$color.'"><em><span class="d-flex justify-content-end" style="font-size: 12px;">'.$dateFiled.'</span></em><span class="d-flex justify-content-start font-weight-bold" style="font-size: 15px;">'.$rem.'</span><span class="d-flex justify-content-start" style="font-size: 13px;">'.$data.'</span><span class="d-flex justify-content-end" style="font-size: 12px;">Filed By: '.$userFiled.'</span></li>';
        }
    }else if ($rqst == 'sas_m_route') {
      echo '<option selected value="0">Select Route</option>';
      $sql = "SELECT * FROM `sas_m_route`";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $route = $data['route'];
        echo '<option value="'.$route.'">'.$route.'</option>';
      }
    }
  }
?>