<?php
        require_once("../includes/initialize.php");
        if(!$session->is_logged_in())
        {
            redirect_to("login.php");
        }
        include 'layouts/index_header.php'; ?>

    <!-- ON EVERY PAGE -->
    <div id="side-panel">
        <nav>
            <ul class="menu">
                <?php
                    if($session->is_admin())
                    {
                        echo "<li>";
                        echo "<a href=\"gebruikers.php\">";
                        echo "<div class=\"sidepanel-button gebruikers-but\">";
                        echo "<h4>Gebruikers</h4>";
                        echo "<i class=\"fas fa-user fa-2x sidepanel-icons\"></i>";
                        echo "</div>";
                        echo "</a>";
                        echo "</li>";
                    }
                ?>
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
            <input type="text" name="search" placeholder="Zoeken" />
            <a href="#" onclick="document.getElementById('searchForm').submit()" rel="search">
                <i class="fa fa-search"></i>
            </a>
        </form>
    </div>
    <div class="sortNames">
        <ul type="none">
            <li class="voornaam-sorteren">
                <form id="sortVoornaam">
                    <a href="#">
                        voornaam
                        <i class="fa fa-caret-down"></i>
                    </a>
                </form>
            </li>
            <li class="achternaam-sorteren">
                <form id="sortAchternaam">
                    <a href="#">
                        achternaam
                        <i class="fa fa-caret-down"></i>
                    </a>
                </form>
            </li>
            <li class="plaats-sorteren">
                <form id="workLocation">
                    <a href="#">
                        plaats
                        <i class="fa fa-caret-down"></i>
                    </a>
                </form>
            </li>
            <li class="bedrijfsnaam-sorteren">
                <form id="businessName">
                    <a href="#">
                        bedrijfsnaam
                        <i class="fa fa-caret-down"></i>
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <div id="create-button">
        <a href="?adduser=1"><i class="fas fa-plus"></i></a>
    </div>

    <div class="listNames">
        <div id="load_data"></div>
        <div id="load_data_message"></div>
        <script src="js/ContactPersonList.js"></script>
    </div>
</section>
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
    $business_name_post = $_POST['business_name'];
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
    $user->business_name = $business_name_post;
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
             <form method=\"post\" action=\"index.php\" enctype=\"multipart/form-data\">
                <input type='file' id='fileToUpload' name='fileToUpload'>
                <input type=\"text\" required placeholder=\"Voornaam\" name=\"firstname\">
                <input type=\"text\" placeholder=\"Tussenvoegsel\" name=\"insertion\">
                <input type=\"text\" required placeholder=\"Achternaam\" name=\"lastname\">
                <input type=\"email\" required placeholder=\"Email\" name=\"email\">
                
                <input type=\"text\" required placeholder=\"Telefoon prive\" name=\"telephone_private\">
                <input type=\"text\" required placeholder=\"Telefoon werk\" name=\"telephone_work\">
                <input type=\"text\" required placeholder=\"Werkplek\" name=\"work_location\">
                
                <input type=\"text\" required placeholder=\"Bedrijfs naam\" name=\"business_name\">
                <input type=\"password\" required placeholder=\"Wachtwoord\" name=\"password\">
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
                echo "<p><i class=\"fas fa-user\" style=\"color: black\"></i> {$current_user->business_name}</p>";
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

            $telephone_private_post = $_POST['telephone_private'];
            $telephone_work_post = $_POST['telephone_work'];
            $business_name_post = $_POST['business_name'];
            $work_location_post = $_POST['work_location'];



            $password_post = $_POST['password'];
            $role_post = $_POST['role'];
            //$info_picture_uploaded = $_POST['fileToUpload'];

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

            $info_edit_user->telephone_private = $telephone_private;
            $info_edit_user->telephone_work = $telephone_work;
            $info_edit_user->business_name = $business_name;

            $info_edit_user->password = $password_post;
            $info_edit_user->admin = $role_post;
            $info_edit_user->save();

            if ($_FILES['fileToUpload'])
            {
                if(!empty($_FILES['fileToUpload']['name']))
                {
                    $info_edit_user->img_filename = upload_image($info_edit_user->id);
                    $info_edit_user->img_size = getFileSize($info_edit_user->id);
                    $info_edit_user->img_type = getFileType("images/profile_pictures/" . $info_edit_user->id . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
                    $info_edit_user->save();
                }
            }

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
            echo "<input type=\"text\" required value='{$info_edit_user->business_name}' name=\"business_name\">";
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

<?php include 'layouts/index_footer.php';?>