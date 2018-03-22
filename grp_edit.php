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

	$sql = "SELECT DISTINCT Store_name FROM menu ORDER BY ID ASC";

	$result = mysqli_query($conn, $sql);


	
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
	<script>
		$(function () {
			$("#submit").bind('click', function(){
				$.ajax({
					type: "POST",
					url: "grp_create.php",
					data: {
						id: $("#owner_id").val(),
						store: $("#store").val(),
						status: $("#status").val()
					},
					success: create,
					error: function(data){
						alert("error");
					}
				})	
			});
			function create(data) {
				if (data == "ok") {
					alert("編輯成功");
					window.location.replace("grp.php");
				}
			}
			
		})
	</script>
</head>
<body>
	<div data-role="page">
		<div data-role="header" data-position="fixed" data-theme="b">
			<h3>創建群組</h3>
			<a href="#left-panel" data-icon="bars" data-iconpos="notext" rel="external"></a>
			<a href="#right-panel" data-icon="user" data-iconpos="notext" data-position="right" rel="external"></a>
		</div>

		<div data-role="panel" id="left-panel" data-display="overlay">
			<ul data-role="listview" data-inset="true">
				<li data-role="divider">功能列表</li>
				<li data-icon="user"><a href="acc_information.php" rel="external"><img src="images/logo.png" class="ui-li-icon" >帳戶資訊</a></li>
				<li data-icon="plus"><a href="grp.php" rel="external"><img src="images/logo.png" class="ui-li-icon">群組資訊</a></li>
				<li data-icon="edit"><a href="menu.php" rel="external"><img src="images/logo.png" class="ui-li-icon">編輯菜單</a></li>
				<li data-icon="action"><a href="push_all.php" rel="external"><img src="images/logo.png" class="ui-li-icon">推撥訊息</a></li>			
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
			
			<!-- 店家 -->
			<div data-role="fieldcontain">
				<label for="store" class="select">店家:</label>
				<select name="store" id="store">
					<?php
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {	
							echo '<option value="'.$row['Store_name'].'">'.$row['Store_name'].'</option>';
						}
					}

					?>
				</select>
			</div>

			<div data-role="fieldcontain">
			    <label for="status">狀態:</label>
			    <select name="status" id="status" data-role="slider">
			      <option value="0">開</option>
			      <option value="1">關 </option>
			    </select>
			</div>



			<!-- owner -->
			<?php
				echo '<input type="hidden" id="owner_id" value="'.$_SESSION['id'].'">';
			?>

			
			
			
			<div class="ui-grid-a">
				<div class="ui-block-a"><a href="grp.php" rel="external" data-role="button">取消</a></div>
				<div class="ui-block-b"><a href="" id="submit" rel="external" data-role="button">送出</a></div>
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