<!doctype HTML>
<?php
	session_start();
	include '../admin/fonctionsPhp/logincheck.php';
	include '../DBconfig.php';
?>

<html>
<head>
	<?php
		include '../background.php';
	?>
	<title>Admin panel</title>
</head>

<body>
	<h1 >Gestion du site</h1>
	<br>
	<br>
	<a class="btn btn-default" href='FormAdminAccount.php'>Créer un compte admin</a>
	<a class="btn btn-default" href='../admin/creerRecord.php'>Créer un piano</a><br>
	<br>
	<h3>Liste des évènements non validés : </h3>
	<br>
	<div class='container-fluid'>
		<?php
			#On recherche les évènements non validés
				$recordsRevendique = $db->query("SELECT *, Evenements.Id AS Idevenement FROM Evenements INNER JOIN Records ON Evenements.Idrecord=Records.Id WHERE IsNull(Evenements.date_validation) OR Evenements.date_validation='0000-00-00'") or die(print_r($db->errorInfo()));
					while($row = $recordsRevendique->fetch_assoc()) 
					{	
						echo 
						"
						<div class='row row-padded'>
							<div class='col-lg-3'>
								<div class='row'>
									<div class='col-lg-12'>
										<h2>" . $row['intitule'] . "</h2> 
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-12'>
										salut
									</div>
								</div>
							</div>
							<div class='col-lg-5'>" . $row['detail'] . "
							</div>
							<div class='col-lg-2'>
								<a class='btn btn-default' href=../admin/modifierRecord.php?Id=" . $row['Idevenement'] . "> Modifier le panier </a>
							</div>
							<div class='col-lg-1'>
								<a class='btn btn-success' href=../admin/modifierEvenement.php?Id=" . $row['Idevenement'] . "> Valider</a>
							</div>
							<div class='col-lg-1'>
								<button class='btn btn-large btn-danger' data-toggle='confirmation'
									data-btn-ok-label='Eh oui' data-btn-ok-icon='glyphicon glyphicon-share-alt'
									data-btn-ok-class='btn-success'
									data-btn-cancel-label='Nooooon !' data-btn-cancel-icon='glyphicon glyphicon-ban-circle'
									data-btn-cancel-class='btn-danger'
									data-title='Attention' data-content='Supprimer cet événement ?'
									href='/html/admin/fonctionsPhp/suppressionEvenement.php?Id=" . $row['Idevenement'] . "'> Supprimer
								</button>
							</div>
						</div>
						";
					};
		?>
	</div>


	<br>

	
	<!-- Javascript popup confirmation-->
	<script>
		$('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		});
	</script>
</body>
</html>