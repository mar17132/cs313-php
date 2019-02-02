<?php

$db;

try
{
    $dbUrl = getenv('DATABASE_URL');
    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

?>


<!DOCTYPE HTML>

<html>
    <head>
        <title>Team 05</title>
        <style type="text/css">

        </style>
    </head>
    <body>
        <h1>Scripture Resources</h1>

        <?php

          foreach($db->query("SELECT * FROM Scriptures WHERE book ='".$_POST['search']."';") as $row)
            {
                echo "<a class='scripture' href='display.php?id=$row[id]' >";
                echo $row[book]." ".$row[chapter].":".$row[verse];
                echo "</a><br/>";

            }

        ?>

    </body>
</html>

