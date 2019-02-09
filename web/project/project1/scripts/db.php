<?php

$db;

try
{
    $dbUrl = getenv('DATABASE_URL');
    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPassword = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


function search($searchType,$searchTerm)
{
    $searchArray = "";

    switch($searchType)
    {
        case "computer":
            $searchArray['computer'] = array();
            array_push($searchArray['computer'],searchComputer($searchTerm));
            break;
        case "patch":
            $searchArray['patch'] = array();
            array_push($searchArray['patch'],searchPatch($searchTerm));
            break;
        case "any":
            $searchArray['computer'] = array();
            $searchArray['patch'] = array();
            array_push($searchArray['computer'],searchPatch($searchTerm));
            array_push($searchArray['computer'],searchComputer($searchTerm));
            break;
    }

    return $searchArray;
}


function searchComputer($searchTerm)
{
    $statement = $db->query("SELECT * FROM Computers WHERE Name LIKE '%$searchTerm%'
                            OR IP LIKE '%$searchTerm%';");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) > 0)
    {
        return $result;
    }

    return;
}


function searchPatch($searchTerm)
{
    $statement = $db->query("SELECT * FROM PatchCycle WHERE Name LIKE '%$searchTerm%'
                            OR Note LIKE '%$searchTerm%';");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) > 0)
    {
        return $result;
    }

    return;
}

?>


