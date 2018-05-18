<?php
include('User.php');
?>
<html>
    <body>
        <form method="post" action="addUser.php">
            <input type="text" placeholder="Username" name="username">
            <br><br>
            <input type="text" placeholder="First name" name="firstname">
            <br><br>
            <input type="text" placeholder="insertion" name="insertion">
            <br><br>
            <input type="text" placeholder="Last name" name="lastname">
            <br><br>
            <input type="text" placeholder="Telephone" name="telephone">
            <br><br>
            <input type="text" placeholder="Password" name="password">
            <br><br>
            <select name="role">
                <option value="gebruiker">Gebruiker</option>
                <option value="admin">Admin</option>
            </select>
            <br><br>
            <input type="submit" name="add">
        </form>
    </body>
</html>
<?php

    //Simply add new gebruiker
    if(isset($_POST['add']))
    {
        $username_post = $_POST['username'];
        $firstname_post = $_POST['firstname'];
        $insertion_post = $_POST['insertion'];
        $lastname_post = $_POST['lastname'];
        $telephone_post = $_POST['telephone'];
        $password_post = $_POST['password'];
        $role_post = $_POST['role'];

        if($role_post == "admin")
        {
            $role_post = 1;
        }
        else
        {
            $role_post = 0;
        }

        $user = new user();
        $user->username = $username_post;
        $user->first_name = $firstname_post;
        $user->insertion = $insertion_post;
        $user->last_name = $telephone_post;
        $user->telephone = $telephone_post;
        $user->password = $password_post;
        $user->admin = $role_post;
        $user->save();

    }




?>
