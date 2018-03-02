<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Recherche</title>
</head>
	
<body>
	<h1>Voici les résultats de ta recherche !</h1>

	<?php
	
	function determination_recherche($recherche)
{
    global $bd;
    switch ($recherche)
    {
        case(preg_match("#^(11[89]|12[0123]|201[89]|202[0123]){1}$#", $recherche) ? true : false):
        {
            $champ='promo';
            $rechercheee = explode(" ", $recherche,5);
            $promo = $rechercheee[0];
            if(!isset($rechercheee[1]))
            {
                $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE promo = :promo LIMIT :start_lign, :rows_per_page');
                $recherche_bdd -> bindParam('start_lign', $start_lign, PDO::PARAM_INT);
                $recherche_bdd -> bindParam('rows_per_page', $rows_per_page, PDO::PARAM_INT);
                $recherche_bdd -> bindParam('promo', $promo, PDO::PARAM_STR);
                $count_recherche = count_promo($promo);
            }
	
	
	
	
	
	
		}
	}
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	?>
	
</body>
</html>