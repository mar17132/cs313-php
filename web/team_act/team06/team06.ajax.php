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
            <input type="text" name="book" id="book"/>
            <br/>

            <label>Chapter</label>
            <input type="text" name="chapter" id="chapter"/>
            <br/>

            <label>Verse</label>
            <input type="text" name="verse" id="verse"/>
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
                    echo "<input type='checkbox' class='topics' name='topic[]' id='$row[name]' value='".$row[id]."'/>";
                    echo $row[name];
                    echo "</li>";

                }

            ?>
               <li>
                    <input type="checkbox" id="newTopic" class="topics" value="newTopic" />
                    <input type="text" disabled="disabled" id="newTopicTxt" />
               </li>
            </ul>
            <br/>
            <input id="submit" type="button" onclick="update()" value="add scripture"/>
        </form>

        <div id="show">

        </div>

        <script type="text/javascript" >

            var showDiv = $("#show");
            var newTopicTxt = $("#newTopicTxt");
            var newTopicChck = $("#newTopic");

            var bookTxt = $("#book");
            var chapterTxt = $("#chapter");
            var verseTxt = $("#verse");
            var topicsArray = $(".topics");

            newTopicChck.on("change",function(){
                if($(this).is(":checked"))
                {
                    newTopicTxt.prop('disabled',false);
                }
                else
                {
                    newTopicTxt.prop('disabled',true);
                }
            });

            function showScriptures(elemId, scriptureArray)
            {

                $.each(scriptureArray,function(index,value){
                    parentElm = $("<p></p>");
                    childElm = $("<span></span>");
                    childElm.addClass('scripture');
                    childElm.text(value.book + " " + value.chapter + ":" + value.verse + " - ");
                    childElm.appendTo(parentElm);
                    parentElm.html("&quot;" + value.content + "&quot;");

                    parentElm.appendTo(elemId);

                });

            }


            function showTopic(elemID,topic)
            {
                parentElm = $("<h2></h2>");
                parentElm.text(topic);
                parentElm.appendTo(elemID);
            }

            function deleteAllChild(elem)
            {
                elem.empty();

            }

            function updateScript()
            {
                newArray = new Array();
                newTopic = "null";

                topicsArray.each(function(){
                    if($(this).is(":checked"))
                    {
                        if($(this).attr('id') != "newTopic")
                        {

                        }
                        else
                        {
                            newArray.push($(this).val());
                        }

                    }
                });

                /*$.post("display.ajax.php",{
                        book:bookTxt,
                        chapter:chapterTxt,
                        verse:verseTxt,
                        topicnew:newTopic,
                        topics[]:newTopicArray
                      });*/
            }


            function getScripturs(str = "")
            {

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        //document.getElementById("show").innerHTML = this.responseText;
                        jsonString = JSON.parse(this.responseText);
deleteAllChild (showDiv);

                        for(x in jsonString)
                        {
                            showTopic(showDiv,x);
                            showScriptures(showDiv,jsonString[x]);
                        }

                    }
                };
                xmlhttp.open("GET", "display.ajax.php" + str, true);
                xmlhttp.send();

            }

            getScripturs();

        </script>

    </body>
</html>
