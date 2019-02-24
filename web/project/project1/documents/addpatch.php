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
                //PatchCycle
                $db->query("UPDATE PatchCycle
                          SET Name='".$_POST['patchnameTxt']."',
                          Note='".$_POST['patchnotesTxt']."'
                          WHERE ID='".$_POST["patchID"]."';");

                //$newpatchID = $db->lastInsertId('PatchCycle_id_seq');

                //PatchSchulde
                $db->query("UPDATE PatchSchedlue
                            SET
                            PatchDate = '".$_POST['patchDateTxt']."',
                            PatchTime = '".$_POST['patchTimeTxt']."'
                            WHERE PatchCycle_ID = '".$_POST["patchID"]."';");

                $statement = $db->query("SELECT * FROM PatchSchedlue
                    WHERE PatchCycle_ID ='".$_POST["patchID"]."';");
                $newPatchSchID = $statement->fetchAll(PDO::FETCH_ASSOC);


                //patching
                foreach($newPatchSchID as $id)
                {
                    echo "test1";
                    $statementPatching = $db->query("SELECT * FROM Computers;");
                    $resultsPatching= $statementPatching->fetchAll(PDO::FETCH_ASSOC);

                    foreach($resultsPatching as $serverPatch)
                    {
                        echo $id['computers_id'];
                        print_r($id);
                        echo "test5";
                        if(in_array($id['computers_id'],$_POST["servers"]))
                        {
echo "test6";
                            $statement = $db->query("SELECT * FROM Patching WHERE
                            PatchSchedlue_id ='".$_POST["patchID"]."'
                            AND Computers_id='".$serverPatch[id]."';");
                            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                            if(count($results) == 0)
                            {
                                $db->query("INSERT INTO
                                Patching(Computers_id,PatchSchedlue_id)
                                VALUES($serverPatch[id],".$_POST["patchID"].");");
                            }
                        }
                        else
                        {
                            echo "test9";
                            $statement = $db->query("SELECT * FROM Patching WHERE
                            PatchSchedlue_id ='".$_POST["patchID"]."'
                            AND Computers_id='$serverPatch[id]';");
                            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                            if(count($results) != 0)
                            {
                                $db->query("DELETE FROM Patching WHERE
                                Computers_id='$serverPatch[id]'
                                AND PatchSchedlue_id = '".$_POST["patchID"]."';");
                            }
                        }


                    }
                }

              //  header("Location:patching.php");
                break;
            case "delete":

                foreach($db->query("SELECT * FROM PatchSchedlue
                 WHERE PatchCycle_ID ='".$_POST["patchID"]."';") as $patchSchID)
                {
                    $db->query("DELETE FROM Patching WHERE
                    PatchSchedlue_id = '".$patchSchID["id"]."';");
                }
                $db->query("DELETE FROM PatchSchedlue WHERE PatchCycle_ID='".$_POST["patchID"]."';");
                $db->query("DELETE FROM PatchCycle WHERE ID='".$_POST["patchID"]."';");
                header("Location:patching.php");
                break;
            case "add":
                //PatchCycle
                $db->query("INSERT INTO PatchCycle(Name,Note)
                VALUES('".$_POST['patchnameTxt']."','".$_POST['patchnotesTxt']."');");

                $newpatchID = $db->lastInsertId('PatchCycle_id_seq');

                //PatchSchulde
                $db->query("INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
                VALUES($newpatchID,'".$_POST['patchDateTxt']."',
                '".$_POST['patchTimeTxt']."');");

                $newPatchSchID = $db->lastInsertId('PatchSchedlue_id_seq');


                //patching
                foreach($_POST["servers"] as $newServer)
                {
                    $db->query("INSERT INTO Patching(Computers_id,PatchSchedlue_id)
                                VALUES($newServer,$newPatchSchID);");
                }
                header("Location:patching.php");
                break;
        }
    }
    else
    {

        $pageTitle = "Edit Patch";
        $patchID = $_POST["patchid"];
    }

}
else
{
    $pageTitle = "Add Patch";
}

if(isset($patchID))
{
    //patch
    $statement = $db->query("SELECT PatchCycle.ID, PatchCycle.Name, PatchCycle.Note,
                            PatchSchedlue.PatchDate,PatchSchedlue.PatchTime
                            FROM PatchCycle
                            JOIN PatchSchedlue ON
                            PatchSchedlue.PatchCycle_ID = PatchCycle.ID
                            WHERE PatchCycle.ID='$patchID';");
    $patchCyclesArray = $statement->fetchAll(PDO::FETCH_ASSOC);

    //server
    $statementServer = $db->query("SELECT DISTINCT Computers.ID, Computers.Name
                                FROM Patching
                                JOIN Computers
                                ON Computers.ID = Patching.Computers_id
                                JOIN PatchSchedlue
                                ON PatchSchedlue.ID = Patching.PatchSchedlue_id
                                WHERE PatchSchedlue.PatchCycle_ID ='$patchID';");
    $serverArray = $statementServer->fetchAll(PDO::FETCH_ASSOC);

}


?>



<?php include "header-docs.php"; ?>

        <div class="content">
            <div class="addContent-div">
            <h3 class="pageName"><?php echo $pageTitle; ?></h3>
            <form method="post" action="addpatch.php">
                <ul class="addContent-ul">
                    <li class="addContent-li">
                        <label>Patch Name</label>
                    </li>
                    <li class="addContent-li">
                        <input type="text" id="patchnameTxt" name="patchnameTxt"
                               value="<?php
                                       echo isset($patchCyclesArray)
                                           ? $patchCyclesArray[0]['name'] : "";
                                      ?>"/>
                        <input type="hidden" id="patchID" name="patchID"
                            value="<?php
                                    echo isset($patchID) ? $patchID : 'null';
                                    ?>" />
                    </li>
                    <li class="addContent-li">
                        <label>Notes</label>
                    </li>
                    <li class="addContent-li">
                        <input type="text" id="patchnotesTxt" name="patchnotesTxt"
                               value="<?php
                                       echo isset($patchCyclesArray)
                                           ? $patchCyclesArray[0]['note'] : "";
                                      ?>"/>
                    </li>
                    <li class="addContent-li">
                        <label>Date</label>
                    </li>
                    <li class="addContent-li">
                        <input type="text" placeholder="YYYY-MM-DD" id="patchDateTxt"
                               name="patchDateTxt"
                               value="<?php
                                       echo isset($patchCyclesArray)
                                           ? $patchCyclesArray[0]['patchdate'] : "";
                                      ?>"/>
                    </li>
                    <li class="addContent-li">
                        <label>Time</label>
                    </li>
                    <li class="addContent-li">
                        <input type="text" placeholder="HH:MM:SS" id="patchTimeTxt"
                               name="patchTimeTxt"
                               value="<?php
                                       echo isset($patchCyclesArray)
                                           ? $patchCyclesArray[0]['patchtime'] : "";
                                      ?>"/>
                    </li>
                    <li class="addContent-li">
                        <label>Servers</label>
                        <div>
                            <ul class="addContent-ul">
                                <?php

                                foreach($db->query("SELECT * FROM Computers;") as $row)
                                {
                                    echo "<li class='addContent-li' >";
                                    echo "<input value='$row[id]'
                                          name='servers[]' type='checkbox'";
                                    if(isset($serverArray))
                                    {
                                        foreach($serverArray as $server)
                                        {
                                            if($row[id] == $server[id])
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
                if(isset($patchID))
                {
                    echo "<div class='addContentBtn '>";
                    echo "<input type='hidden' name='addType' value='update' />";
                    echo "<input type='submit' class='addContentBtn ' name='update' value='Update' />";
                    echo "</div>";
                }
                else
                {
                    echo "<div class='addContentBtn '>";
                    echo "<input type='hidden' name='addType' value='add' />";
                    echo "<input type='submit' class='addContentBtn ' disabled='disalbed' name='update' value='Add' />";
                    echo "</div>";
                }
                ?>

                <?php

                if(isset($patchID))
                {
                    echo "<div class='addContentBtn '>
                    <form action='addserver.php' method='post'>
                    <input type='hidden' name='patchID' value='$patchID'/>
                    <input type='submit'  name='addType' value='delete' />
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

