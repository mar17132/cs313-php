<?php


?>



<?php include "header-docs.php"; ?>

        <div class="content">
<form method="post" action="addserver.php">
            <div class="table-div">
                <h3>Computers</h3>
                <ul class="table-row row">
                    <li class="table-cell col">
                        <div class="table-cell-content">

                                <?php

                                if(isset($_POST['serverID']))
                                {
                                   echo "<input type='button' class='contentButtons buttonVisible' />
                                   <input type='hidden' value='".$_POST['serverID']."' name='serverID' />";
                                }
                                elseif(isset($_GET['serverID']))
                                {
                                   echo "<input type='button' class='contentButtons buttonVisible' />
                                   <input type='hidden' value='".$_GET['serverID']."' name='serverID' />";
                                }
                                else
                                {
                                    echo "<a href='servers.php' id='viewSelected' class='addContent'>
                                    <input type='button' class='contentButtons' value='View Server' /></a>";
                                }

                                ?>
                        </div>
                    </li>

                   <li class="table-cell col <?php
                              if(isset($_GET['serverID']) || isset($_POST['serverID']))
                              {
                                  echo "hidden";
                              }
                              ?> ">
                        <div class="table-cell-content">
                           <a href="addserver.php" class="addContent">
                                <input type="button" class="contentButtons"  value="Add Server" />
                            </a>
                        </div>
                    </li>
                    <li class="table-cell col">
                        <div class="table-cell-content">
                                <input type="submit" class="contentButtons"  value="Edit Server" />
                        </div>
                    </li>
                </ul>

                <ul class="table-row row">

                    <li class="table-cell col <?php
                              if(isset($_GET['serverID']) || isset($_POST['serverID']))
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
                    <li class="table-cell col">
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

            $statement = null;
            $result = null;
            $patchStatement = null;
            $patchResults = null;

            if(isset($_GET['serverID']))
            {
                $statement = $db->query("SELECT * FROM Computers WHERE ID ='".$_GET['serverID']."';");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $patchStatement = $db->query("SELECT DISTINCT PatchCycle.ID, PatchCycle.Name
                                    FROM Patching
                                    JOIN PatchSchedlue ON
                                    PatchSchedlue.ID = Patching.PatchSchedlue_id
                                    JOIN PatchCycle ON
                                    PatchCycle.ID = PatchSchedlue.PatchCycle_ID
                                    WHERE Patching.Computers_id ='".$_GET['serverID']."';");
                $patchResults = $patchStatement->fetchAll(PDO::FETCH_ASSOC);
            }
            elseif(isset($_POST['serverID']))
            {
                $statement = $db->query("SELECT * FROM Computers WHERE ID ='".$_POST['serverID']."';");
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $patchStatement = $db->query("SELECT DISTINCT PatchCycle.ID, PatchCycle.Name
                                    FROM Patching
                                    JOIN PatchSchedlue ON
                                    PatchSchedlue.ID = Patching.PatchSchedlue_id
                                    JOIN PatchCycle ON
                                    PatchCycle.ID = PatchSchedlue.PatchCycle_ID
                                    WHERE Patching.Computers_id ='".$_POST['serverID']."';");
                $patchResults = $patchStatement->fetchAll(PDO::FETCH_ASSOC);
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
                    echo "<ul class='table-row row'>";

                    if(!(isset($_GET['serverID']) || isset($_POST['serverID'])))
                    {
                        //Select
                        echo "<li class='table-cell col'>";
                        echo "<div class='table-cell-content'>";
                        echo "<input type='checkbox' name='serverid' class='selectValueChk' value='";
                        echo $row[id];
                        echo "'/>";
                        echo "</div>";
                        echo "</li>\r\n";
                    }

                    //Name
                    echo "<li class='table-cell col'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Notes
                    echo "<li class='table-cell col'>";
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
                echo "<ul class='table-row row'><li class='table-cell col'>
                     <div class='table-cell-content'>";
                echo "No current Patch Cycles";
                echo "</div></li></ul>";
            }
            ?>

            </div>
             </form>

            <form method="post" action="patching.php">
            <?php
            if(count($patchResults) > 0)
            {
                echo "<div class='table-div'>";
                echo "<h3>Current Patch Cycles</h3>";

                echo " <div class='table-div'>
                <ul class='table-row row'>
                    <li class='table-cell col'>
                        <div class='table-cell-content'>
                           <input type='button' class='contentButtons buttonVisible' />
                        </div>
                    </li>\r\n
                    <li class='table-cell col'>
                        <div class='table-cell-content'>
                        <input type='submit' class='contentButtons'  value='View Patch' />
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

                foreach($patchResults as $row)
                {
                    echo "<ul class='table-row row'>";

                    //Select
                    echo "<li class='table-cell col'>";
                    echo "<div class='table-cell-content'>";
                    echo "<input type='checkbox' name='patchID' class='selectValueChk' value='";
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


    </form>
        </div>

        <div class="footer" >

        </div>

        <script>
var getVar = "<?php echo "serverID" ?>";

        </script>
    </body>
</html>

