<!DOCTYPE HTML>
<?php 
session_start();
?>

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/styles.css">
		<meta name="viewport" content="width=device-width">
		<title>piano</title>
	</head>
    
	<body>
		<header>
		</header>

		<!-- Formulaire de recherche -->
		<form action="../html/recherche.php">
		  <input type="text" name="fname" placeholder="Rechercher..." ><br>
		  <input type="submit" value="" class="search_pic">
		</form>
		
		<!-- Carrousel de records : affichage de quelques records avec flèches droites et gauches pour naviguer -->
	
		
	</body>
	<footer>
		<form action="../html/admin/index.php">
		  <input type="password" placeholder="Mot de passe" name="password" ><br>
		  <input type="submit" value="go" >
		</form>
	</footer>
</html>
        