<?php
// db連線
	$severname = "localhost";
	$username = "";
	$password = "";
	$dbname = "";

	
	$conn = mysqli_connect($severname, $username, $password, $dbname);
	
	if(!$conn){
		die("連線失敗 : " . mysqli_connect_error());
	}
	
	mysqli_query($conn, "SET NAMES UTF8");
	
?>
