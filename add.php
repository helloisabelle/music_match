<!DOCTYPE html>
<html lang = "en">
<head>
<title>Like</title>
</head>
<body>

<?php

	// TODO: Establish DB connection, submit SQL query here. Remember to check for any MySQLi errors.
$host = "303.itpwebdev.com";
$user = "isabelln_db_user";
$password = "uscItp2020";
$db = "isabelln_music_db";

$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_errno){
	echo $mysqli->connect_error;
	exit();
}
    if (!isset($_POST["name"]) || empty($_POST["name"])){
        echo "error";
        exit();
    }
    
    if (!isset($_POST["artist"]) || empty($_POST["artist"])){
        echo "error";
        exit();
    }
    
    if (!isset($_POST["type_id"]) || empty($_POST["type_id"])){
        echo "error";
        exit();
    }
    
    if (!isset($_POST["lang_id"]) || empty($_POST["lang_id"])){
        echo "error";
        exit();
    }
    
    $max = "SELECT album_id FROM albums ORDER BY album_id DESC LIMIT 0, 1";
    
    $results = $mysqli->query($max);
    
    if (!$results){
        echo $mysqli->error;
        exit();
    }
    
    $row = $results->fetch_assoc();
    $id = $row["album_id"] + 1;
    

    
    $sql = "INSERT INTO albums (album_id, album_name, artist, type_id, language_id, likes) VALUES (" . $id . " ,'" . $_POST["name"] ."' ,'" . $_POST["artist"] ."' , " . $_POST["type_id"] . ", " . $_POST["lang_id"] .", 1);";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: a.php");
        exit;
    } else {
        echo "<div class=\"text-danger\"> Failed ". $mysqli->error. "</div>";

    }

?>

</body>
</html>
