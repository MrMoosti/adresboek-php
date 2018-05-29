<?php
include 'layouts/index_header.php';
require_once("../includes/initialize.php");
ob_start();
include ('layouts/mail_template.php');
$body_html = ob_get_clean();

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


			$body_html = str_replace("{{email_address}})", $email, $body_html);
			$body_html = str_replace("{{action_url}}", $url, $body_html);
			$body_html = str_replace("{{support_url}}", "http://173.249.26.226/adresboek-php/siteroot/public/", $body_html);

			$mail->Body = $body_html;
			//$mail->Body = "<a href='$url'>Verander uw wachtwoord hier</a>";
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
    <link rel="stylesheet" href="stylesheets/stylesheet.css" type="text/css">
</head>
<body>
<div id="main">
    <h1><span><strong class="bigFont">W</strong></span>achtwoord<span class="bigFont"><strong>V</strong></span>ergeten
    </h1>
    <form action="forgotPassword.php" method="post">

        <input type="text" name="email" placeholder="example@example.com" value=""><br>
        <br>
        <input class="button" type="submit" name="forgotPass" value="Request password">

    </form>
</body>
</html>
<?php include 'layouts/index_footer.php';?>
