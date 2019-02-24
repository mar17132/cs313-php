<?php


?>



<?php include "header-docs.php"; ?>

        <div class="content">

            <form method="post" action="addpatch.php">
            <div class="table-div patch-table">
                <h3>Patch Cycles</h3>
                <ul class="table-row row">
                    <li class="table-cell col">
                        <div class="table-cell-content">
                              <?php
                                if(isset($_POST['patchID']))
                                {
                                   echo "<input type='button' class='contentButtons buttonVisible' />
                                   <input type='hidden' value='".$_POST['patchID']."' name='patchID' />";
                                }
                                elseif(isset($_GET['patchID']))
                                {
                                   echo "<input type='button' class='contentButtons buttonVisible' />
                                   <input type='hidden' value='".$_GET['patchID']."' name='patchid' />";
                                }
                                else
                                {
                                    echo "<a href='patching.php' id='viewSelected' class='addContent'>
                                    <input type='button' class='contentButtons' value='View Server' /></a>";
                                }

                                ?>
                        </div>
                    </li>
                    <li class="table-cell col <?php
                              if(isset($_GET['patchID']) || isset($_POST['patchID']))
                              {
                                  echo "hidden";
                              }
                              ?>">
                        <div class="table-cell-content">
                           <a href="addpatch.php" class="addContent">
                                <input type="button" class="contentButtons"  value="Add Patch" />
                            </a>
                        </div>
                    </li>
                    <li class="table-cell col">
                        <div class="table-cell-content <?php
                              if(isset($_GET['patchID']) || isset($_POST['patchID']))
                              {
                                  echo "patchingBtn";
                              }
                              ?>">

                        <input type="submit" class="contentButtons"  value="Edit Patch" />

                        </div>
                    </li>
                </ul>

                <ul class="table-row row">
                    <li class="table-cell col <?php
                              if(isset($_GET['patchID']) || isset($_POST['patchID']))
                              {
                                  echo "hidden";
                              }
                              ?>">
                        <div class="table-cell-head-content">
                            Select
                        </div>
                    </li>
                    <li class="table-cell col">
                        <div class="table-cell-head-content">
                            Name
                        </div>
                    </li>
                    <li class="table-cell col <?php
                              if(!(isset($_GET['patchID']) || isset($_POST['patchID'])))
                              {
                                  echo "hidden";
                              }
                              ?>">
                        <div class="table-cell-head-content">
                            Date
                        </div>
                    </li>
                    <li class="table-cell col <?php
                              if(!(isset($_GET['patchID']) || isset($_POST['patchID'])))
                              {
                                  echo "hidden";
                              }
                              ?>">
                        <div class="table-cell-head-content">
                            Time
                        </div>
                    </li>
                    <li class="table-cell col">
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

            $statement = null;
            $result = null;
            $statementServer = null;
            $resultServer = null;

            if(isset($_GET['patchID']))
            {
                $statement = $db->query("SELECT PatchSchedlue.ID AS scheduleID,
                                PatchSchedlue.patchdate,PatchSchedlue.patchtime,
                                PatchCycle.Name,PatchCycle.ID AS id,PatchCycle.note
                                FROM PatchSchedlue
                                JOIN PatchCycle ON
                                PatchSchedlue.PatchCycle_ID = PatchCycle.ID
                                WHERE PatchCycle.ID = '".$_GET['patchID']."';");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $statementServer = $db->query("SELECT DISTINCT Computers.ID, Computers.Name
                                            FROM Patching
                                            JOIN Computers ON
                                            Computers.ID = Patching.Computers_id
                                            JOIN PatchSchedlue ON
                                            PatchSchedlue.ID = Patching.PatchSchedlue_id
                                            WHERE PatchSchedlue.PatchCycle_ID ='".$_GET['patchID']."';");
                $resultServer = $statementServer->fetchAll(PDO::FETCH_ASSOC);
            }
            elseif(isset($_POST['patchID']))
            {
                $statement = $db->query("SELECT PatchSchedlue.ID AS scheduleID,
                                PatchSchedlue.patchdate,PatchSchedlue.patchtime,
                                PatchCycle.Name,PatchCycle.ID AS id,PatchCycle.note
                                FROM PatchSchedlue
                                JOIN PatchCycle ON
                                PatchSchedlue.PatchCycle_ID = PatchCycle.ID
                                WHERE PatchCycle.ID = '".$_POST['patchID']."';");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                $statementServer = $db->query("SELECT DISTINCT Computers.ID, Computers.Name
                                            FROM Patching
                                            JOIN Computers ON
                                            Computers.ID = Patching.Computers_id
                                            JOIN PatchSchedlue ON
                                            PatchSchedlue.ID = Patching.PatchSchedlue_id
                                            WHERE PatchSchedlue.PatchCycle_ID ='".$_POST['patchID']."';");
                $resultServer = $statementServer->fetchAll(PDO::FETCH_ASSOC);
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
                    echo "<ul class='table-row row'>";

                    if(!(isset($_GET['patchID']) || isset($_POST['patchID'])))
                    {
                        //Select
                        echo "<li class='table-cell  col'>";
                        echo "<div class='table-cell-content'>";
                        echo "<input type='checkbox' name='patchid' class='selectValueChk' value='";
                        echo $row[id];
                        echo "'/>";
                        echo "</div>";
                        echo "</li>\r\n";
                    }

                    //Name
                    echo "<li class='table-cell  col'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    //date
                    if(isset($_GET['patchID']) || isset($_POST['patchID']))
                    {
                        echo "<li class='table-cell  col'>";
                        echo "<div class='table-cell-content'>";
                        echo empty($row[patchdate]) ? "&nbsp;" : $row[patchdate] ;
                        echo "</div>";
                        echo "</li>\r\n";
                    }

                    //time
                    if(isset($_GET['patchID']) || isset($_POST['patchID']))
                    {
                        echo "<li class='table-cell  col'>";
                        echo "<div class='table-cell-content'>";
                        echo empty($row[patchtime]) ? "&nbsp;" : $row[patchtime] ;
                        echo "</div>";
                        echo "</li>\r\n";
                    }

                    //Notes
                    echo "<li class='table-cell  col'>";
                    echo "<div class='table-cell-content'>";
                    echo empty($row[note]) ? "&nbsp;" : $row[note] ;
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
                echo "<ul class='table-row row'><li class='table-cell  col'>
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
<form method="post" action="servers.php">
        <?php

            if(count($resultServer) > 0)
            {
                echo "<div class='table-div'>";
                echo "<h3>Current Servers</h3>";

                echo " <div class='table-div'>
                <ul class='table-row row'>
                    <li class='table-cell col'>
                        <div class='table-cell-content'>
                           <input type='button' class='contentButtons buttonVisible' />
                        </div>
                    </li>\r\n
                    <li class='table-cell col'>
                        <div class='table-cell-content patchingBtn'>
                        <input type='submit' class='contentButtons'  value='View Computer' />
                        </div>
                    </li>\r\n
                </ul>";

                echo " <ul class='table-row row'>
                    <li class='table-cell col'>
                        <div class='table-cell-head-content'>
                            Select
                        </div>
                    </li>\r\n
                    <li class='table-cell col'>
                        <div class='table-cell-head-content'>
                            Name
                        </div>
                    </li>\r\n
                </ul>";

                foreach($resultServer as $row)
                {
                    echo "<ul class='table-row row'>";

                    //Select
                    echo "<li class='table-cell col'>";
                    echo "<div class='table-cell-content'>";
                    echo "<input type='checkbox' name='serverID' class='selectValueChk' value='";
                    echo $row[id];
                    echo "'/>";
                    echo "</div>";
                    echo "</li>\r\n";

                    //Name
                    echo "<li class='table-cell col'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    echo "</ul>";
                }
                echo "</div>";
            }

            ?>

</form>



        <div class="footer">

        </div>
    <script>
        var getVar = "<?php echo "patchID" ?>";

        </script>
    </body>
</html>

