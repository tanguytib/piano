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
			<h1>Guiness Icam Records</h1>
			
		</header>

		<!-- Formulaire de recherche -->
		<form action="connection_serveur.php" method="POST">
		  <input type="text" name="fname" placeholder="Rechercher..." ><br>
		  <input type="submit" value="" class="search_pic">
		</form>


		<!-- Carrousel de records : affichage de quelques records avec flèches droites et gauches pour naviguer -->
		<div id=carrousel>
				<div id=NewRecord_1 style="border: thick #B85D6D 2px; width: 200px;">
					<h1>Record battu de Tanguy</h1>
					<p>Un évenemnt incroyable ce mardi après-midi ! Un jeune étudiant de la Mi à franchi le seuil des 5 avocats mangés en moins d'une minute !</p>
				</div>
		</div>
		
		
		<!-- bouton permettant de créer un record -->
		<div id=btn_creation_record>
			<a href="creation_record/form_nouveau_record.php" style="color: #942211"> Invente ton record !</a>
		</div>


		<!-- bouton permettant d'aller voir la liste des records existants -->
		<div id=go_liste_records>
			<a href="liste_record.php" style="color: #27BA85"> Voir la liste des records existants</a>
		</div>
		
		<br/>


</body>
	<footer>
		<form action="../html/admin/index.php" method="POST">
		  <input type="password" placeholder="Mot de passe" name="password" ><br>
		  <input type="submit" value="envoyer" >
		</form>
	</footer>
</html>
