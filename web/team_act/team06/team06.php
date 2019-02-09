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
            body{
                font-size: 1em;
            }
            ul{
                list-style-type: none;
            }
        </style>
    </head>
    <body>
        <h1>Add a Scripture</h1>

        <form method="post" action="display.php">

            <label>Book</label>
            <input type="text" name="book" />
            <br/>

            <label>Chapter</label>
            <input type="text" name="chapter"/>
            <br/>

            <label>Verse</label>
            <input type="text" name="verse"/>
            <br/>

            <label>Content</label>
            <br/>
            <textarea name="content" ></textarea>

            <ul>
                <li>Select Topics</li>
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
            </ul>
            <br/>
            <input type="submit" value="add scripture"/>
        </form>

    </body>
</html>
