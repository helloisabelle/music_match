<!DOCTYPE html>
<html lang = "en">
<head>
<title>Like</title>
</head>
<body>

<?php
    $host = "localhost";
    $user = "u680557347_isabelle";
    $password = "Abc12345";
    $db = "u680557347_music_db";

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
    
    $max = "SELECT album_id FROM albums ORDER BY album_id DESC LIMIT 0, 1";
    
    $results = $mysqli->query($max);
    
    if (!$results){
        echo $mysqli->error;
        exit();
    }
    
    $row = $results->fetch_assoc();
    $id = $row["album_id"] + 1;
    
    $sql = "INSERT INTO albums (album_id, album_name, artist, likes) VALUES (" . $id . " ,'" . $_POST["name"] ."' ,'" . $_POST["artist"] ."', 1);";
    echo $sql;
    // if ($mysqli->query($sql) === TRUE) {
    //     header("Location: albums.php");
    //     exit;
    // } else {
    //     echo "<div class=\"text-danger\"> Failed ". $mysqli->error. "</div>";
    // }

?>

</body>
</html>
