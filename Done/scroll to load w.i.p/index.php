<?php include('includes/Contactpersoon.php'); ?>
<?php include 'layouts/index_header.php'; ?>
<?php require_once('includes/ContactPersoon.php'); ?>


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
        <div id="load_data"></div>
        <div id="load_data_message"></div>
        <script>

            $(document).ready(function () {

                var limit = 20;
                var start = 0;
                var action = 'inactive';
                function load_country_data(limit, start) {
                    $.ajax({
                        url: "CpData.php",
                        method: "POST",
                        data: { limit: limit, start: start },
                        cache: false,
                        success: function (data) {
                            $('#load_data').append(data);
                            if (data == '') {
                                $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
                                action = 'active';
                            }
                            else {
                                $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
                                action = "inactive";
                            }
                        }
                    });
                }

                if (action == 'inactive') {
                    action = 'active';
                    load_country_data(limit, start);
                }
                $(".listNames").scroll(function () {
                    console.log($(".listNames").html());
                    if ($(".listNames").scrollTop() + $(".listNames").height() > $("#load_data").height() && action == 'inactive') {
                        action = 'active';
                        start = start + limit;
                        setTimeout(function () {
                            load_country_data(limit, start);
                        }, 1000);
                    }
                });

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
