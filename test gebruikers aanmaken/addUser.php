<?php
include ('user.php');
?>
<html>
    <body>
        <form method="post" action="addUser.php">
            <input type="text"value="Username" name="userName">
            <input type="text"value="First name" name="firstName">
            <input type="text"value="insertion" name="insertion">
            <input type="text"value="Last name" name="lastName">
            <input type="text"value="Telephone" name="telephone">
            <input type="text"value="Password" name="password">
            <input type="submit" name="add">
        </form>
    </body>
</html>
<?php
    $username = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $insertion = $_POST['insertion'];
    $lastName = $_POST['lastName'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];

    if (isset($_POST['add'])){
    echo "Test";
    $user = new user();

    $user->username = $_GET;


}
?>
