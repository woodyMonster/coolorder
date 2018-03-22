<?php 
///////
header('ACCESS-Control-Allow-Origin:*');

require 'dbConn.inc.php';
//
$pic_name = $_POST['pic_name'];
$nickname = $_POST['nickname'];
// $image=$_POST['image'];
$image = $_FILES['file']['name'];

# 檢查檔案是否上傳成功
if ($_FILES['file']['error'] === UPLOAD_ERR_OK){
	// echo '檔案名稱: ' . $_FILES['file']['name'] . '<br/>';
	// echo '檔案類型: ' . $_FILES['file']['type'] . '<br/>';
	// echo '檔案大小: ' . ($_FILES['file']['size'] / 1024) . ' KB<br/>';
	// echo '暫存名稱: ' . $_FILES['file']['tmp_name'] . '<br/>';

	# 檢查檔案是否已經存在
	if (file_exists('upload/' . $_FILES['file']['name'])){
		echo 'existed';
	}else {
		$file = $_FILES['file']['tmp_name'];
		$dest = 'upload/' . $_FILES['file']['name'];

	    # 將檔案移至指定位置
		move_uploaded_file($file, $dest);
		//
		$location = 'upload/'.$image;
		$sql="INSERT INTO albums(Pic_name, Location, Acc_name) VALUES ('$pic_name', '$location', '$nickname')";
		mysqli_query($conn, $sql);
		echo "Successful register !!";
	}

}else {
	echo '錯誤代碼：' . $_FILES['my_file']['error'] . '<br/>';
}


 ?>