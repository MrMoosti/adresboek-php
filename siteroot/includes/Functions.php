<?php

function strip_zeros_from_date($marked_string="")
{
    //first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    //then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

function redirect_to($location = NULL)
{
    if($location != NULL)
    {
        header("Location: {$location}");
        exit;
    }
}

function output_message($message = "")
{
    if(!empty($message))
    {
        return  "<p class=\"message\">{$message}</p>";
    }
    else
    {
        return "";
    }
}

function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path))
    {
        require_once($path);
    }
    else
    {
        die("The file {$class_name}.php could not be found.");
    }
}

function include_layout_template($template = "")
{
    include(SITE_ROOT.DS. 'public' .DS. 'layouts' .DS. $template);
}

function log_action($action, $message="")
{
    $logfile = SITE_ROOT . DS . "logs" . DS . "log.txt";
    $new = file_exists($logfile) ? false : true;
    if($handle = fopen($logfile, 'a')) //Append
    {
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message} \r\n";
        fwrite($handle, $content);
        fclose($handle);
        if($new)
        {
            chmod($logfile, 0755);
        }
        else
        {
            echo "Could not open log file for writing.";
        }
    }
}

function datetime_to_text($datetime="")
{
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function upload_image($filename="")
{
    $target_dir = "images/profile_pictures/";
    $path = $_FILES['fileToUpload']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $target_file = $target_dir . $filename . "." . $ext;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if(isset($_POST["add"]) || isset($_POST["edit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
//            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check file size 2MB
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
//        echo "Sorry, your file is too large.";
        alertBox("Foto is groter dan 2MB!");
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
//        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        alertBox("Alleen foto's met het type: .jpg / .png / .jpeg / .gif zijn toegestaan");
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
// if everything is ok, try to upload file
    } else {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
    return $target_file;
}

function getFileSize($userid="")
{
    return filesize( "images/profile_pictures/". $userid . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
}

function getFileType($target_file="")
{
    return strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
}

function alertBox($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

?>
