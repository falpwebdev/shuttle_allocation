<?php
  if(isset($_GET['line'])){
    $line = $_GET['line'];
    include '../db/config.php';
  }else{
    header('Location: index.php');
  }
?>
<table class="table" border="1">
   <thead>
       <tr>
           <th scope="col">#</th>
           <th scope="col">ID Number</th>
           <th scope="col">Name</th>
           <th scope="col">Line</th>
           <th scope="col">Route</th>
           <th scope="col">Shift</th>
       </tr>
   </thead>
   <tbody>
    <?php
      $count = 1;
      $sql = "SELECT * FROM  `a_m_employee` WHERE lineNo = '$line'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $idNumber = $data['idNumber'];
        $empName = $data['empName'];
        $lineNo = $data['lineNo'];
        $empRoute = $data['empRoute'];
        $empShift = $data['empShift'];
        echo '<tr>
          <td>'.$count.'</td>
          <td>'.$idNumber.'</td>
          <td>'.$empName.'</td>
          <td>'.$lineNo.'</td>
          <td>'.$empRoute.'</td>
          <td>'.$empShift.'</td>
        </tr>';
        $count++;
      }
    ?>
   </tbody>
</table>
<!-- SCRIPTS -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/mdb.min.js"></script>
  <script type="text/javascript" src="../js/addons/datatables.min.js"></script>
  <script src="../js/addons/datatables-select.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="../js/addons/datatables-select2.min.js"></script>
  <script src="../js/sweetalert.js"></script>
<!-- /SCRIPTS -->
<script>
$(document).ready(function(){
  window.print();
});
window.onafterprint = function(){
  window.location.href = 'index.php';
}
</script>