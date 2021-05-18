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
  // DEPARTMENT LIST
    $deptList = array();
    $sqlGetDepts = "SELECT DISTINCT(`deptCode`) AS deptCode FROM `a_m_department`";
    $query = $conn->query($sqlGetDepts);
      while ($dataD = $query->fetch_assoc()) {
        array_push($deptList,$dataD['deptCode']);
      }
    $subCodesList = array();
    $sqlGetSubCodes = "SELECT `deptSubSection`,`code` FROM `a_m_department` GROUP BY deptSubSection,code";
    $query = $conn->query($sqlGetSubCodes);
      while ($dataDC = $query->fetch_assoc()) {
        $subSection = $dataDC['deptSubSection'];
        $code = $dataDC['code'];
        $subCodesList[] = array("subSection" => $subSection, "code" => $code);
      }
  // POSITION LIST
    $positionList = array();
      $sqlGetPosition = "SELECT * FROM `a_m_position`";
        $query = $conn->query($sqlGetPosition);
          while ($dataP = $query->fetch_assoc()) {
            $position = $dataP['position'];
            $rank = $dataP['rank'];
            $positionList[] = array("position" => $position, "rank" => $rank);
          }
  // AGENCY LIST
    $agencyList = array();
      $sqlGetAgency = "SELECT * FROM `a_m_agency`";
        $query = $conn->query($sqlGetAgency);
          while ($dataA = $query->fetch_assoc()) {
            $agencyCode = $dataA['agencyCode'];
            $pattern = $dataA['pattern'];
            $agencyList[] = array("agency" => $agencyCode, "pattern" => $pattern);
          }
  //  SHIFT LIST
    $shiftList = array("ADS","DS","NS");
  //  SCHED LIST
    $schedList = array();
      $sqlGetSched = "SELECT * FROM `a_m_sched`";
        $query = $conn->query($sqlGetSched);
          while ($dataS = $query->fetch_assoc()) {
            array_push($schedList,$dataS['schedTime']);
          }
  //  SHIFT LIST
    $jtList = array("Permanent","Temporary");
?>