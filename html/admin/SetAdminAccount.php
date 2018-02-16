<?php
	session_start();
	include '../DBconfig.php';
	$request = $db->query('CREATE Perso');
	if ($request) {
		$_SESSION['msg']='Un administrateur a bien été créé !';
	}
	else {
		$_SESSION['msg']='Erreur lors de la création du compte administrateur';
	}
	header('Location: /html/admin/index.php')
?>
