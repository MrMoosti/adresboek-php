<?php include ('includes/Contactpersoon.php'); ?>
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

        <div class="listNames">
            <?php

            $contacts = Contactpersoon::find_all();

            $result = $db->query($contacts);

            if ($result->num_rows > 0) {
                //adding one row per person
                while($row = $result->fetch_assoc()) {
                    echo "<div class=\"section\">";
                    echo "<img src=\"{$row["img_filename"]}\" />";
                    echo "<p>{$row["first_name"]}, {$row["last_name"]}</p>";
                    echo "<p>{$row["zipcode"]}, {$row["business_place"]}</p>";
                    echo "<p class=\"sectionCompany\">{$row["business_name"]}</p>";
                    echo "</div><hr />";
                }
            }
            else {
                echo "  <div class=\"section\">
          				<img src=\"images/profile_pictures/kim.jpg\">
          				<p>Kim, Jung Un</p>
          				<p>7071 KA, Ulft</p>
          				<p class=\"sectionCompany\">microsoft</p>
          			    </div><hr></div>";
            }?>
        </div>

    </section>

    <section id="detail">
        <p>Hi</p>
    </section>

<?php include 'layouts/index_footer.php';?>
