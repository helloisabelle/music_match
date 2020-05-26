<!DOCTYPE html>
<html lang = "en">
<head>
<title>Delete</title>
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
    if (!isset($_GET["id"]) || empty($_GET["id"])){
        echo "error";
        exit();
    }
  
    
    $sql =  "DELETE FROM albums WHERE album_id = ". $_GET["id"] . ";";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: a.php");
        exit;
    } else {
        echo "<div class=\"text-danger\"> Failed ". $mysqli->error. "</div>";

    }

?>
</body>
</html>