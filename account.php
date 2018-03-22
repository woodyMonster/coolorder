<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name = "viewport" content="width=device-width,initial-scale=1">
	<title>Coolorder</title>
	<link rel="icon" href="images/breakfast.png" type="image/ico" />
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

		// 條件判讀
		var accountflag = false;
		var passwordflag = false;
		var repasswordflag = false;

		// 帳號不得小於8個字
		$("#account").bind("input propertychange", function(){
			if($(this).val().length < 8){
				$(this).css("background-color", "red");
				accountflag = false;
			}else{
				$(this).css("background-color", "white");
				accountflag = true;
			}

			if(accountflag == true){
				$.ajax({
					type:"POST",
					url:"accountCheck.php",
					data:{
						account:$("#account").val()
					},
					success:check,
					error:function(){
						alert("error");
					}
				});
			}
		});
		function check(data){
			if(data == "OK"){
					$("#accountCheck").html("此帳號可以註冊");
					$("#accountCheck").css("background-color", "green");
			}
			if(data == "NO"){
				$("#accountCheck").html("此帳號已註冊");
				$("#accountCheck").css("background-color", "red");
			}
		}

		// 密碼不得小於8個字
		$("#password").bind("input propertychange", function(){
			if($(this).val().length < 8){
				$(this).css("background-color", "red");
				passwordflag = false;
			}else{
				$(this).css("background-color", "white");
				passwordflag = true;
			}
		});

		// 確認密碼
		$("#repassword").bind("input propertychange", function(){
			var password = $("#password").val();
			if($(this).val() != password){
				$(this).css("background-color", "red");
				repasswordflag = false;
			}else{
				$(this).css("background-color", "white");
				repasswordflag = true;
			}
		});

		// 群組密碼
		$("#grp_pwd").bind("input propertychange", function(){
			if($(this).val().length < 6){
				$(this).css("background-color", "red");
				passwordflag = false;
			}else{
				$(this).css("background-color", "white");
				passwordflag = true;
			}
		});

		// 註冊
		$("#register").bind("click", function(){
			if(accountflag == true && passwordflag == true && repasswordflag == true){
				$.ajax({
					type:"POST",
					url:"register.php",
					data:{
						nickname: $("#nickname").val(),
						account: $("#account").val(),
						password: $("#password").val(),
						email: $("#email").val(),
						address: $("#address").val(),
						g_pwd: $("#grp_pwd").val()
					},
					success:show,
					error:function(){
						alert("註冊error1");
					}
				});
			}else{
				alert("註冊資料請填寫完整");
			}
		});
		function show(data){
			if(data == "successful"){
				alert("註冊成功!!!");
				window.location.replace("http://18tcnr29.000webhostapp.com/coolorder/");
			}else{
				alert("吃屎");
			}
			
		}
	})
</script>

<body>
	<div data-role="page" id="page">
		<div data-role = "header" data-position="fixed">
			<h3 style="color:red">會員註冊</h3>
		</div>
		<div role="main" class="ui-content" id="main">

			<!-- 暱稱 -->
			<div data-role="fieldcontain">
				<label for="nickname">暱稱:</label>
				<input type="text" name="nickname" id="nickname" value="">
			</div>			

			<!-- 帳號 -->
			<div data-role="fieldcontain">
				<label for="account">account:</label>
				<input type="text" name="account" id="account" value="" placeholder="帳號不得小於8個字">
			</div>
			<p id="accountCheck"></p>

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

			<!-- 密碼 -->
			<div data-role="fieldcontain">
				<label for="grp_pwd" style="color: red">群組密碼:</label>
				<input type="password" name="grp_pwd" id="grp_pwd" value="" placeholder="群組密碼不得小於6個字">
			</div>

			<!-- email -->
			<div data-role="fieldcontain">
				<label for="email">email:</label>
				<input type="text" name="email" id="email" value="">
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
					<a href="index.html" data-role="button" rel="external">取消</a>
				</div>
				<div class="ui-block-b">
					<a href="" data-role="button" id="register">註冊</a>
				</div>
			</div>

		</div>
	</div>
</body>
</html>
