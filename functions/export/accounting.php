<?php
  include '../../db/config.php';
  $date = date("M d, Y");
  $file = "Cost Report as of ".$date.".xls";
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition:;filename=\"$file\"");

  $sqlSelectEmployees = "SELECT * FROM `a_m_employee` WHERE `status` = 'Active' OR `status` = 'ML'";
  $query = $conn->query($sqlSelectEmployees);
  $count = '1';
  echo '<table border="1">
    <thead>
      <tr> 
        <th colspan="7"> Cost Accounting Report</th>
      </tr>
      <tr>
        <th>No.</th>
        <th>Employee No.</th>
        <th>Name</th>
        <th>Costing</th>
        <th>Shuttle Route</th>
        <th>Employer</th>
        <th>Provider</th>
      </tr>
    </thead>
    <tbody>';
  
    while ($data = $query->fetch_assoc()) {
      echo '<tr>
        <td>'.$count.'</td>
        <td>'.$data['idNumber'].'</td>
        <td>'.$data['empName'].'</td>
        <td>'.$data['empCostCenter'].'</td>
        <td>'.$data['empRoute'].'</td>
        <td>'.$data['empAgency'].'</td>';
        // Determine Shuttle Provider
          $route = $data['empRoute'];
          $sqlProvider = "SELECT `shuttle` FROM `sas_m_route` WHERE route = '$route'";
          $query1 = $conn->query($sqlProvider);
          $countD = mysqli_num_rows($query1);
          if($countD == '1'){
            $data1 = $query1->fetch_assoc();
            echo '<td>'.$data1['shuttle'].'</td>';
          }else{
            echo '<td>Error in data.</td>';
          }
      echo '</tr>';
      $count++;
    }
  echo '</tbody>
  </table>';
?>