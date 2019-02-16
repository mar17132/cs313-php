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


session_start();

if(count($_POST) > 0)
{
    unset($_SESSION['userID']);
}

$userName ="";

if(!isset($_SESSION['userID']))
{
    header('Location:sign-in.php');
}
else
{
    $statement = $db->query("SELECT * FROM Users7 WHERE ID='".$_SESSION['userID']."';");
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $userName = $results[0][name];
}


?>



<!DOCTYPE HTML>

<html>
    <head>
        <title>Team 7</title>
    </head>
    <body>
        <h1>
            Welcome
            <?php echo $userName; ?>
        </h1>

        <form method="post" action="welcome.php">
            <input type="hidden" value="logoff" name="logoff"/>
            <input type="submit" value="logoff"/>
        </form>
    </body>
</html>

