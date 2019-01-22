

<?php


?>

<?php include "documents/header-index.php"; ?>


    <div class="content">

                <?php

                    $loopCounter = 0;

                    foreach($items as $key => $prod)
                    {
                        if($loopCounter % 4 == 0)
                        {
                            echo "div class='items'>";
                        }

                        echo "<div class='item'>
                              <a class='item-link'>
                              <ul class='item-ul'>";

                        //item Image
                        echo "<li class='item-li'>";
                        echo "<img class='itemImage'
                              alt='".$prod["itemName"]."'
                              src='".$prod["itemImage"]."' />";
                        echo "</li>";

                        //item Name & price
                        echo "<li class='item-li'>";
                        echo "<span class='itemName'>";
                        echo $prod["itemName"]."<br/><br/>";
                        echo $prod["itemPrice"];
                        echo "</span></li>";

                        //item button
                        echo "<li class='item-li'>";
                        echo "<input class='addCartBtn buttons'
                              value='Add To Cart' type='button'/>";
                        echo "<input class='itemID' type='hidden'
                              value='$key'/>";
                        echo "</li>";

                        echo "</ul></a></div>";

                        if($loopCounter % 4 == 0)
                        {
                            echo "</div>";
                        }

                        $loopCounter++;

                    }

                ?>

        </div>

        <div class="footer">

        </div>


        <script type="text/javascript" > </script>
    </body>
</html>

