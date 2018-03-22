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

$store_name = $_GET['store_name'];
$sql = "SELECT * FROM menu WHERE Store_name='". $store_name ."'";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<mta charset="UTF-8">
	<link rel="icon" href="images/breakfast.png" type="image/ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Coolorder</title>
	<link rel="stylesheet" type="text/css" href="jquery-mobile/jquery.mobile-1.4.5.min.css">
	<script src="jquery-mobile/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="jquery-mobile/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
	<script>
		$(function () {
			$("#update").bind('click', function(){
				$.ajax({
					type: "POST",
					url: "menu_update.php",
					data: {
						pro_id:$("#pro_id").val()
					},
					success: update,
					error: function (data) {
						alert("error");
					}

				});	
			});
			
		})

		function update(data) {
			if (data == "OK") {
				alert("ok");
			}else{
				alert("no");
			}
		} 
		

	</script>
</head>
<body>
	<div data-role="page">

		<div data-role="header" data-position="fixed" data-theme="b">
			<h3>編輯菜單</h3>
			<a href="#left-panel" data-icon="bars" data-iconpos="notext" rel="external"></a>
			<a href="menu_add.php" data-icon="plus" rel="external" data-role="button" data-position="right">新增</a>
		</div>

		<div data-role="panel" id="left-panel" data-display="overlay">
			<ul data-role="listview" data-inset="true">
				<li data-role="divider">功能列表</li>
				<li data-icon="user"><a href="acc_information.php" rel="external"><img src="images/logo.png" class="ui-li-icon" >帳戶資訊</a></li>
				<li data-icon="plus"><a href="grp.php" rel="external"><img src="images/logo.png" class="ui-li-icon">群組資訊</a></li>
				<li data-icon="edit"><a href="menu.php" rel="external"><img src="images/logo.png" class="ui-li-icon">編輯菜單</a></li>
				<li data-icon="comment"><a href="push_all.php" rel="external"><img src="images/logo.png" class="ui-li-icon">推撥訊息</a></li>
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
			<?php
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {	
					// echo '<li data-icon="edit"><a href="menu_edit.php?id='.$row['ID'].'"><h3>'.$row['Name'].'</h3><p>'.$row['Addr'].'</p></a><a href="menu_del.php?id='.$row['ID'].'"></a></li>';
					// echo '<input type="hidden" id="id" value="'.$row['ID'].'">
						
							
					// 		<input type="text" name="pro_id" id="pro_id" value="'.$row['Price'].'">

					// 	';
                $del = "'確定要刪除嗎?'";
                $updata = "'確定要更新嗎?'";
					echo '<div class="ui-grid-b">
				<form action="menu_update.php" method="post">
					<div class="ui-block-a">'.$row['Name'].'</div>
					<div class="ui-block-a"><input type="text" name="Price" id="Price" value="'.$row['Price'].'"></div>
					<div class="ui-block-b"><input type="submit" value="更新" rel="external" onClick="return confirm('.$updata.')"></div>
					<div class="ui-block-c"><a href="menu_del.php?id='.$row['ID'].'" onClick="return confirm('.$del.')" class="ui-btn">刪除</a></div>
					<input type="hidden" name="ID" value="'.$row['ID'].'">
				</form>
				</div>';
				}
				
				
			}
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
	<?php mysqli_close($conn);?>
</body>
</html>