<?php
session_start();
if($_SESSION['status'] != "OK"){
	echo '<script>
			alert("必需登入才使用會員功能");
			window.location.replace("http://192.168.60.29/coolorder-backend");
		</script>';
}
// db連線
require 'dbConn.inc.php';
$owner = $_GET['owner'];
$sql = "DELETE FROM grp WHERE Owner='$owner'";

if(mysqli_query($conn, $sql)){
	echo '<script>
			alert("刪除成功");
			window.location.replace("grp.php");
		</script>';
};

?>