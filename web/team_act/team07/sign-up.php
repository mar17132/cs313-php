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
$passwordError = false;
$userError = false;

if(count($_POST) > 0)
{
    if(checkInput())
    {
       if($_POST['passTxt'] == $_POST['passConTxt'])
       {
           if(preg_match('/(([0-9]{1,})*[a-zA-Z]){7,}/',$_POST['passTxt']))
           {
               $db->query("INSERT INTO Users7(name,pass)
                         VALUES('".$_POST['usernameTxt']."','".
                          password_hash($_POST['passTxt'],PASSWORD_DEFAULT)."');");

               header('Location:sign-in.php');
           }
           else
           {
               $errorMess = "Password not valid";
               $passwordError = true;
           }
       }
       else
       {
           $errorMess = "Passwords don't match";
           $passwordError = true;
       }
    }
    else
    {
        $errorMess = "Please input all feilds";
        $userError = true;
        $passwordError = true;
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
        <title>Sign up</title>
        <style>
            p,span{
                color: red;
            }
        </style>
        <script src="../../scripts/jquery/jquery-3.3.1.min.js"></script>
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
            <span>
                <?php
                echo ($userError) ? "*" : "";
                ?>
            </span>
            <br/><br/>

            <label>password</label><br/>
            <input type="password" id="passTxt" name="passTxt" />
            <span>
                <?php
                echo ($passwordError) ? "*" : "";
                ?>
            </span>
            <br/><br/>

            <label>password Confirm</label><br/>
            <input type="password" id="passConTxt" name="passConTxt" />
            <span>
                <?php
                echo ($passwordError) ? "*" : "";
                ?>
            </span>
            <br/><br/>

            <input type="submit" id="submit" value="Sign Up"  disabled="disabled" />
        </form>

        <script type="text/javascript">

            var passTxt = $("#passTxt");
            var passConTxt = $("#passConTxt");
            var submitBtn = $("#submit");
            var reg = /(([0-9]{1,})*[a-zA-Z]){7,}/g;

            passConTxt.on("change",function(){
                if(passTxt.val() == $(this).val())
                {
                    if(reg.test($(this).val()))
                    {
                        submitBtn.prop('disabled',false);
                    }
                    else
                    {
                        submitBtn.prop('disabled',true);
                    }

                }
            });


            passTxt.on("change",function(){
                if(passConTxt.val() == $(this).val())
                {
                    if(reg.test($(this).val()))
                    {
                        submitBtn.prop('disabled',false);
                    }
                    else
                    {
                        submitBtn.prop('disabled',true);
                    }
                }
            });

        </script>
    </body>
</html>


