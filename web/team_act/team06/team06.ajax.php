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
            .scripture{
                font-weight: bold;
            }
        </style>
        <script src="../../scripts/jquery/jquery-3.3.1.min.js" ></script>
    </head>
    <body>
        <h1>Add a Scripture</h1>

        <form >

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
            <input id="submit" type="submit" value="add scripture"/>
        </form>

        <div id="show">

        </div>

        <script type="text/javascript" >

            function showScriptures(elemId, scriptureArray)
            {

                $.each(scriptureArray,function(index,value){
                    scriptureArray
                    parentElm = $("p");
                    childElm = $("span");
                    childElm.addClass('scripture');
                    childElm.text(value.book + " " + value.chapter + ":" + value.verse + " - ");
                    parentElm.appendTo(childElm);
                    parentElm.text("&quot;" + value.content + "&quot;");

                    elemId.appendTo(parentElm);

                });

            }


            function showTopic(elemID,topic)
            {
                parentElm = $("h2");
                parentElm.text(topic);
                elemID.appendTo(parentElm);
            }


            function getScripturs()
            {

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        document.getElementById("show").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "display.ajax.php", true);
                xmlhttp.send();

            }

            getScripturs();

        </script>

    </body>
</html>
