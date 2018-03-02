<?php
session_start();
include '../html/DBconfig.php';
?>

<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/styles.css">
		<meta name="viewport" content="width=device-width">
		<title>piano</title>
	</head>

	<body>
		<header>
			<h1>Piano  - Panier</h1>
		</header>


		<!-- Formulaire de recherche -->
		<form action="recherche.php" method="POST">
		  <input type="text" name="recherche" placeholder="Rechercher..." ><br>
		  <input type="submit" value="" class="search_pic">
		</form>


		<!-- Carrousel de records : affichage de quelques records avec flèches droites et gauches pour naviguer -->
		<div id=carrousel>
				<div id=NewRecord_1 style="border: thick #B85D6D 2px; width: 250px;">
					<h1>Concours de panier - piano</h1>
					<p>Un évenement incroyable ce mardi après-midi ! Un jeune étudiant de la Mi à franchi le seuil des 47 piano/panier prononcés en moins d'une minute !</p>
				</div>
		</div>
		
		
		<!-- Map de l'Icam-->
		<div id="map" style="height: 40%; width: 40%;">
			<script>
			  function initMap() {
				var icam = {lat: 50.630247, lng: 3.041703};
				var map = new google.maps.Map(document.getElementById('map'), {
				  zoom: 17,
				  center: icam
				});
				var marker = new google.maps.Marker({
				  position: icam,
				  map: map
				});
			  };
			</script>
		<script async defer
    		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4xd3D0FMFyKmn4mADuzQJDxieTmKWz8k&callback=initMap">
    	</script>
		</div>

		<!-- Déroulement des catégories-->
		<div id=categories>
		<?php
			$categories = $db->query('SELECT * FROM Categories ');

			while($row = $categories->fetch_assoc())
			{
				echo 'voici la catégorie n°'.$row['Id'].' : '.$row['nom'].'<br/>';
			}
			
			$categories->close();
		?>
		</div>
		
		
		<!-- bouton permettant de créer un record -->	
		<div id=btn_creation_record>
			<a href="creation_record/creation_record_Public.php" style="color: #942211"> Invente ton panier !</a>
		</div>


		<!-- bouton permettant d'aller voir la liste des records existants -->
		<div id=go_liste_records>
			<a href="liste_record.php" style="color: #27BA85"> Voir la liste des pianos existants</a>
		</div>
		
		
		<h3>What is Lorem Ipsum?</h2>
		<p>
		 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget velit interdum, ullamcorper elit vitae, imperdiet tortor. Ut nibh ex, vestibulum elementum nulla ac, euismod condimentum libero. Aliquam pretium iaculis diam. Duis vestibulum nec odio eget interdum. Nunc id arcu euismod magna condimentum lacinia vel vel felis. Nulla bibendum turpis at varius suscipit. Etiam finibus eleifend lectus quis luctus. Cras malesuada risus mattis fringilla pulvinar. Nam vel scelerisque ex. Pellentesque rhoncus tempus metus, sit amet hendrerit libero rutrum non. Maecenas molestie maximus odio a elementum. Vivamus vitae finibus quam, eget faucibus nibh.
		 </p>


</body>
	<footer>
		<form action="admin/fonctionsPhp/login.php" method="POST">
		  <input type="text" placeholder="Pseudo" name="pseudo" ><br>
		  <input type="password" placeholder="Mot de passe" name="password" ><br>
		  <input type="submit" value="envoyer" >
		</form>
		<?php 
			if (isset($_SESSION['msg'])){
			echo 'INFO : ' . $_SESSION['msg'];
			unset ($_SESSION['msg']); //Une fois le message affiché, on le supprime de la variable session
		}?>
	</footer>
</html>
