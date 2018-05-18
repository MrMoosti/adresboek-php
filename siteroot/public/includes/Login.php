<?php

session_start();
include("../Layouts/LoginPage.html");


if (isset($_POST['submit'])){
    include 'config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username || empty($password))){
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE username= '$username'";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1){
            header("Location: ../../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){

                $hashedpwdCheck = password_verify($password, $row['password']);
                if ($hashedpwdCheck == false){
                    header("Location: ../index.php?login=empty");
                    exit();
                } elseif ($hashedpwdCheck == true){
                    //log in the user here
                    $_SESSION['u_id'] = $row['ID'];
                    $_SESSION['u_first'] = $row['first_name'];
                    $_SESSION['u_last'] = $row['last_name'];
                    $_SESSION['u_uid'] = $row['username'];
                    header("Location: ../index.php?login=succes");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../Layouts/LoginPage.html?login=dut_niet");
    exit();
}


