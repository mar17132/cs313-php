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
            .scripture{
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h1>Scripture Details</h1>

        <?php

          foreach($db->query('SELECT * FROM Scriptures WHERE id ='.$_GET['id'].';') as $row)
            {

                echo "<p>";
                //scripture
                echo "<span class='scripture'>";
                echo $row[book]." ".$row[chapter].":".$row[verse]." - ";
                echo "</span>";
                echo "&quot;".$row[content]."&quot;";
                echo "</p>";

            }

        ?>

    </body>
</html>

