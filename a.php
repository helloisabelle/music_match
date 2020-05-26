<?php

	// TODO: Establish DB connection, submit SQL query here. Remember to check for any MySQLi errors.

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");


$host = "303.itpwebdev.com";
$user = "isabelln_db_user";
$password = "uscItp2020";
$db = "isabelln_music_db";

$mysqli = new mysqli($host, $user, $password, $db);

if ($mysqli->connect_errno){
	echo $mysqli->connect_error;
	exit();
}

?>

<!DOCTYPE html>
<html lang = "en">
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">

	<title>Album Voting</title>

</head>
<body>

<nav class="navbar navbar-expand-md navbar-light">
<a class="navbar-brand">Music Match</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul id = "nav" class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" onclick="link('home.html')">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a id = "con" class="nav-link"  onclick="link('contact.html')">Contact</a>
          </li>
          <li class="nav-item active">
        <a class="nav-link" onclick="link('a.php')">Album Voting</a>
        </li>
        <li id = "hid" style = "visibility: hidden;" class="nav-item">
        	<a class="nav-link" onclick="link('t.html')">Your Stats</a>
        </li>
        </ul>
      </div>
</nav>

<div id = "header">
<h2>Vote for your favorite albums</h2>
</div>



<div id = "rank">
	<h4>Album Ranking</h4>

	            
			<?php
				$sql = "SELECT * FROM albums ORDER BY likes DESC;";

				$results = $mysqli->query($sql);

				if (!$results){
					echo $mysqli->error;
					exit();
				}

				while ($row = $results->fetch_assoc()){
					echo "<div class = \"row r\">";
					echo "<div class = \"col\">";

					echo "<div class=\"like\" onclick='l(". $row["album_id"].")'> <i class=\"fa fa-heart\"></i> " . $row["likes"].  "</div>";
					echo "<div class=\"delete\" onclick='d(". $row["album_id"].")' style = \"visibility: visible;\"> <i class=\"fa fa-trash\"></i>  Delete </div>";
					echo "</div>";
					echo "<div class = \"col\">";
					echo "<p id = ". $row["album_id"] . ">". $row["album_name"]. " by ". $row["artist"] . "</p>";
					echo "</div>";
					echo "</div>";
				}

			?>
</div>


<div id = "search">
	<section class="mb-4">
	    <h5 class="text-center w-responsive mx-auto mb-5"> Have a favorite that isn't listed?  Submit it here and it will have 1 vote!</h5>


	            <form id="album-form" name="album-form" action = "add.php" method = "POST" >

	                	<div class="row">

	                            <input type="text" id="name" name="name" class="form-control" required>
	                            <label for="name" class="">Album Name</label>
	                        
	                
	                    </div>

                        <div class="row">

                        <input type="text" id="artist" name="artist" class="form-control" required>
                        <label for="name" class="">Artist</label>

                        </div>

	                    <div class="row">
	                            <select name="type_id" id="type" class="form-control">
								<?php
									$sql = "SELECT * FROM type;";

									$results = $mysqli->query($sql);

									if (!$results){
										echo $mysqli->error;
										exit();
									}

									while ($row = $results->fetch_assoc()){
										echo "<option value = ". $row["type_id"] . ">". $row["name"]. "</option>";
									}

								?>

							</select>
							<label for="type" class="">Album Type</label>
	                    </div>

	                    <div class="row">
	                            <select name="lang_id" id="type2" class="form-control">
								<?php
									$sql = "SELECT * FROM language;";

									$results = $mysqli->query($sql);

									if (!$results){
										echo $mysqli->error;
										exit();
									}

									while ($row = $results->fetch_assoc()){
										echo "<option value = ". $row["language_id"] . ">". $row["name"]. "</option>";
									}

								?>

							</select>
							<label for="type2" class="">Language</label>
	                    </div>

	                    <div class="row">
	                <input type="submit" id="subject"  name="subject" class="form-control">
	            </div>

	            </form>

	 
	</section>
</div>


	<footer class="page-footer font-small">
	  <div class="footer-copyright text-center py-3">© 2020 Music Match</div>
	</footer>
	

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src = "mainc.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
<script>
	

</script>


</body>
</html>
