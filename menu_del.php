<?php
// db連線
session_start();
if($_SESSION['status'] != "OK"){
	echo '<script>
			alert("必需登入才使用會員功能");
			window.location.replace("http://18tcnr29.000webhostapp.com/coolorder/");
		</script>';
}
// db連線
require 'dbConn.inc.php';

	$id = $_GET['id'];
	$sql = "DELETE FROM menu WHERE ID='". $id ."'";

	if(mysqli_query($conn, $sql)){
		header("Location:menu.php");
	}
		
		

?>