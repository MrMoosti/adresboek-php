<?php
require_once('includes/ContactPersoon.php');

sleep(1);
include("config.inc.php"); //include config file


//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
    header('HTTP/1.1 500 Invalid page number!');
    exit;
}

//get current starting point of records
$position = (($page_number-1) * $item_per_page);
//fetch records using page position and item per page.
$results = $mysqli->prepare("");

if (isset($_GET['voornaam'])) {
    $searchResult = $_GET['voornaam'];
    $result = ContactPersoon::search($searchResult, "contactperson");
}
else {
    $result = ContactPersoon::find_by_sql("SELECT first_name, last_name, img_filename, zipcode, business_place, business_name FROM `contactperson` LIMIT ?, ?");
}
foreach ($result as $person) {
    echo "<div class=\"section\">";
    echo "<img src=\"{$person->img_filename}\" />";
    echo "<p>{$person->first_name}, {$person->last_name}</p>";
    echo "<p>{$person->zipcode}, {$person->business_place}</p>";
    echo "<p class=\"sectionCompany\">{$person->business_name}</p>";
    echo "</div><hr />";
}
if (empty($result)) {
    echo "Er zijn geen resultaten gevonden";
}
