<!doctype html>

<?php
session_start();
$password='banane';
if (isset($_POST['password'])){
	if (htmlspecialchars($_POST['password']) == $password){
		$_SESSION['password'] = $password;
	};
};
if ($_SESSION['password'] != $password){
	header('Location: /html/accueil.php');
	};
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Admin panel</title>
</head>

<body>
	Salut c'est l'index
</body>
</html>