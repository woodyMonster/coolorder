<?php 
function send_notification ($tokens, $message){
	$url = 'https://fcm.googleapis.com/fcm/send';
	$fields = array(
	'registration_ids' => $tokens,
	'data' => $message
	);

	$headers = array('Authorization:key = AAAAg8bB6ec:APA91bEi9G2lw6o5nSE1Nendx4E5nKo5IsJwW27OA3EQMQSClxUWF2JZ2ccRq6_x42yW2xIf9-zLYIGBcedY6dl9eHx19U2Da5N8EhGx27KLwufhmPpm7VIR7k_4OsfWT5VqJNNIz5Qh',
	'Content-Type: application/json'
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	$result = curl_exec($ch);

	if ($result === FALSE) die('Curl failed: ' . curl_error($ch));

	curl_close($ch);
	return $result;
}
	
	
	
$con = mysql_connect("localhost","admin","123456");
mysql_select_db("coolorder", $con);
$sql = " Select Token From user_acc";
$result = mysql_query($sql);
$tokens = array();

if(mysql_num_rows($result) > 0 ){
	while ($row = mysql_fetch_assoc($result)) {
		$tokens[] = $row["Token"];
	}
}
mysql_close($con);

$message = array("message" => "$_POST[msg]");
$message_status = send_notification($tokens, $message);

echo $message_status;
 ?>