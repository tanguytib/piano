<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/styles.css">
    <meta name="viewport" content="width=device-width">
    <title>piano</title>
  </head>
    
<body>
    <header>
        <div >
            <p class ="mecenes">La Taverne</p>
            <p class ="mecenes">Le Domaine</p>
        </div>
    <img src="../content/imgSite/piano.png" width ="200px">

    </header>
   
	
	
<?php
	//Allez hop une petite DB histoire de bosser tranquille, on la changera bien sur quand le site sera en ligne
$database = 'sql11220909';
$username = 'sql11220909';
$password = 'zD2yGIfB15';
$hostname = 'sql11.freesqldatabase.com';
$link = mysql_connect($hostname, $username, $password);
$db_selected = mysql_select_db($database, $link);

?>	
	
</body>
</html>
        