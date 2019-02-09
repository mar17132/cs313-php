<?php


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3>Search Results</h3>
            <div class="table-results-div">

            <?php

            $resultArray = search($_POST['searchtype'],$_POST['searchTerm'],$db);


            if(count($resultArray) > 0)
            {
                foreach($resultArray as $key => $row)
                {
                    $linkpage;

                    if($key == "computer")
                    {
                        $linkpage = "server.php?serverID=";
                    }
                    else
                    {
                        $linkpage = "patching.php?patchID=";
                    }

                    foreach($row as $searchedResluts)
                    {
                        echo "<ul class='table-results-row'>";

                        //Name
                        echo "<li class='table-results-cell'>";
                        echo "<div class='table-cell-results-content'>";
                        echo "<a href='".$baseURL.$location."/documents/".$linkpage."$searchedResluts[id]'>";
                        echo $searchedResluts[name];
                        echo "</a></div>";
                        echo "</li>\r\n";

                        echo "</ul>";
                    }
                }
            }
            else
            {
                echo "<ul class='table-results-row'><li class='table-cell'>
                     <div class='table-cell-results-content'>";
                echo "No Results";
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

