<?php
session_start();
if($_SESSION['status'] != "OK"){
	echo '<script>
			alert("必需登入才使用會員功能");
			window.location.replace("http://18tcnr29.000webhostapp.com/coolorder/");
		</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Coolorder</title>
	<link rel="stylesheet" type="text/css" href="jquery-mobile/jquery.mobile-1.4.5.min.css">
	<script src="jquery-mobile/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="jquery-mobile/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
	<link rel="icon" href="images/breakfast.png" type="image/ico" />
	<script>
		$(function () {
			$("#update").bind('click', function(){
			    if(confirm("真的要更新嗎?")){
    				$.ajax({
    					type: "POST",
    					url: "acc_information_update.php",
    					data: {
    						id: $("#acc_id").val(),
    						nickname: $("#nickname").val(),
    						password: $("#password").val(),
    						grp_pwd: $("#grp_pwd").val(),
    						email: $("#email").val(),
    						address: $("#address").val()
    					},
    					success: update,
    					error: function(data){
    						alert("error");
    					}
    				})
			    }
			});
			function update(data) {
				if (data == "OK") {
					alert("更新成功");
					window.location.replace("accback.php");
				}
			}
			
		})
	</script>
</head>
<body>
	<div data-role="page">
		<div data-role="header" data-position="fixed" data-theme="b">
			<h3>帳戶資訊</h3>
		</div>


		
		<div role="main" class="ui-content">
			
			<!-- id  -->
			<?php
				echo '<input type="hidden" id="acc_id" value="'.$_SESSION['id'].'">';
			?>
			

			<!-- 帳號 -->
			<div data-role="fieldcontain">
				<label for="account">account:</label>
				<?php 
				echo '<input type="text" name="account" id="account" value="'.$_SESSION['acc'].'" readonly="readonly">';
				?>
			</div>

			<!-- nickname -->
			<div data-role="fieldcontain">
				<label for="nickname">nickname:</label>
				<?php 
				echo '<input type="text" name="nickname" id="nickname" value="'.$_SESSION['nickname'].'">';
				?>
			</div>

			<!-- 密碼 -->
			<div data-role="fieldcontain">
				<label for="password">password:</label>
				<input type="password" name="password" id="password" value="" placeholder="密碼不得小於8個字">
			</div>

			<!-- 確認密碼 -->
			<div data-role="fieldcontain">
				<label for="repassword">repassword:</label>
				<input type="password" name="repassword" id="repassword" value="" placeholder="密碼需與上列相同">
			</div>


			<!-- 群組密碼 -->
			<div data-role="fieldcontain">
				<label for="grp_pwd">群組密碼:</label>
				<input type="password" name="grp_pwd" id="grp_pwd" value="">
			</div>


			<!-- email -->
			<div data-role="fieldcontain">
				<label for="email">email:</label>
				<?php 
				echo '<input type="text" name="email" id="email" value="'.$_SESSION['email'].'">';
				?>
			</div>

			<!-- 地址 -->
			<div data-role="fieldcontain">
				<label for="address" class="select">address:</label>
				<select name="address" id="address">
					<option value="台北市">台北市</option>
					<option value="台中市">台中市</option>
					<option value="台南市">台南市</option>
				</select>
			</div>

			<div class="ui-grid-a">
				<div class="ui-block-a">
					<a href="accback.php" data-role="button" rel="external">取消</a>
				</div>
				<div class="ui-block-b">
					<a href="#" data-role="button" id="update" rel="external">更新</a>
					 
				</div>
			</div>
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