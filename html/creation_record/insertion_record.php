<?php
	include '../DBconfig.php';
	
	

	$requete = $db->prepare('INSERT INTO pnfra796140(nom, prenom, promo, numero_phare, status, categorie) VALUES( :intitule, :numero_phare, :status, :nom, :prenom, :promo, :categorie,)');
	$requete->execute(array(
		'intitule' => $_POST['intitule'],
		'numero_phare' => $_POST['numero_phare'],
		'status' => $_POST['status'],	
		'nom' => $_POST['nom'],	
		'prenom' => $_POST['prenom'],	
		'promo' => $_POST['promo'],	
		'categorie' => $_POST['categorie']
		));
	
	echo  'Ton record à bien été ajouté pti pédé !';
	header()

?>







