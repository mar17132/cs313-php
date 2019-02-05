<?php

include "scripts/db.php";

?>



<!DOCTYPE HTML>

<html>
    <head>
        <title>Computer Patching</title>
        <link rel="stylesheet" href="styles/menu.css"/>
        <link rel="stylesheet" href="styles/body.css"/>
        <link rel="stylesheet" href="styles/table.css"/>
    </head>
    <body>
        <div class="header">
            <h1>Patching</h1>

            <div class="menu-div">
                <ul class="menu-ul">
                    <li class="menu-li">
                        <a class="menu-a">
                            Home
                        </a>
                    </li>
                    <li class="menu-li">
                        <a class="menu-a">
                            Patching
                        </a>
                    </li>
                    <li class="menu-li">
                        <a class="menu-a">
                            Servers
                        </a>
                    </li>
                    <li class="menu-li">
                        <a class="menu-a">
                            Calenader
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content">
            <h3>Upcoming Patches</h3>
            <div class="table-div">
                <ul class="table-row">
                    <li class="table-cell">
                        <div class="table-cell-head-content">
                            Name
                        </div>
                    </li>
                    <li class="table-cell">
                        <div class="table-cell-head-content">
                            Date
                        </div>
                    </li>
                    <li class="table-cell">
                        <div class="table-cell-head-content">
                            Time
                        </div>
                    </li>
                  <!--  <li class="table-cell">
                        <div class="table-cell-head-content">
                            Buttons
                        </div>
                    </li>-->
                </ul>

            <?php


            $statement = $db->query("SELECT PatchSchedlue.ID AS scheduleID,
                                PatchSchedlue.patchdate,PatchSchedlue.patchtime,
                                PatchCycle.Name,PatchCycle.ID AS patchID
                                FROM PatchSchedlue
                                JOIN PatchCycle ON
                                PatchSchedlue.PatchCycle_ID = PatchCycle.ID
                                ORDER BY PatchSchedlue.patchdate;");
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);


            if(count($result) > 0)
            {
                foreach($result as $row)
                {
                    echo "<ul class='table-row'>";

                    //Name
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Date
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[patchdate];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Time
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[patchtime];
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
        </div>

        <div class="footer">

        </div>
    </body>
</html>

