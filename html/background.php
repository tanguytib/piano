<?php
	session_start();
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
	
	<div class="spinner-wrapper">
		<div class="book">
		  <div class="book__page"></div>
		  <div class="book__page"></div>
		  <div class="book__page"></div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			//Preloader
			//$(window).on("load", function() {
				preloaderFadeOutTime = 500;
				function hidePreloader() {
					var preloader = $('.spinner-wrapper');
					preloader.fadeOut(preloaderFadeOutTime);
				}
				hidePreloader();
			//});
		});
	</script>
</head>

<body>
	<ul class="container-fluid row menu sansation">	
		<?php
		if ($_SESSION['logged']==1){
			echo '<a href="/html/admin/fonctionsPhp/disconnect.php"><p style="color:#0f408e; font-style: italic; font-size: 15px; margin-left: 10px;">Déconnexion</p></a>';
		}
		?>
		
		<div class="sectionmenu col-sm-2 col-sm-offset-1">
			<a href="/html/liste_record.php" class="elementmenu">Les records</a>
		</div>
		
		<div class="sectionmenu col-sm-2">
			<a href="/html/apropos.php" class="elementmenu">Comment ça marche</a>
		</div>
	
		<div class="sectionmenu col-sm-2">
			<a href="/html/accueil.php"><img src="/content//img/logo2.png" class="elementmenu logo"></a>
		</div>
		
		<div class="sectionmenu col-sm-2">
			<a href="http://google.com" class="elementmenu">Créer un record</a>
		</div>
		
		<!-- Formulaire de recherche -->
		<form class="col-sm-3 sectionmenu" action="recherchebis.php" method="post">
		  <input id="searchbar" class="elementmenu" type="text" name="recherche" placeholder="Rechercher..." ><br>
		</form>
	</ul>
	<div id="msgbox" class="alert alert-warning initiallyHidden text-center" role="alert">
		<?php 
			if (isset($_SESSION['msg'])){
				echo '<h4 class="title">' . $_SESSION['msg'] . '</h4>';
				unset ($_SESSION['msg']); //Une fois le message affiché, on le supprime de la variable session
				echo "<script>	
						window.onload=function()  //executes when the page finishes loading
						{
							setTimeout(function(){
									toggleMsg();
							},500);
							setTimeout(function(){
									toggleMsg();
							},6500);
						};

						function toggleMsg(){
							$('#msgbox').slideToggle(200);
						}
					</script>";
			} 
		?>
	</div>
</body>
</html>
