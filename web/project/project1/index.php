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
            <?php

            foreach($db->query("SELECT ") as $row)
            {

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

        <div class="footer">

        </div>
    </body>
</html>

