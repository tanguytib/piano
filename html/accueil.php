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
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<title>piano</title>
	</head>
	
	
	

	<body>
		<?php
			include '../html/background.php';
		?>
	
	
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
		
		<div id="map" style="border: solid black 2px; height: 200px; width: 400px;">
			<script>
			  var map;
			  function initMap() {
				map = new google.maps.Map(document.getElementById('map'), {
				  center: {lat: 50.6299, lng: 3.0414},
				  zoom: 18,
					mapTypeId: 'satellite'
				});
				  map.setTilt(45);
				  
			  }
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=	AIzaSyDabbINunYPOvfWQhBKeBoMn1MwvHbky2Q&callback=initMap"
			async defer></script>
		</div>
		

		<!-- Déroulement des catégories-->
		<div id=panelCategories >
		<?php
			$categories = $db->query('SELECT * FROM Categories ORDER BY RAND() LIMIT 6 ');

			while($row = $categories->fetch_assoc())
			{
				echo '<div class=categorie><a href="categorie.php?Id_categorie='.$row['Id'].'">'.$row['nom'].'</a></div></br>';
			}
			$categories->close();
		?>	
		</div>
		
		
		<!-- bouton permettant de créer un record -->	
		<div id=btn_creation_record class="btn btn-success">
			<a href="creation_record/creation_record_Public.php"> Invente ton panier !</a>
		</div>


		<!-- bouton permettant d'aller voir la liste des records existants -->
		<div id=go_liste_records class="btn btn-success">
			<a href="liste_record.php" > Voir la liste des pianos existants</a>
		</div>
		
		
		<h3>What is Lorem Ipsum?</h2>
		<p>
		 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget velit interdum, ullamcorper elit vitae, imperdiet tortor. Ut nibh ex, vestibulum elementum nulla ac, euismod condimentum libero. Aliquam pretium iaculis diam. Duis vestibulum nec odio eget interdum. Nunc id arcu euismod magna condimentum lacinia vel vel felis. Nulla bibendum turpis at varius suscipit. Etiam finibus eleifend lectus quis luctus. Cras malesuada risus mattis fringilla pulvinar. Nam vel scelerisque ex. Pellentesque rhoncus tempus metus, sit amet hendrerit libero rutrum non. Maecenas molestie maximus odio a elementum. Vivamus vitae finibus quam, eget faucibus nibh.
		 </p>


</body>
	<footer>
		<a href="" >A propos</a>
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
