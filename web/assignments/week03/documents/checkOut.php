

<?php include "header-checkout.php"; ?>


<?php


?>


<div class="content">
    <form method="post" action="confirmation.php">
        <table class="addressTable">
            <tr>
                <td>
                    <label for="nameTxb">Name</label>
                </td>
                <td>
                    <input type="text" name="nameTxb" id="nameTxb" />
                </td>
            </tr>

            <tr>
                <td>
                    <label for="addressTxb">Address</label>
                </td>
                <td>
                    <input type="text" name="addressTxb" id="addressTxb" />
                </td>
            </tr>

            <tr>
                <td>
                    <label for="cityTxb">City</label>
                </td>
                <td>
                    <input type="text" name="cityTxb" id="cityTxb" />
                </td>
            </tr>

            <tr>
                <td>
                    <label for="stateTxb">State</label>
                </td>
                <td>
                    <input type="text" name="stateTxb" id="stateTxb" />
                </td>
            </tr>

            <tr>
                <td>
                    <label for="zipTxb">Zip</label>
                </td>
                <td>
                    <input type="text" name="zipTxb" id="zipTxb" />
                </td>
            </tr>


            <tr>
                <td class="buttonsTd">
                    <a href="cart.php">
                        <input type='button' value='Return to Cart' class='buttons cartReturnBtn' />
                    </a>
                </td>
                <td class="buttonsTd">
                    <input type='button' value='Complete Order' class='buttons completeOrderBtn' />
                </td>
            </tr>
        </table>


    </form>
</div>

<div class="footer">

</div>
<script type="text/javascript" >

</script>
</body>
</html>



