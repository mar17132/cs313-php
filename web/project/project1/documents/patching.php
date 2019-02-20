<?php


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3>Patche Cycles</h3>
            <form method="post" action="addpatch.php">
            <div class="table-div">
                <ul class="table-row row">
                    <li class="table-cell col">
                        <div class="table-cell-content">
                           <input type="button" class="contentButtons buttonVisible" />
                        </div>
                    </li>
                    <li class="table-cell col">
                        <div class="table-cell-content">
                           <a href="addpatch.php" class="addContent">
                                <input type="button" class="contentButtons"  value="Add Patch" />
                            </a>
                        </div>
                    </li>
                    <li class="table-cell col">
                        <div class="table-cell-content">

                        <input type="submit" class="contentButtons"  value="Edit Patch" />

                        </div>
                    </li>
                </ul>

                <ul class="table-row row">
                    <li class="table-cell col">
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
                    echo "<ul class='table-row row'>";

                                        //Select
                    echo "<li class='table-cell  col'>";
                    echo "<div class='table-cell-content'>";
                    echo "<input type='checkbox' name='patchid' class='selectValueChk' value='";
                    echo $row[id];
                    echo "'/>";
                    echo "</div>";
                    echo "</li>\r\n";

                    //Name
                    echo "<li class='table-cell  col'>";
                    echo "<div class='table-cell-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Notes
                    echo "<li class='table-cell  col'>";
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

        <div class="footer">

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

