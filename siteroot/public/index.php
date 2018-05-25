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
    <?php
    if(!isset($_GET['adduser']))
    {
        if (isset($_GET['user_id']))
        {
            $current_user_id = $_GET['user_id'];
            $current_user = Contactpersoon::find_by_id($current_user_id);
            if($current_user->img_filename == null || $current_user->img_filename == "" || $current_user->img_size == 0 || $current_user->img_type == "")
            {
                echo "<img src='images/profile_pictures/Contactpersonen/default.jpg' alt='profile_pic' >";
            }
            else
            {
                echo "<img src='{$current_user->img_filename}' alt='profile_pic' >";
            }
        }
        else if(isset($_GET['edit_user']))
        {
            $edit_user_id = $_GET['edit_user'];
            $edit_user = Contactpersoon::find_by_id($edit_user_id);
            if($edit_user->img_filename == null || $edit_user->img_filename == "")
            {
                echo "<img src='images/profile_pictures/Contactpersonen/default.jpg' alt='profile_pic' >";
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
            echo "<form method=\"post\" action=\"index.php\" enctype=\"multipart/form-data\">";
            echo "<input type='file' id='fileToUpload' name='fileToUpload' >";
            echo "<input type=\"text\" required placeholder=\"Voornaam\" name=\"firstname\">";
            echo "<input type=\"text\" placeholder=\"Tussenvoegsel\" name=\"insertion\">";
            echo "<input type=\"text\" required placeholder=\"Achternaam\" name=\"lastname\">";
            echo "<input type=\"text\" required placeholder=\"Bedrijfsnaam\" name=\"businessname\">";
            echo "<input type=\"email\" required placeholder=\"Email\" name=\"email\">";
            echo "<input type=\"text\" required placeholder=\"Mobiele nummer\" name=\"telephone_private\">";
            echo "<input type=\"text\" required placeholder=\"Werk nummer\" name=\"telephone_work\">";
            echo "<input type=\"text\" required placeholder=\"Werkplaats\" name=\"work_location\">";
            echo "<br>";
            echo "<input type=\"submit\" name=\"add\" value='Toevoegen'>";
            echo "</form>";
        }
        else if(!isset($_GET['adduser']))
        {
            if(isset($_GET['user_id']))
            {
                $current_user_id = $_GET['user_id'];
                $current_user = Contactpersoon::find_by_id($current_user_id);
                echo "<p><i class=\"fas fa-address-book\" style=\"color: black\"></i> {$current_user->first_name} {$current_user->insertion} {$current_user->last_name}</p>";
                echo "<p><i class=\"fas fa-building\" style=\"color: black\"></i> {$current_user->business_name}</p>";
                echo "<p><i class=\"fas fa-envelope\" style=\"color: black\"></i> {$current_user->email}</p>";
                echo "<p><i class=\"fas fa-phone\" style=\"color: black\"></i> {$current_user->telephone_private}</p>";
                echo "<p><i class=\"fas fa-phone\" style=\"color: black\"></i> {$current_user->telephone_work}</p>";
                echo "<p><i class=\"fas fa-building\" style=\"color: black\"></i> {$current_user->work_location}</p>";
            }
        }
        if(isset($_POST['edit']))
        {
            $info_edit_user_id = $_GET['edit_user'];
            $info_edit_user = Contactpersoon::find_by_id($info_edit_user_id);

            $firstname_post = $_POST['firstname'];
            $insertion_post = $_POST['insertion'];
            $lastname_post = $_POST['lastname'];
            $business_post = $_POST['businessname'];
            $email_post = $_POST['email'];
            $telephoneprivate_post = $_POST['telephone_private'];
            $telephonework_post = $_POST['telephone_work'];
            $worklocation_post = $_POST['work_location'];

            $info_edit_user->first_name = $firstname_post;
            $info_edit_user->insertion = $insertion_post;
            $info_edit_user->last_name = $lastname_post;
            $info_edit_user->business_name = $business_post;
            $info_edit_user->email = $email_post;
            $info_edit_user->telephone_private = $telephoneprivate_post;
            $info_edit_user->telephone_work = $telephonework_post;
            $info_edit_user->work_location = $worklocation_post;
            $info_edit_user->save();


            if ($_FILES['fileToUpload'])
            {
                if(!empty($_FILES['fileToUpload']['name']))
                {
                    $info_edit_user->img_filename = upload_image($info_edit_user->id, "images/profile_pictures/Contactpersonen/");
                    $info_edit_user->img_size = getFileSize($info_edit_user->id, "images/profile_pictures/Contactpersonen/");
                    $info_edit_user->img_type = getFileType("images/profile_pictures/Contactpersonen/" . $info_edit_user->id . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
                    $info_edit_user->save();
                }
            }

            echo "<script type=\"text/javascript\">location.href = 'index.php?user_id={$info_edit_user->id}';</script>";
        }
        if(isset($_GET['edit_user']))
        {
            $info_edit_user_id = $_GET['edit_user'];
            $info_edit_user = Contactpersoon::find_by_id($info_edit_user_id);

            echo "<form method=\"post\" action=\"index.php?edit_user={$info_edit_user_id}\" enctype=\"multipart/form-data\">";
            echo "<input type='file' id='fileToUpload' name='fileToUpload' >";
            echo "<input type=\"text\" required value='{$info_edit_user->first_name}' name=\"firstname\">";
            echo "<input type=\"text\" value='{$info_edit_user->insertion}' name=\"insertion\">";
            echo "<input type=\"text\" required value='{$info_edit_user->last_name}' name=\"lastname\">";
            echo "<input type=\"text\" required value='{$info_edit_user->business_name}' name=\"businessname\">";
            echo "<input type=\"email\" required value='{$info_edit_user->email}' name=\"email\">";
            echo "<input type=\"text\" required value='{$info_edit_user->telephone_private}' name=\"telephone_private\">";
            echo "<input type=\"text\" required value='{$info_edit_user->telephone_work}' name=\"telephone_work\">";
            echo "<input type=\"text\" required value='{$info_edit_user->work_location}' name=\"work_location\">";
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
            $edit_user = Contactpersoon::find_by_id($edit_user_id);

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
            $remove_user = Contactpersoon::find_by_id($remove_user_id);
            echo delete_image("images/profile_pictures/Contactpersonen/" . $remove_user->id);


            $remove_user->delete();
            echo "<script type=\"text/javascript\">location.href = 'index.php';</script>";
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

<?php

//Simply add new gebruiker
if(isset($_POST['add']))
{

    $firstname_post = $_POST['firstname'];
    $insertion_post = $_POST['insertion'];
    $lastname_post = $_POST['lastname'];
    $business_post = $_POST['businessname'];
    $email_post = $_POST['email'];
    $telephoneprivate_post = $_POST['telephone_private'];
    $telephonework_post = $_POST['telephone_work'];
    $worklocation_post = $_POST['work_location'];

    $user = new Contactpersoon();
    $user->first_name = $firstname_post;
    $user->insertion = $insertion_post;
    $user->last_name = $lastname_post;
    $user->business_name = $business_post;
    $user->email = $email_post;
    $user->telephone_private = $telephoneprivate_post;
    $user->telephone_work = $telephonework_post;
    $user->work_location = $worklocation_post;
    $user->save();

if ($_FILES['fileToUpload'])
{
    if(!empty($_FILES['fileToUpload']['name']))
    {
    $user->img_filename = upload_image($user->id, "images/profile_pictures/Contactpersonen/");
    $user->img_type = getFileType("images/profile_pictures/Contactpersonen/" . $user->id . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
    $user->img_size = getFileSize($user->id, "images/profile_pictures/Contactpersonen/");
    $user->save();
  }
}
    echo "<script type=\"text/javascript\">location.href = 'index.php?user_id={$user->id}';</script>";

}
?>

<?php include 'layouts/index_footer.php';?>
