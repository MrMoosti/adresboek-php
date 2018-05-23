<?php require_once("../includes/initialize.php"); ?>
<?php include 'layouts/index_header.php'; ?>

<?php
if(!$session->is_admin()) {
    redirect_to('index.php');
}
?>

<!-- ON EVERY PAGE -->
<div id="side-panel">
    <nav>
        <ul class="menu">
            <li>
                <a href="gebruikers.php">
                    <div class="sidepanel-button gebruikers-but">
                        <h4>Gebruikers</h4>
                        <i class="fas fa-user fa-2x sidepanel-icons"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="index.php">
                    <div class="sidepanel-button contacten-but">
                        <h4>Contacten</h4>
                        <i class="fas fa-users fa-2x sidepanel-icons"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <div class="sidepanel-button uitloggen-but">
                        <h4>Uitloggen</h4>
                        <i class="fas fa-key fa-2x sidepanel-icons"></i>
                    </div>
                </a>
            </li>
        </ul>

        <a href="#">
            <div id="drop-down">
                <i class="fas fa-angle-down"></i>
            </div>
        </a>

    </nav>
</div>
<!-- ON EVERY PAGE -->

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

    <div id="create-button">
        <a href="?adduser=1"><i class="fas fa-plus"></i></a>
    </div>

    <div class="listNames">
        <?php
        if (isset($_GET['voornaam'])) {
            $searchResult = $_GET['voornaam'];
            $result = User::search($searchResult, "user");
        }
        else {
            $result = User::find_all();
        }
        foreach ($result as $person) {
            echo "<a href='?user_id={$person->id}'> <div id='whole-card'>";
            echo "<div class='section'>";
            echo "<img src=\"{$person->img_filename}\" />";
            echo "<p>{$person->first_name}, {$person->insertion} {$person->last_name}</p>";
            echo "<p>ID: {$person->id}</p>";
            if($person->admin == 0)
            {
                echo "<p class=\"sectionCompany\">Gebruiker</p>";
            }
            else if ($person->admin == 1)
            {
                echo "<p class=\"sectionCompany\">Admin</p>";
            }
            echo "</div><hr />";
            echo "</div></a>";
        }
        if (empty($result)) {
            echo "Er zijn geen resultaten gevonden";
        }
        ?>
    </div>

</section>

<?php

