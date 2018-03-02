<?php
session_start();
include 'DBconfig.php';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Recherche</title>
</head>
	
<body>
	<h1>Voici les résultats de ta recherche !</h1>

	<?php
	#function determination_recherche($recherche, $start_lign, $rows_per_page)
	{
		$recherche=$_POST['recherche'];
		switch ($recherche){
				
			case(preg_match("#^(11[89]|12[0123]|201[89]|202[0123]){1}$#", $recherche) ==1):
			{	#recherche par promo
				echo "case promo<br>";
				$promo= $recherche;
				echo $promo;
				$recherche_bdd =$db->query("SELECT nom,prenom,nb_record_battu FROM Personnes WHERE promo =" . $promo) or die(print_r($db->errorInfo()));

				while($row = $recherche_bdd->fetch_assoc())
					{	
						echo $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
					};
				break;
			}
				
				
			case(preg_match("#^[a-zéèçôîûâ]+ [a-zçôîûâ]+$#i",$recherche) ==1):
			{	#recherche par prenom nom
				echo "case prenom/nom<br>";
				$recherche = explode(" " , $recherche);
				$prenom= '^'.$recherche[0];
				$nom= '^'.$recherche[1];
				
				$recherche_bdd =$db->query("SELECT nom,prenom,nb_record_battu 
											FROM Personnes 
											WHERE prenom REGEXP '" . $prenom . "'
											AND nom REGEXP '" . $nom . "'
											OR prenom REGEXP '" . $nom . "'   		 
											AND nom REGEXP '" . $prenom . "' ")		
									or die(print_r($db->errorInfo()));

				while($row = $recherche_bdd->fetch_assoc())
					{	
						echo $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
					};
				break;;
			}
				
			
			case(preg_match("#^[a-zéèçôîûâ]{1}[a-zçôîûâ]{1}$#i",$recherche) ==1):
			{	#recherche par initiales
				echo "case initiales pn<br>";
				$prenom= '^'.$recherche[0];
				$nom= '^'.$recherche[1];
				
				$recherche_bdd =$db->query("SELECT nom,prenom,nb_record_battu 
											FROM Personnes 
											WHERE prenom REGEXP '" . $prenom . "'
											AND nom REGEXP'" . $nom . "'")
									or die(print_r($db->errorInfo()));

				while($row = $recherche_bdd->fetch_assoc())
					{	
						echo $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
					};
				break;
			}	
			
				
			case(preg_match("#^[a-zéèçôîûâ]{3,}$#i",$recherche) ==1):
			{	#recherche par prenom ou nom
				echo "case prenom ou nom<br>";
				$prenom_ou_nom= '^'.$recherche;
				
				$recherche_bdd =$db->query("SELECT nom,prenom,nb_record_battu 
											FROM Personnes 
											WHERE prenom REGEXP '" . $prenom_ou_nom . "'
											OR nom REGEXP '" . $prenom_ou_nom . "' ")		
									or die(print_r($db->errorInfo()));

				while($row = $recherche_bdd->fetch_assoc())
					{	
						echo $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
					};
				break;;
			}	
				
			
				
				

				
				
				
			default:
			{
				$recherche = explode(" " , $recherche);
            	$prenom = $recherche[0];
				echo $prenom;
				echo "arrete de rager  <br>";
				break;
			}
		}
	}
	
	
		
	
	
	?>
	
</body>
</html>