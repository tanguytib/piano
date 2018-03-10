<?php
session_start();
include '../html/DBconfig.php';
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
		#Cette 2emem methode de recherche marche mais le fieldcount==0 ne marche pas...
		$recherche=$_POST['recherche'];
		$requete_bdd=$db->prepare("SELECT Id,nom,prenom,nb_record_battu 
												FROM Personnes 
												WHERE promo =?
												ORDER BY nb_record_battu DESC");
		$requete_bdd->bind_param("s",$recherche);
		$requete_bdd->execute();
		$result=$requete_bdd->get_result();
		if($requete_bdd->field_count==0){
			echo "Aucun résultats PROMO ";	
		}
		else
		{ 
			while($row = $result->fetch_assoc())
			{	echo '<br>dasn le while <br>';
				printf ("%s fait parti de la promo 120<br>",$row['nom']);
				printf ("Il a battu %s de record<br>",$row['nb_record_battu']);
				printf ("nom : %s<br><br>",$row['prenom']);				
			}
		}
		/*
		$recherche=$_POST['recherche'];
		determination_recherche($recherche);
	
		function determination_recherche($recherche)
		{
			$resultats_recherche=[];
			
			switch ($recherche)
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
						echo "Aucun résultats PROMO ";	
					}
					else
					{ 
						while($row = $recherche_bdd->fetch_assoc())
							{	
								echo "dans le while";
								array_push($resultats_recherche,"Id");
								array_push($resultats_recherche,"nom");
								array_push($resultats_recherche,"prenom");
								array_push($resultats_recherche,"promo");
								array_push($resultats_recherche,"nb_record_battu");
								
								$resultats_recherche['Id']=$row['Id'];
								$resultats_recherche['nom']=$row['nom'];
								$resultats_recherche['prenom']=$row['prenom'];
								$resultats_recherche['promo']=$row['promo'];
								$resultats_recherche['nb_record_battu']=$row['nb_record_battu'];
						
							echo $resultats_recherche[1]."<br>";
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
						echo "Aucun résultats PRENOM NOM ";	
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
						echo "Aucun résultats INITIALES ";	
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

				/*
				case(preg_match("#^[a-zéèçôîûâ]{4,}$#i",$recherche) ==1):
				{	#recherche par RECORDS
					echo "Records <br>";
					$recherche_bdd =$db->query("SELECT Id,intitule,detail,champion,numero_phare 
												FROM Records 
												WHERE intitule REGEXP '". $recherche ."'
												OR detail REGEXP '". $recherche ."' ")
										or die(print_r($db->errorInfo()));
					if(mysqli_num_rows($recherche_bdd)==0){
						echo "Aucun résultats RECORDS ";	
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
			return 'return : '.$resultats_recherche[0].$resultats_recherche[1];
		}
	*/
	?>
	
</body>
</html>