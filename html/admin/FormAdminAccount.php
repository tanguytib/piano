<!doctype HTML>
<?php
	session_start();
	include './fonctionsPhp/loginCheck.php';
	include '../DBconfig.php';
?>

<html>
<head>
	<?php
		include '../background.php';
	?>
	<title>Admin panel</title>
</head>

<body>
	<h1 class="title text-center">Créer un compte administrateur :</h1><br>
	 <div class="container-fluid col-lg-4 col-lg-offset-4">
		<form action='fonctionsPhp/SetAdminAccount.php' method='post'>
			<b>Nom : </b><input name='nom' type='text'><br><br>
			<b>Prénom : </b><input name='prenom' type='text'><br><br>
			<b>Promo : </b><input name='promo' type='number'><br><br>
			<b>Adresse mail : </b><input name='email' type='text'><br><br>
			<b>Mot de passe : </b><input name='password' type='password'><br><br>
			<b><input name='stupid' type='checkbox'> Je certifie ne pas avoir lu la charte <br><br></b>
			<input class="btn btn-success" name='submit' type='submit' value='Créer un compte'>
		</form>
	</div>
</body>
</html>
