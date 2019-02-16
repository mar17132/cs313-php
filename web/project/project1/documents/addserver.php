<?php

include "../scripts/db.php";

$pageTitle;
$serverID;
$serverArray;
$patchArray;


if(count($_POST) > 0)
{
  $pageTitle = "Edit Server";
  $serverID = $_POST["serverid"];
}
else
{
    $pageTitle = "Add Server";
}

if(isset($serverID))
{
    //server
    $statement = $db->query("SELECT * FROM Computers WHERE ID='$serverID';");
    $serverArray = $statement->fetchAll(PDO::FETCH_ASSOC);

    //patch
    $statementPatch = $db->query("SELECT PatchCycle.ID, PatchCycle.Name
                                  FROM PatchCycle
                                  JOIN PatchSchedlue ON
                                  PatchCycle.ID = PatchSchedlue.PatchCycle_ID
                                  JOIN Patching ON
                                  PatchSchedlue.PatchCycle_ID = Patching.ID
                                  WHERE Patching.Computers_id ='$serverID';");
    $patchArray = $statement->fetchAll(PDO::FETCH_ASSOC);
}


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3><?php echo $pageTitle; ?></h3>
            <form method="post" action="servers.php">
                <ul>
                    <li>
                        <label>Server Name</label>
                    </li>
                    <li>
                        <input type="text" id="servernameTxt" name="servernameTxt"
                               value="<?php
                                       echo isset($serverArray)
                                           ? $serverArray[0][name] : "";
                                      ?>"/>
                        <input type="hidden" id="serverID" name="serverID"
                            value="<?php
                                    echo isset($serverID) ? $serverID : 'null';
                                    ?>" />
                    </li>
                    <li>
                        <label>IP Address</label>
                    </li>
                    <li>
                        <input type="text" id="ipaddressTxt" name="ipaddressTxt"
                               value="<?php
                                       echo isset($serverArray)
                                           ? $serverArray[0][ip] : "";
                                      ?>"/>
                    </li>
                    <li>
                        <label>Patches</label>
                        <div>
                            <ul>
                                <?php

                                foreach($db->query("SELECT * FROM PatchCycle;") as $row)
                                {
                                    echo "<input value='$row[id]'
                                          name='patches[]' type='checkbox'";
                                    if(isset($patchArray))
                                    {
                                        foreach($patchArray as $patch)
                                        {
                                            if(in_array($row[id],$patch))
                                            {
                                                echo "checked='checked'";
                                            }
                                        }
                                    }
                                    echo "/>";
                                    echo "<span>$row[name]</span><br/>";
                                }

                                ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </form>
        </div>

        <div class="footer">

        </div>
    </body>
</html>

