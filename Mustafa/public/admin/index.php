<link rel="stylesheet" type="text/css" href="Animations.css">
<?php

require_once("../../includes/initialize.php");
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php') ?>

    <h2> <span class="M"> Menu </span> </h2>

<?php echo output_message($message); ?>

    <a href="index.php" class="M">index.php</a>
    <a href="logfile.php" class="M">logfile.php</a>
    <a href="login.php" class="M">login.php</a>
    <a href="logout.php" class="M">logout.php</a>
    <a href="photo_upload.php" class="M">photo_upload.php</a>
    <a href="list_photos.php" class="M">list_photos.php</a>
    <br><br>
    <img src="korbeblokje.png" class="korbe">


    </div>
    <?php include_layout_template('admin_footer.php'); ?>

