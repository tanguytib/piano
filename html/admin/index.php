<!doctype html>

<?php
session_start();
if ($_SESSION['logged'] != 1){
	header('Location: /html/accueil.php');
};
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Admin panel</title>
</head>

<body>
	Salut c'est l'index <br>
	<br>
	<a href='../admin/FormAdminAccount.php'>Créer un compte admin</a><br>
	
	<?php 
		if (isset($_SESSION['msg'])){
			echo 'INFO : ' . $_SESSION['msg'];
			unset ($_SESSION['msg']); //Une fois le message affiché, on le supprime de la variable session
		}
	?>
</body>
</html>