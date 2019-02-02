<?php

$db;
echo "test2";
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

echo "test3";
?>


<!DOCTYPE HTML>

<html>
    <head>
        <title>Team 05</title>
    </head>
    <body>
        <h1>Scripture Resources</h1>

        <?php
            echo "test1";
          /*  foreach($db->query('SELECT * FROM Scriptures;') as $row)
            {
                echo "<p>";
                //scripture
                echo "<span class='scripture'>";
                echo $row['book']." ".$row['chapter'].":"$row['verses']." - ";
                echo "</span>";
                echo "&quot;".$row['content']."&quot;";
                echo "</p>";

            }*/

        ?>

    </body>
</html>

