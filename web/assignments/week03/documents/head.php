
<?php

$baseURL = "https://enigmatic-lowlands-70024.herokuapp.com";
$location = "/assignments/week03";

include "scripts/items.array.script.php";
//include "scripts/session.manage.script.php";

?>

<!DOCTYPE HTML>

<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>CS 313 Shopping</title>
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/cart.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/content.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/menu.css"; ?>" />
        <link rel="stylesheet" href="<?php echo $baseURL.$location."/style/iframe.css"; ?>" />
        <script src="<?php echo $baseURL."/scripts/jquery/jquery-3.3.1.min.js"; ?>" ></script>
        <script src="<?php echo $baseURL.$location."/scripts/shopping.js"; ?>"></script>
    </head>

