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
        <a href="#"><i class="fas fa-plus"></i></a>
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



<?php include 'layouts/index_footer.php';?>