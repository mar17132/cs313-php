

<?php

    $cartArray = getSessionCart();

?>


<?php include "header-cart.php"; ?>

<div class="content">
    <div class="cart-items">
        <ul class="cart-items-ul">

                <?php

                    foreach($cartArray as $prod)
                    {
                        echo " <li class='cart-items-li'>
                        <div class='cart-item'>
                        <ul class='cart-item-ul'>";

                        //item image
                        echo "<li class='cart-item-li'>";
                        echo "<img class='cart-itemImage'
                              alt='".$items[$prod]["itemName"]."'
                              src='".$items[$prod]["itemImage"]."' />";
                        echo "</li>";

                        //item name
                        echo "<li class='cart-item-li'>";
                        echo "<span class='cart-itemName'>";
                        echo $items[$prod]["itemName"];
                        echo "</span></li>";

                        //item price
                        echo "<li class='cart-item-li'>";
                        echo "<span class='cart-itemPrice'>";
                        echo $items[$prod]["itemPrice"];
                        echo "</span></li>";

                        //remove button
                        echo "<li class='cart-item-li'>";
                        echo "<input type='button' value='Remove'
                              class='buttons removeCartBtn' />";
                        echo "<input class='itemID' type='hidden'
                                value='$prod'/>";
                        echo "</li>";

                        echo "</ul></div></li>";
                    }

                ?>


            <li class="cart-items-li">
                <table class="totals">
                    <tr>
                        <td>
                             <span class="totals">
                                Subtotal
                            </span>
                        </td>
                        <td>
                            <span class="totals" id="subTotal"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="totals">
                                Tax
                            </span>
                        </td>
                        <td>
                            <span class="totals" id="tax">
                                .0625
                            </span>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <span class="totals">
                                Shipping
                            </span>
                        </td>
                        <td>
                            <span class="totals" id="shipping">
                                $3.00
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="totals">
                                Total
                            </span>
                        </td>
                        <td>
                            <span class="totals" id="total"></span>
                        </td>
                    </tr>
                </table>

            </li>

            <li class="cart-items-li">
                <input type="button" value="Checkout" class="buttons checkoutCartBtn" />
            </li>
        </ul>
    </div>
</div>

<div class="footer">

</div>


<script type="text/javascript" > </script>
</body>
</html>



