<?php
session_start();
include '../html/DBconfig.php';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Recherche2</title>
</head>
	
<body>
	<h1>Voici les résultats de ta recherche2 !</h1>

	<?php
	$recherche= htmlspecialchars($_POST['recherche']);
	
	function rechercher($recherche)
	{	
		#Création d'array de reponses vides
		$resultat_personne=[];
		$resultat_records=[];
		$resultat_tags=[];
		
		
		#Recherche par PROMO
		if(preg_match("#^(11[89]|12[0123]|201[89]|202[0123]){1}$#", $recherche) ==1)
		{
			#echo "<strong>Personnes : </strong><br>";
			$requete_bdd=$db->prepare("SELECT * FROM Personnes WHERE promo =?");
			$requete_bdd->bind_param("s",$recherche);
			$requete_bdd->execute();
			$resultat_personne=$requete_bdd->get_result();
			$nombreDeResultatPersonnes=$resultat_personne->num_rows;
			
		}
		
		else
		{	#recherche par INITIALES
			if(preg_match("#^[a-zéèçôîûâ]{1}[a-zçôîûâ]{1}$#i",$recherche) ==1)
			{	
				#echo "Initiales <br>";
				$prenom= '^'.$recherche[0];
				$nom= '^'.$recherche[1];

				$requete_bdd =$db->query("SELECT *
											FROM Personnes 
											WHERE prenom REGEXP '" . $prenom . "'
											AND nom REGEXP'" . $nom . "'")
									or die(print_r($db->errorInfo()));
				$resultat_personne=$requete_bdd->get_result();
				$nombreDeResultatPersonnes=$resultat_personne->num_rows;
			}	
		
		
			#recherche par Tag
			else
			{
				$requete_bdd=$db->query('SELECT * 
										FROM Records
										JOIN Tag_Records ON (Tags_Recods.IdRecord = Records.Id)
										JOIN Tag ON (Tag.Id=Tags_Records.IdTag)
										WHERE Tags.nom ="'.$recherche.'"')
								or die(print_r($db->errorInfo()));
				$resultat_tags=$requete_bdd->get_result();
				$nombreDeResultatRecords=$resultat_tags->num_rows;
			}
		}
	$resul
		
		
	
	return 
	}
	
	
		
		
		$nombreDeResultat=0;
		
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
			
	
	
	
	
	
	
</body>
</html>