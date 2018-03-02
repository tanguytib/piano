<?php
session_start();
include '../DBconfig.php';

if (!($_POST['password'] == '') and !($_POST['email']=='')){
	
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$query = "SELECT * FROM Personnes WHERE email='$email'";
	$result = mysqli_query($db, $query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

	if (mysqli_num_rows($result) == 1) { // Un seul email devrait exister dans la base et correspondre à celui qui a été tapé
		$row = mysqli_fetch_assoc($result);
		if (($email == $row['email']) and (password_verify($password, $row['password']))) {
			
			$_SESSION['email'] = $email;
			$_SESSION['logged'] = 1;
			$_SESSION['msg'] = 'Loggin sucessfull';
			
		} else {
			
			$_SESSION['msg'] = "Erreur : mot de passe incorrect !  ";
			
		}
	} else {
		
		$_SESSION['msg'] = "Erreur : email inconnu ou présent en double dans la base !";
		
	};
} else {
	
	$_SESSION['msg'] = "Erreur : Veuillez saisir votre email et votre mot de passe !"; //Cas ou le champ email ou password est vide
	
};

header('Location: /html/admin/accueilAdmin.php');

?>