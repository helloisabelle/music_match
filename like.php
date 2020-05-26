<!DOCTYPE html>
<html lang = "en">
<head>
<title>Like</title>
</head>
<body>

    <?php

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
    

    $sql = "UPDATE albums SET likes = likes + 1 WHERE album_id = " . $_GET["id"] . ";";
    
    if ($mysqli->query($sql) === TRUE) {
        header("Location: a.php"); 
    } else {
        echo "<div class=\"text-danger\"> Failed ". $mysqli->error. "</div>";
        
    }

?>


</body>
</html>


