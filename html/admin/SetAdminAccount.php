<?php
	session_start();
	include '../DBconfig.php';
	$query = 'INSERT INTO Personnes (Nom, Prenom, Jury, Promo, Password) VALUES (' . $_POST['nom'] . ', ' . $_POST['prenom'] . ', ' . 1 . ', ' . $_POST['promo'] . ', ' . 'passwordtest' . ');';
	if (mysqli_query($db,$query)) {
		$_SESSION['msg']='Un administrateur a bien été créé !';
	} else {
		$_SESSION['msg']='Erreur lors de la création du compte administrateur' . mysqli_error($db);
	}

	header('Location: /html/admin/index.php')
?>
