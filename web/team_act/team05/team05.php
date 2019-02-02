<?php

$db;

try
{
    $dbUrl = getenv('postgres://slslbiexbctcag:1e01412a806ed5a1cec30a5c99a6a784333ecd1c5b1ae5ec12b988069918ea53@ec2-107-22-162-8.compute-1.amazonaws.com:5432/dap2vvqc2qoa99');
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
    </head>
    <body>
        <h1>Scripture Resources</h1>

        <?php
        echo " test1";

            foreach($db->query('SELECT * FROM Scriptures') as $row)
            {
                echo "<p>";
                //scripture
                echo "<span class='scripture'>";
                echo $row['book']." ".$row['chapter'].":"$row['verses']." - ";
                echo "</span>";
                echo "&quot;".$row['content']."&quot;";
                echo "</p>";

            }


        ?>

    </body>
</html>

