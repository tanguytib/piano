<?php
session_start();
include '../DBconfig.php';
if (!($_POST['password'] == '') and !($_POST['pseudo']=='')){
	
	$password = $_POST['password'];
	$pseudo = $_POST['pseudo'];
	$query = "SELECT * FROM Personnes WHERE Pseudo='$pseudo'";
	$result = mysqli_query($db, $query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);

	if (mysqli_num_rows($result) == 1) { // Un seul pseudo devrait exister dans la base et correspondre à celui qui a été tapé
		$row = mysqli_fetch_assoc($result);
		if (($pseudo == $row['Pseudo']) and (password_verify($password, $row['Password']))) {
			
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['logged'] = 1;
			$_SESSION['msg'] = 'Loggin sucessfull';
			
		} else {
			
			$_SESSION['msg'] = "Erreur : mot de passe incorrect !  ";
			
		}
	} else {
		
		$_SESSION['msg'] = "Erreur : Pseudo incorrect !";
		
	};
} else {
	
	$_SESSION['msg'] = "Erreur : Veuillez saisir le pseudo et le mot de passe !"; //Cas ou le champ pseudo ou password est vide
	
};

header('Location: /html/admin/index.php');

?>