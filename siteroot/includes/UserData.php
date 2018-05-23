<?php
require_once("initialize.php");
if(isset($_POST["limit"], $_POST["start"]))
{
    if ($_POST['search'] != null) {
        $searchq = preg_replace("#[^0-9a-z]#i", "", $_POST['search']);
        $sql  = "SELECT * FROM user WHERE first_name LIKE '%".$searchq."%'";
        $sql .= " OR last_name LIKE '%".$searchq."%'";
        $sql .= " OR id LIKE '%".$searchq."%'";
        $sql .= " ORDER BY ".$_POST["sort"]." ASC LIMIT ".$_POST["start"].", ".$_POST["limit"];
        $result = user::find_by_sql($sql);
        unset($_POST['search']);
    }
    else {
        if($_POST["sort"] != null) $result = user::find_by_sql("SELECT * FROM user ORDER BY ".$_POST["sort"]." ASC LIMIT ".$_POST["start"].", ".$_POST["limit"]);
    }
    foreach ($result as $person) {
        echo "<a href='?user_id={$person->id}'> <div id='whole-card'>";
        echo "<div class='section'>";
        echo "<img src=\"{$person->img_filename}\" />";
        echo "<p>{$person->first_name}, {$person->insertion} {$person->last_name}</p>";
        echo "<p>ID: {$person->id}</p>";
        if($person->admin == 0)
        {
            echo "<p class=\"sectionCompany\">Gebruiker</p>";
        }
        else if ($person->admin == 1)
        {
            echo "<p class=\"sectionCompany\">Admin</p>";
        }
        echo "</div><hr />";
        echo "</div></a>";
    }
    if (empty($result)) {
        echo "No results";
    }
}
?>
