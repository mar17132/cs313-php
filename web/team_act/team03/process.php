

<?php


?>

<!DOCTYPE HTML>

<html lang="en" >
    <head>
	<meta charset="utf-8" />
        <title>week03 team act</title>
        <style type="text/css">

        </style>    
    </head>
    <body>

        <div class="content" >
            <table>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['nameTxb']; ?></span>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['emailTxb']; ?></span>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <label>Major</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['major']; ?></span>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <label>Comments</label>
                    </td>
                    <td>
                        <span><?php echo $_POST['comments']; ?></span>
                    </td>                
                </tr>            
            </table>
            <br/><br/>
            <label>Continets that you have visited</label><br/>
            <p>
                <?php
                    foreach($_POST['continets'] as $selected)
                    {
                        echo $selected."<br/>";
                    }
                
                ?>
            </p>

        </div>

        <script>


        </script>
    </body>
</html>


