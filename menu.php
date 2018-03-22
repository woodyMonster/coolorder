
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

$sql = "SELECT DISTINCT Store_name FROM menu ORDER BY `ID` ASC ";	
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
				<li data-icon="action"><a href="push_all.php" rel="external"><img src="images/logo.png" class="ui-li-icon">推撥訊息</a></li>	
				<li data-icon="camera"><a href="albums.php" rel="external"><img src="images/logo.png" class="ui-li-icon">圖片上傳</a></li>
			</ul>
		</div>


		<div role="main" class="ui-content">

			<ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Search...">
				<li data-role="list-divider" data-theme="b">店家列表</li>
				<?php
				if (mysqli_num_rows($result)>0) {
					while ($row = mysqli_fetch_assoc($result)) {	
						echo '<li data-icon="false"><a href="menu_edit.php?store_name='.$row['Store_name'].'"><h3>'.$row['Store_name'].'</h3><p>'.$row['Addr'].'</p></a></li>';
					}
				}
				?>
			</ul>

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