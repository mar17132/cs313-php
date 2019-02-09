<?php


?>



<?php include "header-docs.php"; ?>

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
                            Notes
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

            if(isset($_GET['patchID']))
            {
                $statement = $db->query("SELECT * FROM PatchCycle WHERE ID ='".$_GET['patchID']."';");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $statement = $db->query("SELECT * FROM PatchCycle;");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }


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

                    //Notes
                    echo "<li class='table-cell'>";
                    echo "<div class='table-cell-content'>";
                    echo empty($row[notes]) ? "&nbsp;" : $row[notes] ;
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