//Simply add new gebruiker
if(isset($_POST['add']))
{

    $firstname_post = $_POST['firstname'];
    $insertion_post = $_POST['insertion'];
    $lastname_post = $_POST['lastname'];
    $email_post = $_POST['email'];
    $telephone_post = $_POST['telephone'];
    $username_post = $_POST['username'];
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
    $user->first_name = $firstname_post;
    $user->insertion = $insertion_post;
    $user->last_name = $lastname_post;
    $user->email = $email_post;
    $user->telephone = $telephone_post;
    $user->username = $username_post;
    $user->password = $password_post;
    $user->admin = $role_post;
    $user->save();

//    $path = $_FILES['fileToUpload']['name'];
//    $ext = pathinfo($path, PATHINFO_EXTENSION);
//    $target_file = $target_dir . $filename . "." . $ext;

    $user->img_filename = upload_image($user->id);
    $user->img_size = getFileSize($user->id);
    $user->img_type = getFileType("images/profile_pictures/" . $user->id . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
    $user->save();

    echo "<script type=\"text/javascript\">location.href = 'gebruikers.php?user_id={$user->id}';</script>";

}
?>

<section id="detail">
    <?php
    if(!isset($_GET['adduser']))
    {
        if (isset($_GET['user_id']))
        {
            $current_user_id = $_GET['user_id'];
            $current_user = User::find_by_id($current_user_id);
            if($current_user->img_filename == null || $current_user->img_filename == "")
            {
                echo "<img src='images/profile_pictures/kim.jpg' alt='profile_pic' >";
            }
            else
            {
                echo "<img src='{$current_user->img_filename}' alt='profile_pic' >";
            }
        }
        else if(isset($_GET['edit_user']))
        {
            $edit_user_id = $_GET['edit_user'];
            $edit_user = User::find_by_id($edit_user_id);
            if($edit_user->img_filename == null || $edit_user->img_filename == "")
            {
                echo "<img src='images/profile_pictures/kim.jpg' alt='profile_pic' >";
            }
            else
            {
                echo "<img src='{$edit_user->img_filename}' alt='profile_pic' >";
            }
        }
    }

    ?>
    <div class="paraSide">
        <?php
        if(isset($_GET['adduser']))
        {
            $var = $_GET['adduser'];
            echo
            "
             <form method=\"post\" action=\"gebruikers.php\" enctype=\"multipart/form-data\">
                <input type='file' id='fileToUpload' name='fileToUpload'>
                <input type=\"text\" required placeholder=\"Voornaam\" name=\"firstname\">
                <input type=\"text\" placeholder=\"Tussenvoegsel\" name=\"insertion\">
                <input type=\"text\" required placeholder=\"Achternaam\" name=\"lastname\">
                <input type=\"email\" required placeholder=\"Email\" name=\"email\">
                <input type=\"text\" required placeholder=\"Telefoon\" name=\"telephone\">
                <input type=\"text\" required placeholder=\"Gebruikersnaam\" name=\"username\">
                <input type=\"password\" required placeholder=\"Wachtwoord\" name=\"password\">
                <select name=\"role\">
                    <option value=\"gebruiker\">Gebruiker</option>
                    <option value=\"admin\">Admin</option>
                </select>
                <br>
                <input type=\"submit\" name=\"add\" value='Toevoegen'>
            </form>
            ";
        }
        else if(!isset($_GET['adduser']))
        {
            if(isset($_GET['user_id']))
            {
                $current_user_id = $_GET['user_id'];
                $current_user = User::find_by_id($current_user_id);
                echo "<p><i class=\"fas fa-address-book\" style=\"color: black\"></i> {$current_user->first_name} {$current_user->insertion} {$current_user->last_name}</p>";
                echo "<p><i class=\"fas fa-envelope\" style=\"color: black\"></i> {$current_user->email}</p>";
                echo "<p><i class=\"fas fa-phone\" style=\"color: black\"></i> {$current_user->telephone}</p>";
                echo "<p><i class=\"fas fa-user\" style=\"color: black\"></i> {$current_user->username}</p>";
                echo "<p><i class=\"fas fa-key\" style=\"color: black\"></i> {$current_user->password}</p>";
                if($current_user->admin == 0)
                {
                    echo "<p><i class=\"fas fa-shield-alt\" style=\"color: black\"></i>Gebruiker</p>";
                }
                else if($current_user->admin == 1)
                {
                    echo "<p><i class=\"fas fa-shield-alt\" style=\"color: black\"></i>Admin</p>";
                }
            }
        }
        if(isset($_POST['edit']))
        {
            $info_edit_user_id = $_GET['edit_user'];
            $info_edit_user = User::find_by_id($info_edit_user_id);

            $firstname_post = $_POST['firstname'];
            $insertion_post = $_POST['insertion'];
            $lastname_post = $_POST['lastname'];
            $email_post = $_POST['email'];
            $telephone_post = $_POST['telephone'];
            $username_post = $_POST['username'];
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

            $info_edit_user->first_name = $firstname_post;
            $info_edit_user->insertion = $insertion_post;
            $info_edit_user->last_name = $lastname_post;
            $info_edit_user->email = $email_post;
            $info_edit_user->telephone = $telephone_post;
            $info_edit_user->username = $username_post;
            $info_edit_user->password = $password_post;
            $info_edit_user->admin = $role_post;
            $info_edit_user->save();

            $info_edit_user->img_filename = upload_image($info_edit_user->id);
            $info_edit_user->img_size = getFileSize($info_edit_user->id);
            $info_edit_user->img_type = getFileType("images/profile_pictures/" . $info_edit_user->id . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
            $info_edit_user->save();

            echo "<script type=\"text/javascript\">location.href = 'gebruikers.php?user_id={$info_edit_user->id}';</script>";
        }
        if(isset($_GET['edit_user']))
        {
            $info_edit_user_id = $_GET['edit_user'];
            $info_edit_user = User::find_by_id($info_edit_user_id);

            echo "<form method=\"post\" action=\"gebruikers.php?edit_user={$info_edit_user_id}\" enctype=\"multipart/form-data\">";
            echo "<input type='file' id='fileToUpload' name='fileToUpload' >";
            echo "<input type=\"text\" required value='{$info_edit_user->first_name}' name=\"firstname\">";
            echo "<input type=\"text\" value='{$info_edit_user->insertion}' name=\"insertion\">";
            echo "<input type=\"text\" required value='{$info_edit_user->last_name}' name=\"lastname\">";
            echo "<input type=\"email\" required value='{$info_edit_user->email}' name=\"email\">";
            echo "<input type=\"text\" required value='{$info_edit_user->telephone}' name=\"telephone\">";
            echo "<input type=\"text\" required value='{$info_edit_user->username}' name=\"username\">";
            echo "<input type=\"password\" required value='{$info_edit_user->password}' name=\"password\">";
            echo "<select name=\"role\">";
            if($info_edit_user->admin == 0)
            {
                echo "<option value=\"gebruiker\">Gebruiker</option>";
                echo "<option value=\"admin\">Admin</option>";
            }
            else
            {
                echo "<option value=\"admin\">Admin</option>";
                echo "<option value=\"gebruiker\">Gebruiker</option>";
            }
            echo "</select>";
            echo "<br>";
            echo "<input type=\"submit\" name=\"edit\" value='Wijzigen'>";
            echo "</form>";

        }
        ?>
    </div>
    <!-- BUTTONS FOR ADMIN -->
    <div class="deleteChange">
        <?php
        if(isset($_GET['edit_user']))
        {
            $edit_user_id = $_GET['edit_user'];
            $edit_user = User::find_by_id($edit_user_id);

            echo "<a href='?edit_user={$edit_user->id}'><i class=\"fas fa-pencil-alt\"></i></a>";

        }
        else if(isset($_GET['edit_user']))
        {
            $person_to_edit = $_GET['edit_user'];
            echo "<a href='?edit_user={$person_to_edit}'><i class=\"fas fa-pencil-alt\"></i></a>";
        }
        else if(isset($_GET['user_id']))
        {
            $person_to_edit = $_GET['user_id'];
            echo "<a href='?edit_user={$person_to_edit}'><i class=\"fas fa-pencil-alt\"></i></a>";
        }
        ?>

        <?php
        if(isset($_GET['remove_user']))
        {
            $remove_user_id = $_GET['remove_user'];
            $remove_user = User::find_by_id($remove_user_id);
            echo delete_image("images/profile_pictures/" . $remove_user->id);


            $remove_user->delete();
            echo "<script type=\"text/javascript\">location.href = 'gebruikers.php';</script>";
        }
        else if(isset($_GET['edit_user']))
        {
            $person_to_remove = $_GET['edit_user'];
            echo "<a href='?remove_user={$person_to_remove}'><i class=\"fas fa-trash\"></i></a>";
        }
        else if(isset($_GET['user_id']))
        {
            $person_to_remove = $_GET['user_id'];
            echo "<a href='?remove_user={$person_to_remove}'><i class=\"fas fa-trash\"></i></a>";
        }
        ?>
    </div>
</section>

<?php include 'layouts/index_footer.php';?>
