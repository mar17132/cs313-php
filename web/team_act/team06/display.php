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
        <title>Team 06</title>
        <style type="text/css">
            .scripture{
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h1>Add a Scripture</h1>

        <form method="post" action

        <?php

          foreach($db->query('SELECT * FROM Topic;') as $row)
            {

                echo "<li>";
                //scripture
                echo "<input type='checkbox' name='topic[]' value='".$row[id]."'/>";
                echo $row[name];
                echo "</li>";

            }

        ?>

    </body>
</html>
