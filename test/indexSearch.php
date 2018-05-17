<?php include('includes/Contactpersoon.php'); ?>
<?php include 'layouts/index_header.php'; ?>
<?php
$output = "Zoek...";

?>

<!-- THIS SECTION CHANGES DEPENDEND ON SQL-QUERY -->
<section id="content">
    <div class="search">
        <form class="searchForm" method="get" id="searchForm">
            <input type="text" name="voornaam" placeholder="<?php echo $output; ?>"/>
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
        // Create connection
        $db = new mysqli("localhost", "root", "", "addressbook");
        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        if (isset($_GET['voornaam'])) {
            $searchq = $_GET['voornaam'];
            $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

            $sql = "SELECT * FROM contactperson WHERE first_name LIKE '%".$searchq."%'";
            $sql .= " OR last_name LIKE '%".$searchq."%'";
            $sql .= " OR business_name LIKE '%".$searchq."%'";
            $sql .= " OR business_place LIKE '%".$searchq."%' ORDER BY first_name ASC";
            $result = $db->query($sql);
            if (empty($result)) {
                $output = "Er was geen ".$searchq." in het adresboek";
            }
        }
        else {
            $sql = "SELECT `ID`, `username`, `first_name`, `insertion`, `last_name`, `business_name`, `business_place`, `zipcode`, `email`, `telephone_work`, `telephone_private`, `img_filename`, `img_size`, `img_type` FROM `contactperson` ";
            $result = $db->query($sql);
        }
        if (mysqli_num_rows($result)) {
            //adding one row per person
            while ($row = $result->fetch_assoc()) {
                echo "<div class=\"section\">";
                echo "<img src=\"{$row["img_filename"]}\" />";
                echo "<p>{$row["first_name"]}, {$row["last_name"]}</p>";
                echo "<p>{$row["zipcode"]}, {$row["business_place"]}</p>";
                echo "<p class=\"sectionCompany\">{$row["business_name"]}</p>";
                echo "</div><hr />";
            }
        } else {
            echo "  <div class=\"section\">
  				<img src=\"images/profile_pictures/kim.jpg\">
  				<p>Kim, Jung Un</p>
  				<p>7071 KA, Ulft</p>
  				<p class=\"sectionCompany\">microsoft</p>
  			    </div><hr></div>";
        } ?>
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
    <!--<div class="deleteChange">
        <i class="fas fa-pencil-alt"></i>
        <i class="fas fa-trash"></i>
    </div>-->
</section>

<?php include 'layouts/index_footer.php'; ?>
