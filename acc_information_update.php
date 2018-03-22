<?php
// db連線
require 'dbConn.inc.php';

	$id = $_POST['id'];
	$nickname = $_POST['nickname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$addr = $_POST['address'];
	$grp_pwd = $_POST['grp_pwd'];

	$sql = "UPDATE registered_data SET Nickname='$nickname', Password='$password' , Email='$email', Address='$addr', Grp_pwd='$grp_pwd' WHERE ID='$id'";
	
	if(mysqli_query($conn, $sql)){
		echo "OK";
		session_start();
		$update_sql = "SELECT * FROM registered_data WHERE ID='$id'";
		$result = mysqli_query($conn, $update_sql);
		$row = mysqli_fetch_array($result);
		$_SESSION['status'] = "OK";

		$_SESSION['id'] = $row["ID"];
		$_SESSION['acc'] = $row["Account"];
		$_SESSION['pwd'] = $row["Password"];
		$_SESSION['email'] = $row["Email"];
		$_SESSION['add'] = $row["Address"];

		$_SESSION['nickname'] = $row["Nickname"];
		$_SESSION['grp_pwd'] = $row["Grp_pwd"];
		$_SESSION['grp_time'] = $row["Grp_time"];
	}else{
		echo "NO";
	}

	

?>