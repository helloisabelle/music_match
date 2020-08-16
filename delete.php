<!DOCTYPE html>
<html lang = "en">
<head>
<title>Delete</title>
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

    if (!isset($_GET["id"]) || empty($_GET["id"])){
        echo "error";
        exit();
    }
  
    $sql =  "DELETE FROM albums WHERE album_id = ". $_GET["id"] . ";";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: albums.php");
        exit;
    } else {
        echo "<div class=\"text-danger\"> Failed ". $mysqli->error. "</div>";

    }
?>
</body>
</html>