<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Créer un compte</title>
</head>

<body>
	Créer un compte administrateur :
	<form action='../admin/SetAdminAccount.php' method='post'>
		Pseudo : <input name='pseudo' type='text'><br>
		Nom : <input name='nom' type='text'><br>
		Prénom : <input name='prenom' type='text'><br>
		Promo : <input name='promo' type='number'><br>
		Adresse mail : <input name='email' type='text'><br>
		Mot de passe : <input name='password' type='password'><br>
		<input name='stupid' type='checkbox'> Je certifie ne pas avoir lu la charte <br>
		<input name='submit' type='submit' value='envoyer'>
	</form>
</body>
</html>