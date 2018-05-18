<?php include('includes/Contactpersoon.php');
if(isset($_POST["limit"], $_POST["start"]))
{
    if (isset($_GET['voornaam'])) {
        $searchResult = $_GET['voornaam'];
        $result = ContactPersoon::search($searchResult, "contactperson");
    }
    else {
        $result = ContactPersoon::find_by_sql("SELECT * FROM contactperson LIMIT ".$_POST["start"].", ".$_POST["limit"]);
    }
    foreach ($result as $person) {
        echo "<div class=\"section\">";
        echo "<img src=\"{$person->img_filename}\" />";
        echo "<p>{$person->first_name}, {$person->last_name}</p>";
        echo "<p>{$person->zipcode}, {$person->business_place}</p>";
        echo "<p class=\"sectionCompany\">{$person->business_name}</p>";
        echo "</div>";
        echo "<hr>";
    }
    if (empty($result)) {
        echo "Er zijn geen resultaten gevonden";
    }
}
?>