<?php
  include '../../db/config.php';
  include '../../functions/inc/inc.php';
  if(isset($_GET['data'])){
    $rqst = $_GET['data'];
    if($rqst == 'a_m_department'){
      $sql = "SELECT DISTINCT(deptCode) AS deptCode FROM `a_m_department` WHERE `special` = 'No'";
      $query = $conn->query($sql);
      echo '<option selected value="0">Select Department</option>';
      while ($data = $query->fetch_assoc()) {
        $deptCode = $data['deptCode'];
        echo '<option value="'.$deptCode.'">'.$deptCode.'</option>';
      }
    }else if($rqst == 'm_deptSect'){
      $deptCode = $_GET['dept'];
      $sql = "SELECT DISTINCT(deptSection) AS deptSection FROM `a_m_department` WHERE deptCode = '$deptCode'";
      $query = $conn->query($sql);
      while ($data = $query->fetch_assoc()) {
        $section = $data['deptSection'];
        echo '<option value="'.$section.'">'.$section.'</option>';
      }
    }else if ($rqst == 'm_deptSubSect') {
      $dept = $_GET['dept'];
      $sect1 = $_GET['sect'];
      $sql = "SELECT DISTINCT(`deptSubSection`) AS deptSubSection FROM `a_m_department` WHERE deptCode = '$dept'";
      if($sect1 != ''){
        $sect = str_replace("@","&",$sect1);
        $sql = $sql." AND deptSection = '$sect'";
      }
      echo $sql;
      $query = $conn->query($sql);
      while($data = $query->fetch_assoc()){
        $subSect = $data['deptSubSection'];
          echo '<option value="'.$subSect.'">'.$subSect.'</option>';
      }
    }else if ($rqst == 'm_line') {
      $dept = $_GET['dept'];
      $sect = $_GET['sect'];
      $subSect = $_GET['subSect'];
      echo $sql = "SELECT `lineNo` FROM `a_m_line` WHERE `deptCode` = '$dept' AND `section` = '$sect' AND `subSect` = '$subSect'";
      $query = $conn->query($sql);
      echo '<option selected value="N/A">Select Line No</option>';
      echo '<option selected value="N/A">N/A</option>';
      while ($data = $query->fetch_assoc()) {
        $lineNo = $data['lineNo'];
        echo '<option value="'.$lineNo.'">'.$lineNo.'</option>';
      }    
    }else if ($rqst == 'adjust_line') {
      $sql = "SELECT DISTINCT(`lineNo`) FROM `a_m_employee`";
      $query = $conn->query($sql);
      echo '<option selected value="N/A">Select Line No</option>';
      while ($data = $query->fetch_assoc()) {
        $lineNo = $data['lineNo'];
        echo '<option value="'.$lineNo.'">'.$lineNo.'</option>';
      }    
    }else if($rqst == 'a_m_position'){
      $sql = "SELECT * FROM `a_m_position` WHERE `special` = 'N' OR `special` = 'O'";
      $query = $conn->query($sql);
      echo '<option selected value="0">Select Position</option>';
      while ($data = $query->fetch_assoc()) {
        $position = $data['position'];
        echo '<option value="'.$position.'">'.$position.'</option>';
      }
    }else if ($rqst == 'a_m_agency') {
      $sql = "SELECT * FROM `a_m_agency`";
      $query = $conn->query($sql);
      echo '<option selected value="0">Select Employer</option>';
      while ($data = $query->fetch_assoc()) {
        $agency = $data['agencyCode'];
        echo '<option value="'.$agency.'">'.$agency.'</option>';
      }
    }else if ($rqst == 'm_cost') {
      $position = $_GET['position'];
      $key = array_search($position,array_column($positionList,'position'));
      $rank = $positionList[$key]["rank"];
        echo $costing = '501.'.$rank.'_PD Technical Training';
    }else if ($rqst == 'ma_cost') {
          $position = $_GET['position'];
          if($position == 'Associate'){
            echo "501.1_PD Technical Training";
          }else{
            echo "N/A";
          }
    }else if ($rqst == 'a_m_department') {
      $sql = "SELECT DISTINCT(deptCode) AS deptCode FROM `a_m_department` WHERE `special` = 'No'";
      $query = $conn->query($sql);
      echo '<option selected value="0">Select Department</option>';
      while ($data = $query->fetch_assoc()) {
        $deptCode = $data['deptCode'];
        echo '<option value="'.$deptCode.'">'.$deptCode.'</option>';
      }
    }else if($rqst == 'ma_position'){
      $sql = "SELECT * FROM `a_m_position` WHERE `special` = 'Y' OR `special` = 'O'";
      $query = $conn->query($sql);
      echo '<option selected value="0">Select Position</option>';
      while ($data = $query->fetch_assoc()) {
        $position = $data['position'];
        echo '<option value="'.$position.'">'.$position.'</option>';
      }
    }else if ($rqst == 'ma_department') {
      $sql = "SELECT DISTINCT(deptCode) AS deptCode FROM `a_m_department`";
      $query = $conn->query($sql);
      echo '<option selected value="0">Select Department</option>';
      while ($data = $query->fetch_assoc()) {
        $deptCode = $data['deptCode'];
        echo '<option value="'.$deptCode.'">'.$deptCode.'</option>';
      }
    }
  }
?>
  
