<?php
header('ACCESS-Control-Allow-Origin:*');

	$severname = "localhost";
	$username = "id3734781_coolorder";
	$password = "123456";
	$dbname = "id3734781_coolorder";

	
	$conn = mysqli_connect($severname, $username, $password, $dbname);
	
	if(!$conn)
	{
		die("連線失敗 : " . mysqli_connect_error());
	}
	
	mysqli_query($conn, "SET NAMES UTF8");

	// $account = "123";
	// $password = "123";
	// $birth = "123";
	// $email = "123";
	// $addr = "123";

	$account = $_POST['account'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$addr = $_POST['address'];
	$nickname = $_POST['nickname'];

	$selectsql = "SELECT Account FROM registered_data WHERE Account = '" . $account . "'" ;
	
	$result = mysqli_query($conn, $selectsql);
	
	if(mysqli_num_rows($result) == 0){
		$sql = "INSERT INTO registered_data(Account, Password, Email, Address, Nickname)
			VALUES ('$account', '$password', '$email', '$addr', '$nickname')";

		$result = mysqli_query($conn, $sql);
		echo "successful";
	}else{
		echo "已被註冊";
	};
?>