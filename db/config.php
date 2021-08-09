<?php
  date_default_timezone_set('Asia/Manila');
  $server_date = date('Y-m-d');
 	$servername = '172.25.112.172';
	$username = 'SystemGroup';
	$password = '#Sy$temGr0^p|112172';
	$db = 'live_hris';
	
	//  $servername = '172.25.114.165';
  //$username = 'SystemGroup';
  //$password = '#Sy$temGr0^p|112172';
  //$db = 'live_hris';

  $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }else{
      // echo 'connected';
    }

  $conn1 = new mysqli('172.25.112.171', 'root', '', 'sas_support');
    if ($conn1->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }
?>
