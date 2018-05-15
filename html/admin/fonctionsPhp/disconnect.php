<?php
	session_start();
	unset($_SESSION['logged']);
	$_SESSION['msg'] = "Vous avez bien été déconnecté !";
	header('Location: ../../accueil.php');
?>
