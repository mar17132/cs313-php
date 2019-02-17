<?php

include "../scripts/db.php";

$pageTitle;
$patchID;
$patchCyclesArray;
$patchArray;


if(count($_POST) > 0)
{
    if(isset($_POST['addType']))
    {
        switch($_POST['addType'])
        {
            case "update":
                $db->query("UPDATE PatchCycle
                          SET Name='".$_POST['patchnameTxt']."',
                          Notes='".$_POST['patchnotesTxt']."'
                          WHERE ID='".$_POST["patchID"]."';");

                /*$statementPatchCycle = $db->query("SELECT * FROM PatchCycle;");
                $resultsPatchCycle = $statementPatchCycle->fetchAll(PDO::FETCH_ASSOC);
                foreach($resultsPatchCycle as $row)
                {
                    if(in_array($row[id],$_POST["patches"]))
                    {
                        $statement = $db->query("SELECT * FROM Patching WHERE
                                               Computers_id ='".$_POST["patchID"]."'
                                               AND PatchSchedlue_id ='$row[id]';");
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                        if(count($results) == 0)
                        {
                            $db->query("INSERT INTO
                                      Patching(Computers_id,PatchSchedlue_id)
                                      VALUES(".$_POST["patchID"].",$row[id]);");
                        }

                    }
                    else
                    {
                        $statement = $db->query("SELECT * FROM Patching WHERE
                                       Computers_id ='".$_POST["patchID"]."'
                                       AND PatchSchedlue_id ='$row[id]';");
                        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                        if(count($results) != 0)
                        {
                            $db->query("DELETE FROM Patching WHERE
                            PatchSchedlue_id ='$row[id]'
                            AND Computers_id = '".$_POST["patchID"]."';");
                        }
                    }
                }*/
               // $db->query();
                header("Location:patching.php");
                break;
           /* case "delete":
                $db->query("DELETE FROM Patching WHERE Computers_id = '".$_POST["patchID"]."';");
                $db->query("DELETE FROM Computers WHERE ID='".$_POST["patchID"]."';");
                header("Location:patching.php");
                break;*/
            case "add":
                $db->query("INSERT INTO PatchCycle(Name,Notes)
                        VALUES('".$_POST['patchnameTxt']."','".
                           $_POST['patchnotesTxt']."');");

                /*$newpatchID = $db->lastInsertId('Computers_id_seq');
                foreach($_POST["patches"] as $newPatch)
                {
                    $db->query("INSERT INTO Patching(Computers_id,PatchSchedlue_id)
                                VALUES($newpatchID,$newPatch);");
                }*/
                header("Location:patching.php");
                break;
        }
    }
    else
    {
        $pageTitle = "Edit Patch";
        $patchID = $_POST["patchID"];
    }

}
else
{
    $pageTitle = "Add Patch";
}

if(isset($patchID))
{
    //server
    $statement = $db->query("SELECT * FROM PatchCycle WHERE ID='$patchID';");
    $patchCyclesArray = $statement->fetchAll(PDO::FETCH_ASSOC);

    //patch
   /* $statementPatch = $db->query("SELECT DISTINCT PatchCycle.ID, PatchCycle.Name
                                FROM Patching
                                JOIN PatchSchedlue
                                ON PatchSchedlue.ID = Patching.PatchSchedlue_id
                                JOIN PatchCycle
                                ON PatchCycle.ID = PatchSchedlue.PatchCycle_ID
                                WHERE Patching.Computers_id ='$patchID';");
    $patchArray = $statementPatch->fetchAll(PDO::FETCH_ASSOC);*/
}


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <h3><?php echo $pageTitle; ?></h3>
            <form method="post" action="addserver.php">
                <ul>
                    <li>
                        <label>Server Name</label>
                    </li>
                    <li>
                        <input type="text" id="patchnameTxt" name="patchnameTxt"
                               value="<?php
                                       echo isset($patchCyclesArray)
                                           ? $patchCyclesArray[0][name] : "";
                                      ?>"/>
                        <input type="hidden" id="patchID" name="patchID"
                            value="<?php
                                    echo isset($patchID) ? $patchID : 'null';
                                    ?>" />
                    </li>
                    <li>
                        <label>IP Address</label>
                    </li>
                    <li>
                        <input type="text" id="patchnotesTxt" name="patchnotesTxt"
                               value="<?php
                                       echo isset($patchCyclesArray)
                                           ? $patchCyclesArray[0][notes] : "";
                                      ?>"/>
                    </li>

                </ul>

                <?php
                if(isset($patchID))
                {
                    echo "<input type='hidden' name='addType' value='update' />";
                    echo "<input type='submit' name='update' value='Update' />";
                }
                else
                {
                    echo "<input type='hidden' name='addType' value='add' />";
                    echo "<input type='submit' name='update' value='Add' />";
                }
                ?>
            </form>
            <?php

               /* if(isset($patchID))
                {
               echo "<form action='addserver.php' method='post'>
                    <input type='hidden'' name='patchID' value='$patchID'/>
                    <input type='submit' name='addType' value='delete' />
                    </form>";
                }*/
                ?>
        </div>

        <div class="footer">

        </div>
    </body>
</html>

