
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
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/body.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/menu.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/table.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/iframe.css"; ?>" />
        <script src="<?php echo $baseURL."/scripts/jquery/jquery-3.3.1.min.js"; ?>" ></script>
        <script src="<?php echo $baseURL.$location."/scripts/shopping.js"; ?>"></script>
    </head>
