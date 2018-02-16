<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Créer un compte</title>
</head>

<body>
	Créer un compte administrateur :
	<form action='../admin/SetAdmin.php' method='post'>
		Pseudo : <input name='pseudo' type='text'><br>
		Nom : <input name='nom' type='text'><br>
		Prénom : <input name='prenom' type='text'><br>
		Promo : <input name='promo' type='number'><br>
		Adresse mail : <input name='pseudo' type='text'><br>
		<input name='isadmin' type='checkbox'> Je certifie ne pas avoir lu la charte <br>
		<input name='submit' type='submit' value='envoyer'>
	</form>
</body>
</html>