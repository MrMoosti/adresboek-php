<?php
include('User.php');
?>

<?php
$con=mysqli_connect("localhost","root","","addressbook");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM user");

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Username</th>
<th>First Name</th>
<th>Insertion</th>
<th>Last Name</th>
<th>Telephone</th>
<th>Password</th>
<th>Role</th>
<th>Filename-IMG</th>
<th>IMG-Size</th>
<th>IMG-TYPE</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['insertion'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['telephone'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['admin'] . "</td>";
    echo "<td>" . $row['img_filename'] . "</td>";
    echo "<td>" . $row['img_size'] . "</td>";
    echo "<td>" . $row['img_type'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);

?>
<html>
<body>
<form method="post" action="deleteUser.php">
    <br>
    <input type="text" placeholder="ID to delete" name="id">
    <input type="submit" name="delete" value="DELETE">
</form>
</body>
</html>
<?php

if(isset($_POST['delete']))
{
    $user_id = $_POST['id'];

    $user = new user();
    $user->id = $user_id;
    if($user->delete() == true)
    {
        echo "You deleted id: " . $user_id;
    }
}

?>

