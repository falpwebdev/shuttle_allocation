<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'transfer_details'){
      $sqlTable = "SELECT listId,CONCAT(idNumber,'-',empName) as employee,dateTrans,dateBack,filedBy, CONCAT(deptCode,' > ',deptSect,' > ',deptSubSec,' > ',lineNo) as details,`status` FROM `sas_d_mp_transfer` WHERE `status` != 'Done' AND `dateBack` = (SELECT CURRENT_DATE()) AND `filingDone` = '1'";
        $queryTbl = $conn->query($sqlTable);
        $count = mysqli_num_rows($queryTbl);
          if($count >= 1){
            while ($data = $queryTbl->fetch_assoc()) {
              echo '<tr id="'.$data['listId'].'">
                <td>'.$data['employee'].'</td>
                <td>'.$data['dateTrans'].'</td>
                <td>'.$data['dateBack'].'</td>
                <td>'.$data['filedBy'].'</td>
                <td>'.$data['details'].'</td>
                <td>'.$data['status'].'</td>
              </tr>';
            }
          }else{
            echo '<tr>
              <td colspan="6" class="text-center">No more for transfer at this hour.</td>
            </tr>';
          }
    }
  }
?>
