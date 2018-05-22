<?php include('includes/Contactpersoon.php'); ?>
<?php include 'layouts/index_header.php'; ?>
<?php require_once('includes/ContactPersoon.php'); ?>
<?php include ('includes/User.php');?>

<!-- THIS SECTION CHANGES DEPENDEND ON SQL-QUERY -->
<section id="content">
    <div class="search">
        <form class="searchForm" method="get" id="searchForm">
            <input type="text" name="voornaam" placeholder="Zoeken"/>
            <a href="#" onclick="document.getElementById('searchForm').submit()" rel="search">
                <i class="fa fa-search"></i>
            </a>
        </form>
    </div>
    <div class="sortNames">
        <ul type="none">
            <li class="voornaam-sorteren">
                <a href="#">
                    voornaam
                    <i class="fa fa-caret-down"></i>
                </a>
            </li>
            <li class="achternaam-sorteren">
                <a href="#">
                    achternaam
                    <i class="fa fa-caret-down"></i>
                </a>
            </li>
            <li class="plaats-sorteren">
                <a href="#">
                    plaats
                    <i class="fa fa-caret-down"></i>
                </a>
            </li>
            <li class="bedrijfsnaam-sorteren">
                <a href="#">
                    bedrijfsnaam
                    <i class="fa fa-caret-down"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="listNames">
        <?php
        if (isset($_GET['voornaam'])) {
            $searchResult = $_GET['voornaam'];
            $result = ContactPersoon::search($searchResult, "contactperson");
        }
        else {
            $result = ContactPersoon::find_all();
        }
        foreach ($result as $person) {
            echo "<div class=\"section\">";
            echo "<img src=\"{$person->img_filename}\" />";
            echo "<p>{$person->first_name}, {$person->last_name}</p>";
            echo "<p>{$person->zipcode}, {$person->business_place}</p>";
            echo "<p class=\"sectionCompany\">{$person->business_name}</p>";
            echo "</div><hr />";
        }
        if (empty($result)) {
            echo "Er zijn geen resultaten gevonden";
        }
        ?>
    </div>

</section>


<form method="post" action="gebruikers.php">
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

<section id="detail">
    <img src="images/profile_pictures/kim.jpg">
    <h2>Kim, Jung Un</h2>
    <div class="paraSide">
        <p><i class="fas fa-address-book" style="color: black"></i> Kim Jung Un</p>
        <p><i class="fas fa-building" style="color: black"></i> Microsoft</p>
        <p><i class="fas fa-envelope" style="color: black"></i> kimjungun@gmail.com</p>
        <p><i class="fas fa-phone" style="color: black"></i> +31 1238624</p>
        <p><i class="fas fa-phone" style="color: black"></i> 0315-18793712</p>
        <p><i class="fas fa-building" style="color: black"></i> Ulft</p>
    </div>
    <div class="deleteChange">
        <i class="fas fa-pencil-alt"></i>
        <i class="fas fa-trash"></i>
        <form method="post" action="gebruikers.php">
            <input type="submit" name="delete" value="Delete">
        </form>
    </div>
</section>

<?php include 'layouts/index_footer.php';?>
