<?php
require_once("../includes/initialize.php");

	if (isset($_POST['forgotPass'])) {
		$email = $db->escape_value($_POST['email']);
		$sql = "SELECT id FROM user WHERE email='$email'";
		$result = $db->query($sql);

		if ($db->num_rows($result) > 0) {
			$str = "1234567890qwertyuiopasdfghjklzxcvbnm";
			$str = str_shuffle($str);
			$str = substr($str, 0, 10);
			$url = "http://173.249.26.226/adresboek-php/siteroot/public/resetPassword.php?token=$str&email=$email";

			mail($email, "Reset Password", "To reset your password, please visit this: $url", "From: your mom");
			$sql = "UPDATE user SET token='$str' WHERE email='$email'";
			$db->query($sql);

			echo " please check your email";
		}
		else {
			echo "ERROR";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="forgotPassword.php" method="post">
		<input type="text" name="email" placeholder="email"> <br>
		<input type="submit" name="forgotPass" value="Request Password">
	</form>
</body>
</html>