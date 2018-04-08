<?php
	session_start();
	include '../html/DBconfig.php';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/styles.css">
	<title>Recherche</title>
</head>
	
<body>
	<?php
<<<<<<< HEAD
		$recherche= htmlspecialchars($_POST['recherche']);
		$resultats_recherche=[];
		$nombreDeResultat=0;
=======
		$recherche=htmlspecialchars($_POST['recherche']);
	?>
	<form action="recherche.php" method="POST">
		  <input type="text" name="recherche" value=<?php echo '"' . $recherche . '"' ?></input>
		  <input type="submit" value="" class="search_pic">
	</form>
	<?php
>>>>>>> 22a1e3453a13a760e7cc2b4ac7ab74bb14ea18b1
		
		#Recherche par PROMO
		if(preg_match("#^(11[89]|12[0123]|201[89]|202[0123]){1}$#", $recherche) ==1)
		{
			echo "<strong>Personnes : </strong><br>";
			$requete_bdd=$db->prepare("SELECT * FROM Personnes WHERE promo =?");
			$requete_bdd->bind_param("s",$recherche);
			$requete_bdd->execute();
			$result=$requete_bdd->get_result();
			$nombreDeResultat=$result->num_rows;
			if($nombreDeResultat=!0)
			{
				echo "<br>".$nombreDeResultat . " resultats pour la recherche '".$recherche . "'<br>";
				while($row = $result->fetch_assoc())
				{
					echo $row['nom']. " ".$row['prenom']." (".$row['promo']." )<br>";
				}
			}
			else
			{
				echo "Aucune personnes trouvée dans la promo ". $recherche."<br>";
			}
		}
		
		#Recherche par PRENOM NOM  
		elseif(preg_match("#^[a-zéèçôîûâ]{3,}+( [a-zçôîûâ]+)?$#i",$recherche) ==1)
		{
			$recherche = explode(" " , $recherche);
			$prenom= '^'.$recherche[0];
			$nom= '^'.$recherche[1];
			
			echo "<strong>Etudiant : </strong><br>";
			$requete_bdd=$db->prepare("SELECT nom,prenom,promo,nb_record_battu 
										FROM Personnes 
										WHERE prenom REGEXP ? AND nom REGEXP ? OR prenom REGEXP ? AND nom REGEXP ?");
			$requete_bdd->bind_param("ssss",$prenom,$nom,$nom,$prenom);
			$requete_bdd->execute();
			$result=$requete_bdd->get_result();
			if($result->num_rows==0){
				echo "Aucun resultat trouvé pour ". $recherche."<br>";
			}
			else
			{
				while($row = $result->fetch_assoc())
				{
					echo $row['nom']. " ".$row['prenom']." (".$row['promo'].") a battu ".$row['nb_record_battu']." paniers !<br>";
				}
			}
		}
			
		elseif(preg_match("#^[a-zéèçôîûâ]{1}[a-zçôîûâ]{1}$#i",$recherche) ==1)
		{	#recherche par INITIALES
			echo "Initiales <br>";
			$prenom= '^'.$recherche[0];
			$nom= '^'.$recherche[1];
			
			echo $prenom;
			echo $nom;
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
		}
	
	
		else
		{
			#Recherche dans les details 		
			echo "<strong>Panier : </strong><br>";
			$rechercheAvecPourcentage="%{$_POST['recherche']}%";

			$requete_bdd=$db->prepare("SELECT champion FROM Records WHERE detail LIKE ?");
			$requete_bdd->bind_param("s",$rechercheAvecPourcentage);
			$requete_bdd->execute();
			$result=$requete_bdd->get_result();
			$IdChampions = array();
			while($row = $result->fetch_assoc())
			{	
				array_push($IdChampions,$row['champion']);
			}

			$IdChampions=implode(", ",$IdChampions);
			$resultatsRecords=$db->query("SELECT nom,prenom,promo FROM Personnes WHERE Id IN($IdChampions)");
			if($resultatsRecords->num_rows==0){
				echo "Aucun panier pour la recherche : ". $recherche."<br>";
			}
			else
			{
				echo "voici les champions des panier contenants ".$recherche." : <br>";
				while($row = $resultatsRecords->fetch_assoc())
				{	
					echo $row['prenom']." ".$row['nom']." (".$row['promo'].")<br>";
				}
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