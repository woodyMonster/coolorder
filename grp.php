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

$id = $_SESSION['id'];
$sql = "SELECT * FROM grp WHERE Owner='$id'";	
$result = mysqli_query($conn, $sql);
$num = array();
$price = array();
$totle = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="images/breakfast.png" type="image/ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Coolorder</title>
	<link rel="stylesheet" type="text/css" href="jquery-mobile/jquery.mobile-1.4.5.min.css">
	<script src="jquery-mobile/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="jquery-mobile/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
</head>
<body>
	
	<div data-role="page">

		<div data-role="header" data-position="fixed" data-theme="b">
			<h3>編輯群組</h3>
			<a href="#left-panel" data-icon="bars" data-iconpos="notext" rel="external"></a>
			<a href="grp_edit.php" data-icon="edit" data-position="right" rel="external">編輯</a>
		</div>

		<div data-role="panel" id="left-panel" data-display="overlay">
			<ul data-role="listview" data-inset="true">
				<li data-role="divider">功能列表</li>
				<li data-icon="user"><a href="acc_information.php" rel="external"><img src="images/logo.png" class="ui-li-icon" >帳戶資訊</a></li>
				<li data-icon="plus"><a href="grp.php" rel="external"><img src="images/logo.png" class="ui-li-icon">群組資訊</a></li>
				<li data-icon="edit"><a href="menu.php" rel="external"><img src="images/logo.png" class="ui-li-icon">編輯菜單</a></li>
				<li data-icon="action"><a href="push_all.php" rel="external"><img src="images/logo.png" class="ui-li-icon">推撥訊息</a></li>
				<li data-icon="camera"><a href="albums.php" rel="external"><img src="images/logo.png" class="ui-li-icon">圖片上傳</a></li>
			</ul>
		</div>

		<div data-role="panel" id="right-panel" data-display="overlay" data-position="right">
			<ul data-role="listview" data-inset="true">
				<li data-role="divider" data-theme="a" style="text-align: center;"><b>會員</b>
					<div data-role="fieldcontain">
						<div id="" style="text-align: center;">
							<a id="logout" href="#" data-role="button" data-theme="a" rel="external"><i class="fa fa-sign-in" aria-hidden="true"></i><span style="">登出</span>
							</a>
						</div>							
					</div>
				</li>
			</ul>
		</div>

		<div role="main" class="ui-content">

			<ul data-role="listview" data-inset="true">
				<li data-role="list-divider" data-theme="b">訂單</li>
				<?php
					if (mysqli_num_rows($result)>0) {
						while ($row = mysqli_fetch_assoc($result)) {	
							echo '<li data-icon="false"><a href="">'.$row['Product'].'<span class="ui-li-count">'.$row['Num'].'</span></a></li>';
						array_push($num, $row['Num']);
						array_push($price, $row['Price']);
						}

					}
					for ($i=0; $i < count($num); $i++) { 
						$totle += $num[$i] * $price[$i];
					}
					echo '<h3 style="text-align: right;">總計：' . $totle . ' 元</h3>';
					echo "<br>";
				?>
			</ul>
            <?php
                $del = "'確定要刪除嗎?'";
                echo '<a href="grp_del.php?owner='.$id.'" onClick="return confirm('.$del.')" rel="external" data-role="button">清空資料</a>';
            ?>


		</div>

		<div data-role="footer" data-position="fixed" data-theme="b">
			<div data-role="navbar">
				<ul>
					<li><a href="#">帳戶資訊</a></li>
					<li><a href="#">創建群組</a></li>
					<li><a href="#">編輯菜單</a></li>
					<li><a href="#">推撥訊息</a></li>
				</ul>
			</div>
		</div>

	</div>
</body>
</html>