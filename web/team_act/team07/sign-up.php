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


$errorMess = "";

if(count($_POST) > 0)
{
    if(checkInput())
    {
       if($_POST['passTxt'] == $_POST['passConTxt'])
       {
           $db->query("INSERT INTO Users7(name,pass)
                     VALUES('".$_POST['usernameTxt']."','".
                      password_hash($_POST['passTxt'],PASSWORD_DEFAULT)."')");
       }
       else
       {
           $errorMess = "Passwords don't match";
       }
    }
    else
    {
        $errorMess = "Please input all feilds";
    }
}


function checkInput()
{
    $returnVal = true;

    foreach($_POST as $input)
    {
        if(empty($input))
        {
            $returnVal = false;
        }
    }

    return $returnVal;
}


?>

<!DOCTYPE HTML>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="sign-up.php" method="post">
            <p>
                <?php
                echo $errorMess;
                ?>
            </p>
            <label>username</label><br/>
            <input type="text" id="usernameTxt" name="usernameTxt"/>
            <br/><br/>

            <label>password</label><br/>
            <input type="password" id="passTxt" name="passTxt" />
            <br/><br/>

            <label>password Confirm</label><br/>
            <input type="password" id="passConTxt" name="passConTxt" />
            <br/><br/>

            <input type="submit" value="Sign Up" />
        </form>
    </body>
</html>


