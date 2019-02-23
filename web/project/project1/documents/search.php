<?php



?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3 class="pageName">Search</h3>
            <form method="post" action="search.results.php">
                 <table class="searchTable">
                    <tr>
                        <td>
                            <label>
                                Seach Type:
                            </label>
                        </td>
                        <td>
                            <select id="searchtype" name="searchtype">
                                <option value="any">ANY</option>
                                <option value="computer">Computer</option>
                                <option value="patch">Patch</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Search Term</label>
                        </td>
                        <td>
                            <input name="searchTerm" type="text"/>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>
                            <input type="submit" value="Search"/>
                        </td>
                    </tr>
                </table>
            </form>


        </div>

        <div class="footer">

        </div>
    </body>
</html>

