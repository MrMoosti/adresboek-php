<?php
require_once("../includes/initialize.php");
if (isset($_GET['email']) && isset($_GET['token'])) {
	$email = $db->escape_value($_GET['email']);
	$token = $db->escape_value($_GET['token']);

	$sql = "SELECT id FROM user WHERE email='$email' AND token='$token'";
	$result = $db->query($sql);
	if ($db->num_rows($result) > 0) {
		$str = "1234567890qwertyuiopasdfghjklzxcvbnm";
		$str = str_shuffle($str);
		$str = substr($str, 0, 6);
		$password = $str;

		$sql = "UPDATE user SET password='$password' WHERE email='$email'";
		$db->query($sql);
		echo "your new password $password";
	}
	else { 
		echo "Please check your link";
	}
}
else {
	header("Location: login.php");
	exit();
}

?>