<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Reset Wachtwoord</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<body>
<div id="container-reset">
    <header>
        <h2>OnlineAdresboek</h2>
    </header>
    <div id="main-reset">
        <form action="" method="post">
          <h2><span><strong class="bigFont">N</strong></span>ieuw<span class="bigFont"><strong>W</strong></span>achtwoord
          </h2>
            <input type="password" name="Password">
            <br>
            <h2><span><strong class="bigFont">B</strong></span>evestig<span class="bigFont"><strong>W</strong></span>achtwoord
            </h2>
            <input type="password" name="Password"><br>
            <br>
            <button class="button" type="submit">Reset Wachtwoord</button>
        </form>
    </div>

</div>

</body>
</html>

<?php
require_once("../includes/initialize.php");
if (isset($_GET['email']) && isset($_GET['token']) && isset($_POST['submit'])) {
	$email = $db->escape_value($_GET['email']);
	$token = $db->escape_value($_GET['token']);

	$sql = "SELECT id FROM user WHERE email='$email' AND token='$token'";
	$result = $db->query($sql);
	if ($db->num_rows($result) > 0) {
		$password = $db->escape_value($_POST['']);

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
