<?php

include("ResetWachtwoord.html");


if (isset($_POST['Password'])) {
    include ('config.php');
    $password = $_POST['Password'];
    $sql = mysqli_query("UPDATE user SET password= '$password'");


}
//elseif (empty($_POST['Password'])) {
//    echo "Vul een nieuw wachtwoord in";
//}

if (empty($password)){
    echo " ";

}
