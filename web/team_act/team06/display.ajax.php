<?php

/*$book = $_POST['book'];
$chaper = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topics = $_POST['topic'];
*/


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

/*
//insert new scripture
$db->query("INSERT INTO Scriptures(book,chapter,verse,content)
            VALUES('$book','$chaper','$verse','$content');");

$scripturID = $db->lastInsertId('Scriptures_id_seq');

//insert Scriptures_to_Topic

foreach($topics as $topic)
{
    $db->query("INSERT INTO Scriptures_to_Topic(Scriptures_id,Topic_id)
                VALUES($scripturID,$topic);");
}*/


$javascripObj = "{'topics':[";

$statement = $db->query("SELECT * FROM Topic;");
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$resultsCount = count($results);

foreach($results as $key => $row)
{
    $javascripObj .= "{'topic':$row,[";

    foreach($db->query("SELECT Scriptures_to_Topic.Scriptures_id,
                        Scriptures.book,Scriptures.chapter,
                        Scriptures.verse,Scriptures.content
                        FROM Scriptures_to_Topic
                        JOIN Scriptures
                        ON Scriptures_to_Topic.Scriptures_id = Scriptures.ID
                        WHERE Scriptures_to_Topic.Topic_id = $row[id];") as $scriptur)
    {
        $javascripObj .= "'book':$scriptur[book],'chapter':$scriptur[chapter],";
        $javascripObj .= "'verse':$scriptur[verse],'content':$scriptur[content]}";
    }

    if($key < ($resultsCount - 1))
    {
        $javascripObj .= ",";
    }
}

$javascripObj .= "]}";

echo $javascripObj;

echo "test";

?>

