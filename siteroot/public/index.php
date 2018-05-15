<?php include 'layouts/index_header.php';?>

    <!-- THIS SECTION CHANGES DEPENDEND ON SQL-QUERY -->
    <section id="content">
        <div class="search">
            <form class="searchForm" method="get">
                <input type="text" name="voornaam" placeholder="Zoek..." />
                <a href="#">
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
            <?php include 'includes/listContacts.php'?>
    </section>

    <section id="detail">
        <p>Hi</p>
    </section>

<?php include 'layouts/index_footer.php';?>