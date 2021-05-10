<?php
  include '../../db/config.php';
  if(isset($_POST['login'])){
    $idNumber = $_POST['idNumber'];
    $password = $_POST['password'];
    $date = date('Y-m-d h:i:s');
    $ipAdd = $_SERVER['REMOTE_ADDR'];

    $sql = "SELECT * FROM `sas_m_accounts` WHERE idNumber = '$idNumber' AND password = '$password'";
    $querySql = $conn->query($sql);
    $count = mysqli_num_rows($querySql);
    if($count == 1){
      while ($data = $querySql->fetch_assoc()) {  
        $handle = $data['empHandleLine']; 
        session_start();
        $_SESSION['idNumber'] = $data['idNumber'];
        $_SESSION['empName'] = $data['empName'];
        $_SESSION['handle'] = $data['empHandleLine'];
        $_SESSION['dept'] = $data['empDeptCode'];
        $_SESSION['userType'] = $data['userType'];
        $_SESSION['shift'] = $data['empShift'];
        $_SESSION['agency'] = '';
        $empName = $data['empName'];
        $idNumber = $data['idNumber'];
        if($handle == 'Admin'){
          header('location: ../../admin-shuttleAllocation.php');
        }else{
          header('location: ../../user-shuttle.php');
        }
      }
      $sqlInsertRec = "INSERT INTO `sas_logs`(`activityDate`, `userID`,`userName`, `actDescription`,`ipAdd`) VALUES ('$date','$idNumber','$empName','Login','$ipAdd')";
      $query = $conn->query($sqlInsertRec);
    }else{
      header('location: ../../index.php?stat=failed');
    }
  }elseif(isset($_POST['adminLogin'])){
    $idNumber = $_POST['idNumber'];
    $password = $_POST['password'];
    $date = date('Y-m-d h:i:s');
    $ipAdd = $_SERVER['REMOTE_ADDR'];

    $sql = "SELECT * FROM `sas_m_adminacc` WHERE idNumber = '$idNumber' AND password = '$password'";
    $querySql = $conn->query($sql);
    $count = mysqli_num_rows($querySql);
    if($count == 1){
      while ($data = $querySql->fetch_assoc()) { 
        session_start();
        $_SESSION['idNumber'] = $data['idNumber'];
        $_SESSION['empName'] = $data['adName'];
        $_SESSION['agency'] = $data['adEmployer'];
        $_SESSION['handle'] = $data['adEmployer'];
        $_SESSION['shift'] = $data['shift'];
        $_SESSION['userType'] = 'Agency';
        $employer = $data['adEmployer'];
        $empName = $data['adName'];
        $idNumber = $data['idNumber'];
        if($employer == 'FAS'){
          header('location: ../../admin-shuttleAllocation.php');
        }elseif($employer != 'FAS'){
          $_SESSION['userType'] = 'Agency';
          header('location: ../../user-shuttle.php');
        }
      }
      $sqlInsertRec = "INSERT INTO `sas_logs`(`activityDate`,`userID`, `userName`, `actDescription`,`ipAdd`) VALUES ('$date','$idNumber','$empName','Admin Login','$ipAdd')";
      $query = $conn->query($sqlInsertRec);
    }else{
      header('location: ../../admin-login.php?stat=failed');
    }
  }elseif(isset($_GET['logOut'])){
    session_start();
    session_destroy();
    $idNumber = $_SESSION['idNumber'];
    $date = date('Y-m-d h:i:s');
    $ipAdd = $_SERVER['REMOTE_ADDR'];
    $user = $_GET['logOut'];
    $sqlInsertRec = "INSERT INTO `sas_logs`(`activityDate`,`userID`, `userName`, `actDescription`,`ipAdd`) VALUES ('$date','$idNumber','$user','Logout','$ipAdd')";
    $query = $conn->query($sqlInsertRec);
    header('location: ../../index.php');
  }