<?php
// db連線
require 'dbConn.inc.php';

	$account = $_POST['account'];
	// $account = "123";

	$sql = "SELECT Account FROM registered_data WHERE Account = " . $account ;
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		echo "NO";
	}else{
		echo "OK";
	};
?>