<?php
  // DEPARTMENT WITH LINES
    $withLineDept = array();
    $sqlDeptLines = "SELECT DISTINCT(`deptCode`) FROM `a_m_line`";
    $queryLineDept = $conn->query($sqlDeptLines);
      while ($dataDL = $queryLineDept->fetch_assoc()) {
        array_push($withLineDept,$dataDL['deptCode']);
      }
  // SPECIAL DEPARTMENTS
    $specialDept =  array();
    $sqlGetDepts = "SELECT deptCode FROM `a_m_department` WHERE special = 'Yes'";
    $query = $conn->query($sqlGetDepts);
      while ($dataE = $query->fetch_assoc()) {
        array_push($specialDept,$dataE['deptCode']);
      }
  // OUTGOING LIST
    $outGoingList = array();
    $sqlGetOut = "SELECT outGoing FROM a_m_outgoing";
    $query = $conn->query($sqlGetOut);
      while ($dataO = $query->fetch_assoc()) {
        array_push($outGoingList,$dataO['outGoing']);
      }
  // ROUTE LIST
    $routeList = array();
    $sqlGetRoute = "SELECT `route` FROM `sas_m_route`";
    $query = $conn->query($sqlGetRoute);
      while ($dataR = $query->fetch_assoc()) {
        array_push($routeList,$dataR['route']);
      }
  // LINE LIST
    $lineList = array();
    $sqlGetLines = "SELECT `lineNo` FROM `a_m_line`";
    $query = $conn->query($sqlGetLines);
      while ($dataL = $query->fetch_assoc()) {
        array_push($lineList,$dataL['lineNo']);
      }
  
?>