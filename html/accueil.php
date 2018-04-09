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
		<form action="recherche2.php" method="POST">
		  <input type="text" name="recherche" placeholder="Rechercher..." ><br>
		  <input type="submit" value="" class="search_pic">
		</form>
	

		<!-- Carrousel de records : affichage de quelques records avec flèches droites et gauches pour naviguer -->
		<div id=carrousel class="carousel-item">
				<div id=NewRecord_1 style="border: thick #B85D6D 2px; width: 250px;">
					<h1>Pianos random à la une</h1>
					<?php
						$query="SELECT id, intitule, detail FROM Records ORDER BY RAND() LIMIT 3";
						$requete = mysqli_query($db, $query);
						while($reponse= $requete->fetch_assoc())
						{?> 
					<h2>Titre du piano  à la mode :<?php echo $reponse['intitule'];?></h2>
					<p>Détail du piano  : <?php echo $reponse['detail']; } ?></p>
					
				</div>
		</div>
		
		
		<!-- Map de l'Icam -34.397, 150.644-->  
		
		<div id="map" style="border: solid black 2px; height: 400px; width: 800px;">
			<script>
			  var map;
			  function initMap() {
				map = new google.maps.Map(document.getElementById('map'), {
				  center: {lat: 50.630076, lng: 3.041706},
				  zoom: 19,
					mapTypeId: 'satellite'
				});
				  map.setTilt(45);
				  
			  }
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=	AIzaSyDabbINunYPOvfWQhBKeBoMn1MwvHbky2Q&callback=initMap"
			async defer></script>
		</div>

		<!-- Déroulement des catégories-->
		<div id=panelCategories>
			<form action="categorie.php" method="get" target="_blank" id=formCategorie>
		<?php
			$categories = $db->query('SELECT * FROM Categories ORDER BY RAND() LIMIT 6 ');

			while($row = $categories->fetch_assoc())
			{
				echo '<button type="submit" class=categorie value="Submit" id='.$row['Id'].'>'.$row['nom'].'<br/>';
			}
			
			$categories->close();
		?>	
			</form>
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
		  <input type="text" placeholder="Email" name="email" ><br>
		  <input type="password" placeholder="Mot de passe" name="password" ><br>
		  <input type="submit" value="envoyer" >
		</form>
		<?php 
			if (isset($_SESSION['msg'])){
			echo 'INFO : ' . $_SESSION['msg'];
			unset ($_SESSION['msg']);} //Une fois le message affiché, on le supprime de la variable session
		?>
	</footer>
</html>
