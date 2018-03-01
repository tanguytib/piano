<!doctype HTML>
<?php
	session_start();
	include '../../DBconfig.php';

	$nom = htmlspecialchars($_POST['nom']);
	$prenom =  htmlspecialchars($_POST['prenom']);
	$isadmin =  htmlspecialchars($_POST['isadmin']);
	$promo =  htmlspecialchars($_POST['promo']);
	$pseudo =  htmlspecialchars($_POST['pseudo']);
	$email =  htmlspecialchars($_POST['email']);
	$password =  password_hash(htmlspecialchars($_POST['password']),PASSWORD_BCRYPT);

	$query = "INSERT INTO Personnes (Nom, Prenom, Jury, Promo, Pseudo, Email, Password) VALUES( '$nom', '$prenom', '1', '$promo', '$pseudo', '$email', '$password')";
	$result = mysqli_query($db, $query) or trigger_error($db->error."[ $sql]");

	if ($result){
		$_SESSION['msg'] = "Compte administrateur ajouté avec succès !";
	} else {
		$_SESSION['msg'] = "Erreur lors de l'ajout du compte administrateur :" . $result;
	};

	header('Location: /html/admin/accueilAdmin.php');
?>
