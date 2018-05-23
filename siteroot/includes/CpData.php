<?php



require_once("initialize.php");
if(isset($_POST["limit"], $_POST["start"]))
{
    if ($_POST['search'] != null) {
        $searchq = preg_replace("#[^0-9a-z]#i", "", strtolower($_POST['search']));
        $sql  = "SELECT * FROM contactperson WHERE LOWER(first_name) LIKE '%".$searchq."%'";
        $sql .= " OR LOWER(last_name) LIKE '%".$searchq."%'";
        $sql .= " OR LOWER(business_name) LIKE '%".$searchq."%'";
        $sql .= " OR LOWER(work_location) LIKE '%".$searchq."%' ORDER BY ".$_POST["sort"]." ASC LIMIT ".$_POST["start"].", ".$_POST["limit"];
        $result = ContactPersoon::find_by_sql($sql);
        unset($_POST['search']);
    }
    else {
        if($_POST["sort"] != null) $result = ContactPersoon::find_by_sql("SELECT * FROM contactperson ORDER BY ".$_POST["sort"]." ASC LIMIT ".$_POST["start"].", ".$_POST["limit"]);
    }
    foreach ($result as $person) {
        echo "<div class=\"section\">";
        echo "<img src=\"{$person->img_filename}\" />";
        echo "<p>{$person->first_name}, {$person->last_name}</p>";
        echo "<p>{$person->work_location}</p>";
        echo "<p class=\"sectionCompany\">{$person->business_name}</p>";
        echo "</div>";
        echo "<hr>";
    }
    if (empty($result)) {
        echo "No results";
    }
}
?>
