<?php

require_once("../includes/Initialize.php");

$message = "";

if($session->is_logged_in())
{
	redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if(isset($_POST['submit'])) // For has been submitted.
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);


	// Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);

	if($found_user)
	{
		$session->login($found_user);
		log_action('Login', "{$found_user->username} logged in.");
		redirect_to('index.php');
	}
	else
	{
		// Username/password combo was not found in the database.
		$message = "Username/password combination incorrect.";
	}

}
else // Form has not been submitted.
{
	$username = "";
	$password = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css">
</head>

<body>
<div id="container">
    <div id="main">
        <h1><span><strong class="bigFont">O</strong></span>nline<span class="bigFont"><strong>A</strong></span>dresboek
        </h1>
        <form action="login.php" method="post">

            <input type="text" name="username" placeholder="example@example.com" value="<?php echo htmlentities($username); ?>"><br>
            <br>
            <input type="password" name="password" placeholder="*******" value="<?php echo htmlentities($password); ?>"><br>
            <br>
            <input class="button" type="submit" name="submit" value="LOGIN">

        </form>
        <?php echo output_message($message); ?>
        <div id="footer">
            <a class="password" href="forgotpassword.php">
                <p>Wachtwoord Vergeten?</p>
            </a>
        </div>
    </div>

</div>

</body>

</html>
