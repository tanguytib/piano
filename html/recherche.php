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
	
		$recherche=$_POST['recherche'];
		switch (isset($recherche))
		{
				
			case(preg_match("#^(11[89]|12[0123]|201[89]|202[0123]){1}$#", $recherche) ==1):
			{	#recherche par PROMO
				echo "Promo <br>";
				$promo= $recherche;
				$recherche_bdd =$db->query("SELECT Id,nom,prenom,nb_record_battu 
											FROM Personnes 
											WHERE promo =" . $promo) 
									or die(print_r($db->errorInfo()));
				if(mysqli_num_rows($recherche_bdd)==0){
					echo "Sorry we couldn't find anything like that !";	
				}
				else
				{ 
					while($row = $recherche_bdd->fetch_assoc())
						{	
							echo "<div id='" . $row['Id'] ."'>" . $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
						};
				}	
				break;
			}
				
				
			case(preg_match("#^[a-zéèçôîûâ]{3,}+( [a-zçôîûâ]+)?$#i",$recherche) ==1):
			{	#recherche par PRENOM NOM
				echo "Prenom nom <br>";
				$recherche = explode(" " , $recherche);
				$prenom= '^'.$recherche[0];
				$nom= '^'.$recherche[1];
				
				$recherche_bdd =$db->query("SELECT Id,nom,prenom,nb_record_battu 
											FROM Personnes 
											WHERE prenom REGEXP '" . $prenom . "'
											AND nom REGEXP '" . $nom . "'
											OR prenom REGEXP '" . $nom . "'   		 
											AND nom REGEXP '" . $prenom . "' ")		
									or die(print_r($db->errorInfo()));
				
				if(mysqli_num_rows($recherche_bdd)==0){
					echo "Sorry we couldn't find anything like that !";	
				}
				else
				{ 
					while($row = $recherche_bdd->fetch_assoc())
						{	
							echo "<div id='" . $row['Id'] ."'>" . $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
						};
				}
				break;;
			}
			
				
	
			case(preg_match("#^[a-zéèçôîûâ]{1}[a-zçôîûâ]{1}$#i",$recherche) ==1):
			{	#recherche par INITIALES
				echo "Initiales <br>";
				$prenom= '^'.$recherche[0];
				$nom= '^'.$recherche[1];
				
				$recherche_bdd =$db->query("SELECT Id,nom,prenom,nb_record_battu 
											FROM Personnes 
											WHERE prenom REGEXP '" . $prenom . "'
											AND nom REGEXP'" . $nom . "'")
									or die(print_r($db->errorInfo()));
				if(mysqli_num_rows($recherche_bdd)==0){
					echo "Sorry we couldn't find anything like that !";	
				}
				else
				{ 
					while($row = $recherche_bdd->fetch_assoc())
					{	
						echo "<div id='" . $row['Id'] ."'>" . $row['nom'] . " " . $row['prenom'] . " " . $row['promo'] . " " . $row['nb_record_battu'] . "<br>" ;
					};
				}
				break;
			}
			
			
			case(preg_match("#^[a-zéèçôîûâ]{4,}$#i",$recherche) ==1):
			{	#recherche par RECORDS
				echo "Records <br>";
				$recherche_bdd =$db->query("SELECT Id,intitule,detail,champion,numero_phare 
											FROM Records 
											WHERE intitule REGEXP '". $recherche ."'
											OR detail REGEXP '". $recherche ."' ")
									or die(print_r($db->errorInfo()));
				if(mysqli_num_rows($recherche_bdd)==0){
					echo "Sorry we couldn't find anything like that !";	
				}
				else
				{ 
					while($row = $recherche_bdd->fetch_assoc())
					{	
						echo "<div id='" . $row['Id'] ."'>" . $row['intitule'] . " " . $row['detail'] . " " . $row['champion'] . " " . $row['numero_phare'] . "<br>" ;
					};
				}
			break;
			}
			
				

			default:
			{
				echo "arrete de rager " . $recherche;
				break;
			}
		}
	

	?>
	
</body>
</html>