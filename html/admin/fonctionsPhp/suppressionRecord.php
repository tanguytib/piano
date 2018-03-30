<?php
	session_start();
	include '../DBconfig.php';
	include '../admin/fonctionsPhp/logincheck.php';

	$id=htmlspecialchars($_GET['Id']);
	$result = $db->query("DELETE FROM Records WHERE Id='$id'");
	if ($result){
		$_SESSION['msg'] = "Le panier a bien été supprimé ! " . "panier : " . $id;
	} else {
		$_SESSION['msg'] = "Erreur lors de la suppression du panier :" . $result;
	};	
	header('Location: /html/admin/accueilAdmin.php');
?>
