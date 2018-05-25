<?php
// Create connection
$bd = new mysqli("localhost", "root", "", "addressbook");
// Check connection
if ($bd->connect_error) {
    die("Connection failed: " . $bd->connect_error);
}
$error = true;
$admin = 0;
if(isset($_POST['admin'])) {
    echo "Admin: true";
    $admin = 1;
}
for($i = 0; $i <3; $i++) echo "<br/>";
for ($i = 0; $i < $_POST['times']; $i++)
{
    $json = file_get_contents('https://randomuser.me/api/');
    $user = json_decode($json, true);
    stream_context_set_default(array(
    'ssl'                => array(
    'verify_peer'        => FALSE,
    'verify_peer_name'   => FALSE,
    'allow_self_signed'  => TRUE
    )));
    $json2 = file_get_contents('https://api.namefake.com/');
    $company = json_decode($json2, true)['company'];
    $sql = "INSERT INTO `user` (`first_name`, `last_name`, `email`, `telephone`, `username`, `password`, `admin`, `img_filename`)
    VALUES (
    '{$user['results'][0]['name']['first']}', '{$user['results'][0]['name']['last']}', '{$user['results'][0]['email']}', '{$user['results'][0]['cell']}', '{$user['results'][0]['login']['username']}', '{$user['results'][0]['login']['password']}', {$admin}, '{$user['results'][0]['picture']['large']}')";
    if ($bd->query($sql) === TRUE) {
        $error = false;
    } else {
        $error = true;
        echo "<br>An error accourd with query: " . $i . "<br>" . $bd->error;
    }
}
if(!$error) echo "<br>{$_POST["times"]} new records successfully created";
?>
