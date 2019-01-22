<?php

$baseURL = "https://enigmatic-lowlands-70024.herokuapp.com";
$location = "/assignments/week03";

include $baseURL.$location."/scripts/items.array.script.php";

if(isset($items))
{
    echo "true";
}
else
{
    echo "false";
}

?>
