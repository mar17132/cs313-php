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

if(isset($_SESSION['userID']))
{
    header('Location:welcome.php');
}

?>



<?php

$errorMess = "";

if(count($_POST) > 0)
{

    $statement = $db->query("SELECT * FROM Users7 WHERE name='".$_POST[usernameTxt]."';");
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);


    if(count($results) > 0)
    {
        if(password_verify($_POST['passTxt'],$results[0][pass]))
        {
            $_SESSION['userID']=$results[0][id];
            header('Location:welcome.php');
        }
        else
        {
            $errorMess ="Username or Password is incorrect";
        }
    }
    else
    {
        $errorMess ="Username or Password is incorrect";
    }

}

?>


<!DOCTYPE HTML>

<html>
    <head>
        <title>Sign in</title>
        <style>
            p,span{
                color: red;
            }
        </style>
    </head>
    <body>
        <form action="sign-in.php" method="post">
            <p>
                <?php
                echo $errorMess;
                ?>
            </p>
            <label>username</label><br/>
            <input type="text" id="usernameTxt" name="usernameTxt"/>
            <span>
                <?php
                echo empty($errorMess) ? "*" : "";
                ?>
            </span>
            <br/><br/>

            <label>password</label><br/>
            <input type="password" id="passTxt" name="passTxt" />
            <span>
                <?php
                echo empty($errorMess) ? "*" : "";
                ?>
            </span>
            <br/><br/>

            <input type="submit" value="Sign In" />
        </form>
        <a href="sign-up.php" >Sign UP</a>
    </body>
</html>
