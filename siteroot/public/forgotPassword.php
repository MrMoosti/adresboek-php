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
			$url = "http://localhost/adresboek-php/siteroot/public/resetPassword.php?token=$str&email=$email";

			require_once 'phpmailer/src/PHPMailer.php';
  			require_once("phpmailer/src/SMTP.php");

			$mail = new PHPMailer\PHPMailer\PHPMailer();
			$mail->isSMTP();
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true; //true
			$mail->Username = "addressbook57@gmail.com";
			$mail->Password = "jacco4Mu6cNx";
			$mail->SMTPSecure = "ssl"; // of tls
			$mail->Port = 465; //Poort voor TLS/STARTTLS: 587
			$mail->Subject = "Wachtwoord veranderen";
			$mail->isHTML(true);
			$mail->Body = "<a href='$url'>Verander uw wachtwoord hier</a>";
			$mail->setFrom('addressbook57@gmail.com', 'addressbook');

			//sending email to
			$mail->addAddress($email);

			// send an email
			if ($mail->send()) {
				echo "mail is sent";
			}
			else {
				echo "something wrong happend";
				echo "Mailer error: " . $mail->ErrorInfo;
			}

			$sql = "UPDATE user SET token='$str' WHERE email='$email'";
			$db->query($sql);
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
