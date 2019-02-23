
<?php

$baseURL = "https://enigmatic-lowlands-70024.herokuapp.com";
$location = "/project/project1";

include_once "../scripts/db.php";
include_once "scripts/db.php";
//include_once "scripts/session.manage.script.php";
//include_once "../scripts/session.manage.script.php";

?>

<!DOCTYPE HTML>

<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>Computer Patching</title>
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/styles/body.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/styles/menu.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/styles/table.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/styles/iframe.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/styles/search-results.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL."/scripts/bootstrap/4.2.1/css/bootstrap.min.css";?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseURL.$location."/styles/calendar.css";?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseURL.$location."/styles/addContent.css";?>" />
        <script src="<?php echo $baseURL."/scripts/jquery/jquery-3.3.1.min.js"; ?>" ></script>
        <script src="<?php echo $baseURL."/scripts/bootstrap/4.2.1/js/bootstrap.bundle.min.js";?>" ></script>
        <script src="<?php echo $baseURL.$location."/scripts/calendar.js";?>"></script>
    </head>

