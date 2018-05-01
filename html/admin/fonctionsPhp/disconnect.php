<?php
	session_start();
	unset($_SESSION['logged']);
	header('Location: /html/accueil.php');
?>