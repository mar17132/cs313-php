<?php


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3>Computers</h3>
<form method="post" action="addserver.php">
            <div class="table-div">
                <ul class="table-row">
                    <li class="table-cell">
                        <div class="table-cell-content">
                           <input type="button" class="contentButtons buttonVisible" />
                        </div>
                    </li>
                    <li class="table-cell">
                        <div class="table-cell-content">
                           <a href="addserver.php" class="addContent">
                                <input type="button" class="contentButtons"  value="Add Server" />
                            </a>
                        </div>
                    </li>
                    <li class="table-cell">
                        <div class="table-cell-content">

                                <input type="submit" class="contentButtons"  value="Edit Server" />

                        </div>
                    </li>
                </ul>
                <ul class="table-row">
                     <li class="table-cell">
                        <div class="table-cell-head-content">
                            Select
                        </div>
                    </li>
                    <li class="table-cell">
                        <div class="table-cell-head-content">
                            Name
                        </div>
                    </li>
                    <li class="table-cell">
                        <div class="table-cell-head-content">
                            IP
                        </div>
                    </li>
                    <!--<li class="table-cell">
                        <div class="table-cell-head-content">
                            Buttons
                        </div>
                    </li>-->
                </ul>

            <?php

            $statement = "";
            $result = "";

            if(isset($_GET['serverID']))
            {
                $statement = $db->query("SELECT * FROM Computers WHERE ID ='".$_GET['serverID']."';");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $statement = $db->query("SELECT * FROM Computers;");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }


            if(count($result) > 0)
            {
                foreach($result as $row)
                {
                    echo "<ul class='table-row'>";

                    //Select
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo "<input type='checkbox' name='serverid' class='selectValueChk' value='";
                    echo $row[id];
                    echo "'/>";
                    echo "</div>";
                    echo "</li>\r\n";

                    //Name
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Notes
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[ip];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Button
                  /*  echo "<li class='table-cell'>
                         <div class='table-cell-content'>";
                    echo "No current Patch Cycles";
                    echo "</div></li>";*/

                    echo "</ul>";
                }
            }
            else
            {
                echo "<ul class='table-row'><li class='table-cell'>
                     <div class='table-cell-content'>";
                echo "No current Patch Cycles";
                echo "</div></li></ul>";
            }

            ?>

            <!-- Table elements
            <div class="table-div">
                <ul class="table-row">
                    <li class="table-cell">
                        <div class="table-cell-head-content">
                            1
                        </div>
                    </li>
                </ul>
            </div>-->

            </div>
    </form>
        </div>

        <div class="footer" >

        </div>

        <script>
            var selectChk = $(".selectValueChk");

            function disableAllCheck(elem)
            {
                elem.prop("disabled",true);
            }

            function enableAllCheck(elem)
            {
                elem.prop("disabled",false);
            }

            selectChk.on("click",function(){


                if($(this).is(":checked"))
                {
                    disableAllCheck(selectChk);
                    $(this).prop("disabled",false);
                }
                else
                {
                    enableAllCheck(selectChk);
                }


            });

        </script>
    </body>
</html>

