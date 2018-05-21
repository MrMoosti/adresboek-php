<?php
// Create connection
$bd = new mysqli("localhost", "root", "", "addressbook");
// Check connection
if ($bd->connect_error) {
    die("Connection failed: " . $bd->connect_error);
}
$error = true;
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
    $sql = "INSERT INTO `contactperson`(`first_name`,
    `insertion`, `last_name`, `business_name`, `work_location`,
    `email`, `telephone_work`, `telephone_private`, `img_filename`)
    VALUES (
    '{$user['results'][0]['name']['first']}', '', '{$user['results'][0]['name']['last']}',
    '{$company}', '{$user['results'][0]['location']['city']}', '{$user['results'][0]['email']}',
    '{$user['results'][0]['phone']}', '{$user['results'][0]['cell']}',
    '{$user['results'][0]['picture']['large']}')";
    if ($bd->query($sql) === TRUE) {
        $error = false;
    } else {
        $error = true;
        echo "<br>An error accourd with query: " . $i . "<br>" . $bd->error;
    }
}
if(!$error) echo "<br>{$_POST["times"]} new records successfully created";
$db->close;
?>
