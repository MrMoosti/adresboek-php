
<div class="listNames">
    <?php
    // Create connection
    $db = new mysqli("localhost", "root", "", "addressbook");
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $sql = "SELECT `ID`, `username`, `first_name`, `insertion`, `last_name`, `business_name`, `business_place`, `zipcode`, `email`, `telephone_work`, `telephone_private`, `img_filename`, `img_size`, `img_type` FROM `contactperson` ";
    $result = $db->query($sql);
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