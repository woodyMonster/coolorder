<?php

	require 'dbConn.inc.php';

	$sql = "SELECT * FROM albums ORDER BY `ID` DESC";
	$result = mysqli_query($conn, $sql);


?>
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
	<style type="text/css">
		@media screen and (max-width: 425px) and (min-width: 321px) {
			.w{
				width: 90%;
				margin: auto;
			}
		}
		@media screen and (max-width: 768px) and (min-width: 426px) {
			.w{
				width: 65%;
				margin: auto;
			}
		}
		@media screen and (max-width: 1440px) and (min-width: 769px) {
			.w{
				width: 50%;
				margin: auto;
			}
		}
		@media screen and (min-width: 1441px) {
			.w{
				width: 35%;
				margin: auto;
			}
		}
		#albums {	    
		  	text-align : center;
		}

		#albums img {
		  	vertical-align : middle;
		  	margin-bottom: 15px;
		}
		/*#albums h3{
			display:inline-block; 
		}*/
	</style>
	<script type="text/javascript">

		$(function(){
			$("#register").bind("click",checkData);
		});

		function checkData(){
			if ($("#pic_name").val()!="") {
				// var file_data=$("#upload").prop('files')[0];   
    // 			var form_data = new FormData();                  
    // 			form_data.append('file', file_data);
    		//	alert($('#upload')[0].files[0]);
				var fd = new FormData(this);
				fd.append('pic_name', $('#pic_name').val());
				fd.append('nickname', $('#nickname').val());
				fd.append('file', $('#upload')[0].files[0]);
				$.ajax({
					type:"POST",
					url:"albums_upload.php",
					data:fd,
					cache: false,
    				contentType: false,
    				processData: false,
					success: function(data){
						if (data == "existed") {
							alert("檔案已存在");
						}else{
							alert("上傳成功");
							location.reload();
							window.location.replace("albums.php");
						}
						
					},
					beforeSend: function (){
				// 		$("#loading").show();
				        // $('body').addClass('ui-loading');
			        	// $.mobile.showPageLoadingMsg("b","圖片上傳中",false);
			        	showLoader();
					},
					complete: function(){
				// 		$("#loading").hide();
				        // $('body').removeClass('ui-loading');
				        // $.mobile.hidePageLoadingMsg();
				        hideLoader();
					},
					error:function(){
						alert("connect error!!");
					},
				});
			}else {
				alert('error');
			}
		}
		function showLoader() {
			$.mobile.loading('show', {
				text: '圖片上傳中',
				textVisible: true,
				theme: 'a',
				textonly: false,
				html: '<img src="images/tenor.gif" alt="" style="display:block; margin:auto;">'
			});
		}
		function hideLoader() {  
    		//隐藏加载器  
    		$.mobile.loading('hide');  
		} 
	</script>
</head>
<body>

	<div data-role="page" data-theme="b" id="p01">
		<div data-role="header" data-position="fixed">
			<h3>相簿</h3>
			<a href="#left-panel" data-icon="bars" data-iconpos="notext"></a>
			<a href="#right-panel" data-icon="user" data-iconpos="notext" data-position="right"></a>
		</div>

		<div data-role="panel" id="left-panel" data-display="overlay">
			<ul data-role="listview" data-inset="true">
				<li data-role="divider">功能列表</li>
				<li data-icon="user"><a href="acc_information.php" rel="external"><img src="images/logo.png" class="ui-li-icon">帳戶資訊</a></li>
				<li data-icon="plus"><a href="grp.php" rel="external"><img src="images/logo.png" class="ui-li-icon">群組資訊</a></li>
				<li data-icon="edit"><a href="menu.php" rel="external"><img src="images/logo.png" class="ui-li-icon">編輯菜單</a></li>
				<li data-icon="comment"><a href="push_all.php" rel="external"><img src="images/logo.png" class="ui-li-icon">推撥訊息</a></li>
				<li data-icon="camera"><a href="albums.php" rel="external"><img src="images/logo.png" class="ui-li-icon">上傳圖片</a></li>		
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
			<div data-role="fieldcontain" class="w">
				<p><label>圖片名稱<input type="text" name="pic_name" id="pic_name"></label></p>
				<p><label>Upload<input type="file" name="upload" id="upload"></label></p>
				<?php
					echo '<input type="hidden" value="'.$_SESSION['nickname'].'" id="nickname">';
				?>
			</div>
			<div class="ui-grid-a w">
				<div class="ui-block-a"><a href="#" id="register" data-role="button" data-icon="check" rel="external">Register</a></div>
				<div class="ui-block-b"><a href="accback.php" id="cancel" data-role="button" data-icon="delete">Cancel</a></div>
			</div>
			
			<div id="loading" style="display: none; text-align : center;">
				<img src="images/tenor.gif" alt="">
				圖片上傳中請稍後....
			</div>

			<div id="albums" style="margin-top: 15px">
				<?php
					if(mysqli_num_rows($result) > 0){
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<img src="'.$row['Location'].'" width="24%" alt="">';
						}
					}

				?>
			</div>

		</div>
<!-- 		<div data-role="footer" data-position="fixed">
			<h1>This is Footer</h1>
		</div> -->
	</div>

	<div data-role="page" data-theme="b" id="p02">
		<div role="main" class="ui-content">
			<a href="#" data-rel="back" data-role="button" data-icon="back">Back</a>
		</div>
	</div>

</body>
</html>
