

<?php


?>

<?php include "documents/header-index.php"; ?>


    <div class="content">
            <div class="items">

                <div class="item">
                    <a class="item-link">
                        <ul class="item-ul">

                                <?php

                                    foreach($items as $key => $prod)
                                    {
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

                                    }

                                ?>
                        </ul>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer">

        </div>


        <script type="text/javascript" > </script>
    </body>
</html>

