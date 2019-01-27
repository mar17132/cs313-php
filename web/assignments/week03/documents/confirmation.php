

<?php

    include_once "../scripts/session.manage.script.php";

    $itemsArray = getSessionCart();
    unset($_SESSION["cart"]);


?>


<?php

include "header-confirmation.php";

$name = filter_var($_POST["nameTxb"],FILTER_SANITIZE_STRING);
$address = filter_var($_POST["addressTxb"],FILTER_SANITIZE_STRING);
$city = filter_var($_POST["cityTxb"],FILTER_SANITIZE_STRING);
$state = filter_var($_POST["stateTxb"],FILTER_SANITIZE_STRING);
$zip = filter_var($_POST["zipTxb"],FILTER_SANITIZE_STRING);

?>


<div class="content">
        <h1>Thank you</h1>

        <h2>Shipping</h2>
        <table class="confirmationTable">
            <tr>
                <td>
                    <label for="nameTxb">Name</label>
                </td>
                <td>
                    <?php echo $name; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="addressTxb">Address</label>
                </td>
                <td>
                    <?php echo $address; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="cityTxb">City</label>
                </td>
                <td>
                    <?php echo $city; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="stateTxb">State</label>
                </td>
                <td>
                    <?php echo $state; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="zipTxb">Zip</label>
                </td>
                <td>
                    <?php echo $zip; ?>
                </td>
            </tr>
        </table>
        <br/><br/>


        <h2>Items</h2>
        <div class="cart-items">
        <ul class="cart-items-ul">

                <?php

                    foreach($itemsArray as $prod)
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

                        echo "</ul></div></li>";
                    }

                ?>
            </ul>
        </div>

</div>

<div class="footer">

</div>
<script type="text/javascript" >

</script>
</body>
</html>



