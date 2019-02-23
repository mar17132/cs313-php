<?php

include "../scripts/db.php";

$pageTitle;
$serverID;
$serverArray;
$patchArray;


if(count($_POST) > 0)
{
    if(isset($_POST['addType']))
    {
        switch($_POST['addType'])
        {
            case "update":
                $db->query("UPDATE Computers
                          SET Name='".$_POST['servernameTxt']."',
                          IP='".$_POST['ipaddressTxt']."'
                          WHERE ID='".$_POST["serverID"]."';");

                $statementPatchCycle = $db->query("SELECT * FROM PatchCycle;");
                $resultsPatchCycle = $statementPatchCycle->fetchAll(PDO::FETCH_ASSOC);
                foreach($resultsPatchCycle as $row)
                {
                    if(in_array($row[id],$_POST["patches"]))
                    {
                        $statement = $db->query("SELECT * FROM Patching WHERE
                                               Computers_id ='".$_POST["serverID"]."'
                                               AND PatchSchedlue_id ='$row[id]';");
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                        if(count($results) == 0)
                        {
                            $db->query("INSERT INTO
                                      Patching(Computers_id,PatchSchedlue_id)
                                      VALUES(".$_POST["serverID"].",$row[id]);");
                        }

                    }
                    else
                    {
                        $statement = $db->query("SELECT * FROM Patching WHERE
                                       Computers_id ='".$_POST["serverID"]."'
                                       AND PatchSchedlue_id ='$row[id]';");
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                        if(count($results) != 0)
                        {
                            $db->query("DELETE FROM Patching WHERE
                            PatchSchedlue_id ='$row[id]'
                            AND Computers_id = '".$_POST["serverID"]."';");
                        }
                    }
                }
               // $db->query();
                header("Location:servers.php");
                break;
            case "delete":
                $db->query("DELETE FROM Patching WHERE Computers_id = '".$_POST["serverID"]."';");
                $db->query("DELETE FROM Computers WHERE ID='".$_POST["serverID"]."';");
                header("Location:servers.php");
                break;
            case "add":
                $db->query("INSERT INTO Computers(Name,IP)
                        VALUES('".$_POST['servernameTxt']."','".
                           $_POST['ipaddressTxt']."');");

                $newServerID = $db->lastInsertId('Computers_id_seq');
                foreach($_POST["patches"] as $newPatch)
                {
                    $db->query("INSERT INTO Patching(Computers_id,PatchSchedlue_id)
                                VALUES($newServerID,$newPatch);");
                }
                header("Location:servers.php");
                break;
        }
    }
    else
    {
        $pageTitle = "Edit Server";
        $serverID = $_POST["serverid"];
    }

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
    $statementPatch = $db->query("SELECT DISTINCT PatchCycle.ID, PatchCycle.Name
                                FROM Patching
                                JOIN PatchSchedlue
                                ON PatchSchedlue.ID = Patching.PatchSchedlue_id
                                JOIN PatchCycle
                                ON PatchCycle.ID = PatchSchedlue.PatchCycle_ID
                                WHERE Patching.Computers_id ='$serverID';");
    $patchArray = $statementPatch->fetchAll(PDO::FETCH_ASSOC);
}


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <div class="addContent-div">
            <h3><?php echo $pageTitle; ?></h3>
            <form method="post" action="addserver.php">
                <ul class="addContent-ul">
                    <li class="addContent-li">
                        <label>Server Name</label>
                    </li>
                    <li class="addContent-li">
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
                    <li class="addContent-li">
                        <label>IP Address</label>
                    </li>
                    <li class="addContent-li">
                        <input type="text" id="ipaddressTxt" name="ipaddressTxt"
                               value="<?php
                                       echo isset($serverArray)
                                           ? $serverArray[0][ip] : "";
                                      ?>"/>
                    </li>
                    <li class="addContent-li">
                        <label>Patches</label>
                        <div>
                            <ul class="addContent-ul">
                                <?php

                                foreach($db->query("SELECT * FROM PatchCycle;") as $row)
                                {
                                    echo "<li class='addContent-li' >";
                                    echo "<input value='$row[id]'
                                          name='patches[]' type='checkbox'";
                                    if(isset($patchArray))
                                    {
                                        foreach($patchArray as $patch)
                                        {
                                            if($row[id] == $patch[id])
                                            {
                                                echo "checked='checked'";
                                            }
                                        }
                                    }
                                    echo "/>";
                                    echo "&nbsp;&nbsp;<span>$row[name]</span>";
                                    echo "</li>";
                                }

                                ?>
                            </ul>
                        </div>
                    </li>

                </ul>

                <div class="addContentBtn-wrap" >
                <?php
                if(isset($serverID))
                {
                    echo "<div class='addContentBtn '>";
                    echo "<input type='hidden' name='addType' value='update' />";
                    echo "<input type='submit' class='addContentBtn' name='update' value='Update' />";
                    echo "</div>";
                }
                else
                {
                    echo "<div class=''>";
                    echo "<input type='hidden' name='addType' value='add' />";
                    echo "<input type='submit' class='addContentBtn ' name='update' value='Add' />";
                    echo "</div>";
                }
                ?>

            <?php

                if(isset($serverID))
                {
                   echo "<div class='addContentBtn '>
                        <form action='addserver.php' method='post'>
                        <input type='hidden' name='serverID' value='$serverID'/>
                        <input type='submit'  class='addContentBtn' name='addType' value='delete' />
                        </form></div>";
                }
                ?>
            </div>
                </form>
            </div>
        </div>

        <div class="footer">

        </div>
    </body>
</html>

