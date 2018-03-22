<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/breakfast.png" type="image/ico" />
	<title>Coolorder</title>
	<link rel="stylesheet" type="text/css" href="jquery-mobile/jquery.mobile-1.4.5.min.css">
	<script src="jquery-mobile/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="jquery-mobile/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
	<script>
		$(function(){
			$('#push_all').bind('click', push);
			
		})
		function push(){
			$.ajax({
				type: "POST",
				url: "push.php",
				data:{
					msg: $('#content').val()
				},
				success: show,
				error: function(data){
					alert("error");
				}
			})
		}
		function show(data){
			$('.msg').html(data);
		}
	</script>
</head>
<body>
	<div data-role="page">
		<div data-role="header" data-position="fixed" data-theme="b">
			<h3>推播</h3>
			<a href="#left-panel" data-icon="bars" data-iconpos="notext"></a>
			<a href="#right-panel" data-icon="user" data-iconpos="notext" data-position="right"></a>
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
			<div data-role="fieldcontain">
				<label for="content">推播內容: </label>
				<input type="text" name="content" id="content" value="">
			</div>
			<a href="#" id="push_all" data-role="button">推播</a>
			
			<div class="msg">
				
			</div>
		</div>

	</div>
</body>
</html>