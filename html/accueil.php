<?php
	session_start();
	include '../html/DBconfig.php';
?>

<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/css/styles.css">
		<link rel="stylesheet" href="/css/loader.css">
		<meta name="viewport" content="width=device-width">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<title>piano</title>
	</head>

	<body>
		<?php
			include '../html/background.php';
		?>

		 <div class="container-fluid center col-lg-10 col-lg-offset-1">
			 <div class="col-lg-12">
			 <h1 class="title">Une sélection random</h1>
			 </div>
				<div class="card-group">
						<?php
							$query="SELECT Id, intitule, detail FROM Records ORDER BY RAND() LIMIT 3";
							$requete = mysqli_query($db, $query);
							while($reponse= $requete->fetch_assoc()){
								$id = $reponse['Id'];
								echo '<div class="col-md-4">
										<div class="card" style="margin-bottom:10px;">
											<div class="card-header">
												<ul class="nav nav-tabs card-header-tabs">
												  <li class="nav-item col-xs-4">
													<a onclick = "apercu("' . $id . '") class="nav-link active" href="#">Aperçu</a>
												  </li>
												  <li class="nav-item col-xs-4">
													<a onclick = "detail("' . $id . '") class="nav-link" href="#">Détail</a>
												  </li>
												  <li class="nav-item col-xs-4">
													<a onclick = "historique("' . $id . '") class="nav-link disabled" href="#">Historique</a>
												  </li>
												</ul>
											 </div>
											 <h3 class="card-title title">' . $reponse['intitule'] .'</h3>
											<div id="apercuRecord' . $id . '">
												<img class="card-img-top imgcarousel" src="/content/img/piano.png" alt="Card image">
												<div class="card-body">
												  <p class="card-text text">' . $reponse['detail'] .'</p>
												  <a href="#" class="btn btn-warning">REVENDIQUER</a>
												</div>
											</div>
											<div id="detailRecord' . $id . '" class="hidden">
												<div class="card-body">
												  <p class="card-text text"> Ceci est le detail complet </p>
												</div>
											</div>
											<div id="historiqueRecord' . $id . '" class="hidden">
												<div class="card-body">
												  <p class="card-text text"> Ceci est lhistorique </p>
												</div>
											</div>
											<br>
										</div>
									  </div>
									  <script>
									  	$( "#btnApercu' . $id .'" ).click(function() {
											$( "#item" ).toggle();
										});
									  </script>';
							}
						?>
					<!--<script>
						$(function apercu(Id){
							document.getElementById(<?php echo '"apercuRecord' . $id . '"'?>).style.visibility = "visible";
							document.getElementById(<?php echo '"detailRecord' . $id . '"'?>).style.visibility = "hidden";
							document.getElementById(<?php echo '"historiqueRecord' . $id . '"'?>).style.visibility = "hidden";
						});
						$(function detail(Id){
							document.getElementById(<?php echo '"apercuRecord' . $id . '"'?>).style.visibility = "hidden";
							document.getElementById(<?php echo '"detailRecord' . $id . '"'?>).style.visibility = "visible";
							document.getElementById(<?php echo '"historiqueRecord' . $id . '"'?>).style.visibility = "hidden";
						});
						$(function historique(Id){
							document.getElementById(<?php echo '"apercuRecord' . $id . '"'?>).style.visibility = "hidden";
							document.getElementById(<?php echo '"detailRecord' . $id . '"'?>).style.visibility = "hidden";
							document.getElementById(<?php echo '"historiqueRecord' . $id .'"'?>).style.visibility = "visible";
						});
					</script>-->
				</div>
	


				<!-- Déroulement des catégories-->
					<div id="panelCategories" style="width:100%; margin:auto; margin-top:20px; ">
						<?php
							$categories = $db->query('SELECT * FROM Categories ORDER BY RAND() LIMIT 8 ');
							while($row = $categories->fetch_assoc())
							{
								echo '<a class="btn btn-default center-block" href="categorie.php?Id_categorie='.$row['Id'].'">'.$row['nom'].'</a>';
							}
							$categories->close();
						?>
						<br>
					</div>
			</div>

</body>
	<footer>



		<div class="col-md-12 text-center" style="margin-top:20px" onclick="showLogin();">Espace administrateur :
			<div id="loginSection">
				<form action="admin/fonctionsPhp/login.php" method="POST">
				  <input style="margin-left: 5px" type="text" placeholder="Email" name="email" >
				  <input style="margin-left: 10px" type="password" placeholder="Mot de passe" name="password" >
				  <input type="submit" value="connexion" >
				</form>
			</div>
		</div>
		<script type="text/javascript">
			function showLogin() {
				var ctn = document.getElementById('loginSection');
				ctn.display = ctn.display == 'none' ? 'block' : 'none';
			}
		</script>
		<?php
			if (isset($_SESSION['msg'])){
			echo 'INFO : ' . $_SESSION['msg'];
			unset ($_SESSION['msg']);} //Une fois le message affiché, on le supprime de la variable session
		?>
	</footer>
</html>
