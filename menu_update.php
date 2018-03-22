<?php
session_start();
if($_SESSION['status'] != "OK"){
	echo '<script>
			alert("必需登入才使用會員功能");
			window.location.replace("http://18tcnr29.000webhostapp.com/coolorder/");
		</script>';
}
// db連線
require 'dbConn.inc.php';

	$Price = $_POST['Price'];
	$id = $_POST['ID'];

	$sql = "UPDATE menu SET Price='$Price' WHERE ID='$id'";

	if(mysqli_query($conn, $sql)){
		header("Location: menu.php");
	}else{
		echo "no";
	}


?>