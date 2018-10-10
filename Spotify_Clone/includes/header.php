<?php
	include("includes/config.php");
	include("includes/classes/Artist.php");
	include("includes/classes/Album.php");
	include("includes/classes/Song.php");
	//session_destroy();
	if(isset($_SESSION['userLoggedIn'])){
		$userLoggedIn = $_SESSION['userLoggedIn'];
	}


	else{
		header("Location: register.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Spotify Clone</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>

<body>



	<!-- start of main containers  -->
	<div class="mainContainer">
		<!-- start of top container  which contains navigation and other top stuff-->
		<div id="topContainer">
			<!-- start of navigation container -->
			<?php
				include("includes/navBarContainer.php");
			?>
			<!-- end of navigation container -->
			<!-- top right container -->
			<div class="mainViewContainer">
				<div id="mainContent">