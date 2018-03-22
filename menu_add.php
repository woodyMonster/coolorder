
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
	<link rel="icon" href="images/breakfast.png" type="image/ico" />
	<meta name = "viewport" content="width=device-width,initial-scale=1">
	<title>Coolorder</title>
	<link rel="stylesheet" href="jquery-mobile/jquery.mobile-1.4.5.min.css">
	<script src="jquery-mobile/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="jquery-mobile/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
</head>

<style>
	@media screen and (max-width: 767px) {
		#main{
			background-color: silver;
		}
	}

	@media screen and (min-width: 768px) {
		#main{
			background-color: pink;
		}
	}

	@media screen and (min-width: 992px) {
		#main{
			background-color: #fff;
		}
	}
</style>

<script>
	$(document).ready(function(){
		$('#add_menu').bind('click', check);
	})

	function check(){
		store = $('#store').val();
		p_name = $('#p_name').val();
		price = $('#price').val();
		if(store == "" || p_name == "" || price == ""){
			alert("請輸入完整資料");
		}else{
			$.ajax({
				type: "POST",
				url: "menu_insert.php",
				data:{
					store: store,
					p_name: p_name,
					price: price
				},
				success: changepage,
				error: function(data){
					alert(data);
				}
			})
		}
	}

	function changepage(data){
		if (data == "ok") {
			alert("新增成功");
			window.location.replace("menu.php");
		}
	}


</script>

<body>
	<div data-role="page" id="page">
		<div data-role = "header" data-position="fixed">
			<h3 style="color:red">新增店家</h3>
		</div>
		<div role="main" class="ui-content" id="main">
			
			<!-- 帳號 -->
			<div data-role="fieldcontain">
				<label for="store">store:</label>
				<input type="text" name="store" id="store" value="" placeholder="輸入店家名稱">
			</div>
			<p id="accountCheck"></p>

			<!-- 商品名稱 -->
			<div data-role="fieldcontain">
				<label for="p_name">product:</label>
				<input type="text" name="p_name" id="p_name" value="" placeholder="輸入商品名稱">
			</div>

			<!-- price -->
			<div data-role="fieldcontain">
				<label for="price">price:</label>
				<input type="text" name="price" id="price" value="" placeholder="輸入商品價格">
			</div>

			<div class="ui-grid-a">
				<div class="ui-block-a">
					<a href="menu.php" data-role="button">取消</a>
				</div>
				<div class="ui-block-b">
					<a href="" data-role="button" rel="external" id="add_menu">新增</a>
				</div>
			</div>

		</div>
	</div>
</body>
</html>
