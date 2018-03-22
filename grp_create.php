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

	$store = $_POST['store'];
	$status = $_POST['status'];
	$id = $_POST['id'];

	$sql = "UPDATE registered_data SET Grp_store = '$store', Grp_time = '$status' WHERE ID = $id";

	if(mysqli_query($conn, $sql)){
		echo "ok";
	}

?>