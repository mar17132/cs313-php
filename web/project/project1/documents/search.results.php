<?php


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3>Search Results</h3>
            <div class="table-results-div">

            <?php

            $resultArray = search($_POST['searchtype'],$_POST['searchTerm']);

            print_r($resultArray);

            echo "\r\ncount=".count($resultArray);
            echo "\r\n".$resultArray;



            if(count($resultArray) > 0)
            {
                foreach($resultArray as $key => $row)
                {
                    echo "<ul class='table-results-row'>";

                    //Name
                    echo "<li class='table-results-cell'>";
                    echo "<div class='table-cell-results-content'>";
                    echo $row[name];
                    echo "</div>";
                    echo "</li>\r\n";

                    //Notes
                    echo "<li class='table-results-cell'>";
                    echo "<div class='table-cell-results-content'>";
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

