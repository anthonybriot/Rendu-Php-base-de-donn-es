<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Facture</title>
  <link rel="stylesheet" href="style1.css">
  <script src="script.js"></script>
</head>

<?php

	?>
	<header><h1>
	<?php
	echo "TABLE FACTURE";
	?>
	</h1>
	<?php
	echo "<a href='index.php'> retour à l'index</a>";
	?>
	</header>
	<?php
	echo'<br/>';
	echo'<br/>';
	
	//Connexion bdd Mysql
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=facture_cours', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
				
				
	$reponse = $bdd->query('SELECT * FROM facture');
	?><section><?php
	while ($donnees = $reponse->fetch())
	{
		?>
		<table>
		<tr>
		<th><strong>NumFacture</strong> : <?php echo $donnees['NumFacture']; ?></th>
		<th><strong>DateFacture</strong> : <?php echo $donnees['DateFacture']; ?></th>
		<th><strong>NumClient</strong> : <?php echo $donnees['NumClient']; ?></th>
		</tr>
		</table>
		<?php
	}
		?>
		
		<br/><br/>
		<strong>Entrez un NumFacture pour voir la facture correspondante :</strong>
		<br/><br/>
        <form action="facture.php" method="POST">
			<input type="text" name="Numero"/><br/>
			<input type="submit" value="Valider" />
		</form>
	
		<?php
		if (isset($_POST['Numero']) and !empty($_POST['Numero']))
		{
			$req = $bdd->prepare('SELECT NumFacture,DateFacture,NumClient FROM facture WHERE NumFacture=?');
			$req->execute(array($_POST['Numero']));
			
			while ($donnees = $req->fetch())
			{
			?>
			<table>
			<tr>
			<th><strong>NumFacture</strong> : <?php echo $donnees['NumFacture']; ?></th>
			<th><strong>DateFacture</strong> : <?php echo $donnees['DateFacture']; ?></th>
			<th><strong>NumClient</strong> : <?php echo $donnees['NumClient']; ?></th>
			</tr>
			</table>
			<?php
			}
		}
		?>

		<br/><br/>

		<!--Formulaire pour supprimer une facture -->
		<strong>Pour supprimer une facture, veuillez entrer le numéro de la facture que vous souhaitez supprimer :</strong>
	
		<br/><br/>
	
        <form action="facture.php" method="POST">
			<label id="numFacture">Numéro de la facture :</label><br/>
			<input type="text" name="numFacture"/><br/>
			<input type="submit" value="Valider" />
		</form>
		
		<?php
		
		//Vérification que le champ est renseigné
			if (isset($_POST['numFacture']) and
			!empty($_POST['numFacture']))
			{
				
		//Préparation de la requete
				$req = $bdd->prepare('DELETE FROM facture WHERE NumFacture=:numFacture');
		
		//Exécution de la requête
				$req->execute(array(
					//''=>$_POST[''],
					'numFacture'=>$_POST['numFacture'],
					));
					
				echo "Votre requête a été effectuer sur la base.";
					
		$req->closeCursor();
			}
		?>


	</section>
	<footer>
    Anthony Briot © 2017 Projet PHP
	</footer>
    </body>
</html>