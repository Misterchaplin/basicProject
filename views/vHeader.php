<?php 
require_once 'technics/Gui.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- js-->
		<script type="text/javascript" src="<?php echo $GLOBALS["siteUrl"]?>js/jquery-2.1.4.js"></script>
				
				
		
	<!-- polices-->
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- css-->			
		 <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS["siteUrl"]?>css/cssMain.css">	
		
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<title>BasicProject</title>
</head>
<body>
	<header>
		<?php 
			if(!empty($_SESSION['membre']))
			{
		?>
				<form id="formRelancer" action="<?php echo $GLOBALS["siteUrl"]?>accueil/deconnexionMembre" method="post">
				<input type="submit" value="Se déconnecter"/>
				</form>
		<?php
			}
		?>
		<h1><a class="aTitle" href="<?php echo $GLOBALS["siteUrl"]?>">Basic Project</a></h1>
		<h3>A simple way to manage Projects & Tasks</h3>			
	</header>
<!-- div contneu principal -->
<div id="mainContainer">
	