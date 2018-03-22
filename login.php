<?php
header('ACCESS-Control-Allow-Origin:*');
// db連線
require 'dbConn.inc.php';

	$acc = $_POST['acc'];
	$pwd = $_POST['pwd'];

	$sql = "SELECT * FROM registered_data WHERE Account =  '$acc' and Password = '$pwd'";

	$result = mysqli_query($conn, $sql);
	session_start();
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		echo "OK";
		$_SESSION['status'] = "OK";

		$_SESSION['id'] = $row["ID"];
		$_SESSION['acc'] = $row["Account"];
		$_SESSION['pwd'] = $row["Password"];
		$_SESSION['email'] = $row["Email"];
		$_SESSION['add'] = $row["Address"];

		$_SESSION['nickname'] = $row[""];
		$_SESSION['grp_pwd'] = $row["Grp_pwd"];
		$_SESSION['grp_time'] = $row["Grp_time"];
		
	}else{
		echo $acc;
		echo "NO";
		$_SESSION['status'] = "NO";
	}
?>