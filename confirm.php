<!DOCTYPE html>
<html lang = "en">
<head>

	<title>Confirmation</title>

	<?php
	 $email_to = "isabelln@usc.edu";
    $email_subject = $_POST["subject"];

	if (!isset($_POST["subject"]) ||
		empty($_POST["subject"]) ||
		!isset($_POST['name']) ||
		!isset($_POST['message']) ||
		!isset($_POST['email']) ||
		empty($_POST["name"]) ||
		empty($_POST["message"]) ||
		empty($_POST["email"])
    ) {
            echo "<p class=\"text-center w-responsive mx-auto mb-5\">  Error in sending email. </p>";
			exit(); 
    }
 
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required

     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message = "Form details below.\n\n";
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
	$headers = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	mail($email_to, $email_subject, $email_message, $headers);   
	?>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

	<nav class="navbar navbar-expand-md navbar-light">
		<a class="navbar-brand" href="home.html">Music Match</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

 		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul id = "nav" class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" onclick="link('home.html')">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item active">
					<a id = "con" class="nav-link"  onclick="link('contact.html')">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" onclick="link('albums.php')">Album Voting</a>
				</li>
			</ul>
    	</div>
	</nav>

	<div id = "header">
		<h2>Contact Us</h2>
	</div>

	<div id = "contact">
		<section class="mb-4">
			<?php
				if (isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["message"]) && !empty($_POST["message"])){
					echo " <p class=\"text-center w-responsive mx-auto mb-5\"> Successfully sent message from " . $_POST["name"] .  " with the message: " . $_POST["message"];

					echo "<br/> Thank you and we will get back to you soon. </p>";

				}
				else {
					echo "<p class=\"text-center w-responsive mx-auto mb-5\">  Error in sending email. </p>";
					exit();
				}	
			?>
		</section>
	</div>

	<footer class="page-footer font-small">
	  <div class="footer-copyright text-center py-3">© 2020 Music Match</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src = "mainc.js"></script>

</body>
</html>
