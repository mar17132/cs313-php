

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
            <form id="week03Form" action="process.php" method="post" >
                <table>
                    <tr>
                        <td>
                            <label for="nameTxb">Name</label>
                        </td>
                        <td>
                            <input type="text" id="nameTxb" name="nameTxb"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="emailTxb">Email</label>
                        </td>
                        <td>
                            <input type="text" id="emailTxb" name="emailTxb"/>
                        </td>
                    </tr>
                
                </table>
                <br/>
                <label>Major</label><br/>
                <input type="radio" name="major" value="Computer Science" /> Computer Science <br/>
                <input type="radio" name="major" value="Web Design and Development" /> Web Design and Development <br/>
                <input type="radio" name="major" value="Computer information Technology" /> Computer information Technology <br/>
                <input type="radio" name="major" value="Computer Engineering" /> Computer Engineering <br/>
                
                <label>Comments</label>
                <textarea name="comments"></textarea>
                
                <label>Continets that you have visited</label><br/>
                <input type="checkbox" name="continets[]" value="North America" />North America <br/>
                <input type="checkbox" name="continets[]" value="South America" />South America <br/>
                <input type="checkbox" name="continets[]" value="Europe" />Europe <br/>
                <input type="checkbox" name="continets[]" value="Asia" />Asia <br/>
                <input type="checkbox" name="continets[]" value="Africa" />Africa <br/>
                <input type="checkbox" name="continets[]" value="Antarctica" />Antarctica <br/>
                <input type="checkbox" name="continets[]" value="Australia" />Australia <br/>
                
            
            </form>
        </div>

        <script>


        </script>
    </body>
</html>



