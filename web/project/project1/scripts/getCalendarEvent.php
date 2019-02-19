
<?php

include "db.php";
include "jsonbulider.class.php";


$queryString = "";


if(isset($_GET['year']) && isset($_GET['month']))
{
    $queryString = "SELECT PatchSchedlue.ID AS scheduleID,
        EXTRACT(YEAR FROM PatchSchedlue.patchdate) AS YEAR,
        EXTRACT(MONTH FROM PatchSchedlue.patchdate) AS MONTH,
        EXTRACT(DAY FROM PatchSchedlue.patchdate) AS DAY,
        PatchSchedlue.patchtime,PatchCycle.Name,
        PatchCycle.ID AS patchID
        FROM PatchSchedlue
        JOIN PatchCycle ON PatchSchedlue.PatchCycle_ID = PatchCycle.ID
        WHERE EXTRACT(MONTH FROM PatchSchedlue.patchdate) = '".$_GET['month']."'
        AND EXTRACT(YEAR FROM PatchSchedlue.patchdate) ='".$_GET['year']."';";
}
else
{
    $queryString = "SELECT PatchSchedlue.ID AS scheduleID,
                EXTRACT(YEAR FROM PatchSchedlue.patchdate) AS YEAR,
                EXTRACT(MONTH FROM PatchSchedlue.patchdate) AS MONTH,
                EXTRACT(DAY FROM PatchSchedlue.patchdate) AS DAY,
                PatchSchedlue.patchtime,PatchCycle.Name,
                PatchCycle.ID AS patchID
                FROM PatchSchedlue
                JOIN PatchCycle ON PatchSchedlue.PatchCycle_ID = PatchCycle.ID
                ORDER BY PatchSchedlue.patchdate;";
}


$jsonMainObj = new jsonBulider();
$jsonTopicsArray = $jsonMainObj->addJsonArray();
$jsonTopicsArray->setJsonArrayName("patchdates");

$statement = $db->query($queryString);
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$resultsCount = count($results);

if($resultsCount > 0)
{
    foreach($results as $key => $row)
    {
        $topicObj = $jsonTopicsArray->addJsonObj();

        //Name
        $nameData = $topicObj->addJsonObjData();
        $nameData->setJsonDataName("name");
        $nameData->setJsonDataValue($row['name']);

         //scheduleID
        $scheduleIDData = $topicObj->addJsonObjData();
        $scheduleIDData->setJsonDataName("scheduleid");
        $scheduleIDData->setJsonDataValue($row['scheduleID']);

        //time
        $timeData = $topicObj->addJsonObjData();
        $timeData->setJsonDataName("time");
        $timeData->setJsonDataValue($row['patchtime']);

         //patchID
        $patchIDData = $topicObj->addJsonObjData();
        $patchIDData->setJsonDataName("patchid");
        $patchIDData->setJsonDataValue($row['$patchID']);

        //year
        $yearData = $topicObj->addJsonObjData();
        $yearData->setJsonDataName("year");
        $yearData->setJsonDataValue($row['year']);

        //day
        $dayData = $topicObj->addJsonObjData();
        $dayData->setJsonDataName("day");
        $dayData->setJsonDataValue($row['day']);

         //month
        $monthData = $topicObj->addJsonObjData();
        $monthData->setJsonDataName("month");
        $monthData->setJsonDataValue($row['month']);
    }

    echo $jsonMainObj->bulidString();
}


?>

