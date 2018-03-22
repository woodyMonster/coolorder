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

	// $account = "123";
	// $password = "123";
	// $birth = "123";
	// $email = "123";
	// $addr = "123";

	$store = $_POST['store'];
	$p_name = $_POST['p_name'];
	$price = $_POST['price'];
	
	$sql = "INSERT INTO menu(Store_name, Name, Price) VALUES ('$store', '$p_name', '$price')";

	if($store != "" && $p_name != "" && $price != ""){
		if(mysqli_query($conn, $sql)){
			echo "ok";
		}else{
			echo "no";
		}
	}else{
		die();
	}
	

	mysqli_close($conn);

?>