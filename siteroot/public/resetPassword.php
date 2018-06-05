<?php
$error = "";

require_once("../includes/initialize.php");

?>

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
            <input required type="password" name="Password_1">
            <br>
            <h2><span><strong class="bigFont">B</strong></span>evestig<span class="bigFont"><strong>W</strong></span>achtwoord
            </h2>
            <input required type="password" name="Password_2"><br>
            <br>
            <button class="button" type="submit">Wachtwoord veranderen</button>
        </form>
    </div>
		<?php echo output_message($error); ?>

</div>

</body>
</html>

<?php

if (isset($_GET['email']) && isset($_GET['token']) && isset($_POST['Password_1']) && isset($_POST['Password_2']))
{
	$email = $db->escape_value($_GET['email']);
	$token = $db->escape_value($_GET['token']);
	$password_1 = $db->escape_value($_POST['Password_1']);
	$password_2 = $db->escape_value($_POST['Password_2']);

	if($password_1 == $password_2)
	{
		$sql = "SELECT id FROM user WHERE email='$email' AND token='$token'";
		$result = $db->query($sql);
		if ($db->num_rows($result) > 0) {

			$sql = "UPDATE user SET password='$password_1' WHERE email='$email'";
			$db->query($sql);
			redirect_to('index.php');
			$error = "Je wachtwoord is veranderd. ($password_1)";
	}
	else
	{
		$error = "Wachtwoorden zijn niet hetzelfde.";
	}
}
}

?>
