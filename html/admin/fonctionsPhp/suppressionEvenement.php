<?php
	session_start();
	include '../../DBconfig.php';
	include 'loginCheck.php';

	$id=htmlspecialchars($_GET['Id']);
	$result = $db->query("DELETE FROM Evenements WHERE Id='$id'");
	if ($result){
		$_SESSION['msg'] = "L'évènement a bien été supprimé !";
	} else {
		$_SESSION['msg'] = "Erreur lors de la suppression de l'évènement :" . $result;
	};	
	header('Location: /html/admin/accueilAdmin.php');
?>
