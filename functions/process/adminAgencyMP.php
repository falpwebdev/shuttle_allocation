<?php
  $employer = $_GET['employer'];
?>
<table id="tblEmployees" class="table table-bordered table-sm" cellspacing="0" width="100%" border="1">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>ID Number</th>
                      <th>Date Hired</th>
                      <th>Batch Number</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Contact</th>
                      <th>Position</th>
                      <th>Cost Center</th>
                      <th>Employer</th>
                      <th>Department</th>
                      <th>Section</th>
                      <th>Sub-Section</th>
                      <th>Line No</th>
                      <th>Area</th>
                      <th>Route</th>
                      <th>Shift</th>
                      <th>Shift Schedule</th>
                      <th>Job Type</th>
                    </tr>
                  </thead>
                  <tbody id="tblEmp">
<?php
    $datenow = date('Y-m-d');
    $filename = "Employee Masterlist of ".$employer." as of ".$datenow.".xls";
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Type: text/csv; charset=utf-8');  
    header("Content-Disposition: ; filename=\"$filename\"");
  include '../../db/config.php';
  $count = 1;
  $sqlSelect = "SELECT * FROM `a_m_employee` WHERE `empAgency` = '$employer' AND `status` = 'Active'";
  $query = $conn->query($sqlSelect);
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
    $empGender = $empData['gender'];
    $jobType = $empData['jobType'];

    echo '<tr>
      <td>'.$count.'</td>
      <td>'.$idNumber.'</td>
      <td>'.$dateHired.'</td>
      <td>'.$empBatch.'</td>
      <td>'.$empName.'</td>
      <td>'.$empGender.'</td>
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
      <td>'.$jobType.'</td>
    ';
      $count++;
  }
?>