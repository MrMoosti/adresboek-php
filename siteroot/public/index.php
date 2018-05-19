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
            <input type="text" name="voornaam" placeholder="Zoeken" />
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
        <a href="#"><i class="fas fa-plus"></i></a>
    </div>

    <div class="listNames">
        <div id="load_data">
            <script type="text/javascript"></script>
        </div>
        <div id="load_data_message"></div>
        <script>
            function findGET() {
                var result = null,
                    tmp = [];
                location.search
                    .substr(1)
                    .split("&")
                    .forEach(function (item) {
                        tmp = item.split("=");
                        if (tmp[0] === "voornaam") result = decodeURIComponent(tmp[1]);
                    });
                return result;
            }
            $(document).ready(function () {
                            test();
                function test() {
                    for (var i = 0; i < 50; i++) {
                            console.log(findGET());

                    }
                }
                var limit = 20;
                var start = 0;
                var action = 'inactive';
                function load_data(limit, start, search) {
                    $.ajax({
                        url: "CpData.php",
                        method: "POST",
                        data: { limit: limit, start: start, search: search },
                        cache: false,
                        success: function (data) {
                            $('#load_data').append(data);
                            if (data == '') {
                                $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
                                action = 'active';
                            } else {
                                if (findGET() == null || findGET() == "") {
                                    $('#load_data_message').html("<div id='loadingGif'><img src='https://i.gyazo.com/8ee2faef3efa92e0a932eb1a36659cdb.gif'/></div>");
                                    action = "inactive";
                                } else {
                                    action = "active";
                                    window.history.pushState("object or string", "Title", "/adresboek-php/siteroot/public/");
                                }
                            }
                            if (data == "No results"){
                                action = "inactive";
                                $('#load_data_message').html("<div id='loadingGif'><img src=''/></div>");
                            }
                        }
                    });
                }
                if (action == 'inactive' && findGET() == null) {
                    action = 'active';
                    load_data(limit, start, null);
                } else {
                    action = 'active';
                    load_data(limit, start, findGET());
                }
                $(".listNames").scroll(function () {
                    if ($(".listNames").scrollTop() + $(".listNames").height() > $("#load_data").height() && action == 'inactive') {
                        if (findGET() == null) {
                            action = 'active';
                            start = start + limit;
                            setTimeout(function () {
                                load_data(limit, start, null);
                            }, 1000);
                        } else {
                            action = 'active';
                            start = start + 50;
                            setTimeout(function () {
                                load_data(50, start, findGET());
                            }, 1000);
                        }
                    }
                });
                            test();
            });
        </script>
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