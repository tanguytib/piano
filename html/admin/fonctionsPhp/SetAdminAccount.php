<!doctype HTML>
<?php
	session_start();
	include '../../DBconfig.php';
	include 'loginCheck.php';


	$nom = htmlspecialchars($_POST['nom']);
	$prenom =  htmlspecialchars($_POST['prenom']);
	$isadmin =  htmlspecialchars($_POST['isadmin']);
	$promo =  htmlspecialchars($_POST['promo']);
	$email =  htmlspecialchars($_POST['email']);
	$password =  password_hash(htmlspecialchars($_POST['password']),PASSWORD_BCRYPT);


	# On regarde si la promo existe déjà
	$query = "SELECT * FROM Promos WHERE nom='$promo'";
	$result = mysqli_query($db, $query) or trigger_error($db->error);
	#Si la promo n'existe pas
	if (mysqli_num_rows($result) == 0) {	#Si oui on en crée une
		mysqli_query($db, "INSERT INTO Promos(nom) VALUES ('$promo')");
		$Idpromo=mysqli_insert_id($db);
		echo $Idpromo;
	} else { #Sinon on récupère son Id
		$row = mysqli_fetch_assoc($result);
		$Idpromo=$row['Id'];
	}
		
	$query = "INSERT INTO Personnes (nom, prenom, jury, Idpromo, email, password) VALUES( '$nom', '$prenom', '1', '$Idpromo', '$email', '$password')";
	$result = mysqli_query($db, $query) or trigger_error($db->error);

	if ($result){
		$_SESSION['msg'] = "Compte administrateur ajouté avec succès !";
	} else {
		$_SESSION['msg'] = "Erreur lors de l'ajout du compte administrateur :" . $result;
	};

	header('Location: /html/admin/accueilAdmin.php');
?>
