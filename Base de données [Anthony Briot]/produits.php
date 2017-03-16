<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Produits</title>
  <link rel="stylesheet" href="style1.css">
  <script src="script.js"></script>
</head>

<?php

	?>
	<header><h1>
	<?php
	echo "TABLE PRODUITS";
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
				
				
	$reponse = $bdd->query('SELECT * FROM produits');
	?><section><?php
	while ($donnees = $reponse->fetch())
	{
		?>
		<table>
		<tr>
		<th><strong>NumProduit</strong> : <?php echo $donnees['NumProduit']; ?></th>
		<th><strong>Description</strong> : <?php echo $donnees['Des']; ?></th>
		<th><strong>PUHT</strong> : <?php echo $donnees['PUHT']; ?> €</th>
		</tr>
		</table>
		<?php
	}
		?>
		
		<br/><br/>
		<strong>Entrez un NumProduit pour voir le produit correspondant :</strong>
		<br/><br/>
        <form action="produits.php" method="POST">
			<input type="text" name="Numero"/><br/>
			<input type="submit" value="Valider" />
		</form>
	
		<?php
		if (isset($_POST['Numero']) and !empty($_POST['Numero']))
		{
			$req = $bdd->prepare('SELECT NumProduit,Des,PUHT FROM produits WHERE NumProduit=?');
			$req->execute(array($_POST['Numero']));
			
			while ($donnees = $req->fetch())
			{
			?>
			<table>
			<tr>
			<th><strong>NumProduit</strong> : <?php echo $donnees['NumProduit']; ?></th>
			<th><strong>Description</strong> : <?php echo $donnees['Des']; ?></th>
			<th><strong>PUHT</strong> : <?php echo $donnees['PUHT']; ?></th>
			</tr>
			</table>
			<?php
			}
		}
		?>
		
		<br/><br/>
		<strong>Pour ajouter un produit, veuillez compléter tous les champs et valider :</strong>
		<br/><br/>
        <form action="produits.php" method="POST">
			<label id="Description">Description :</label><br/>
			<input type="text" name="Description"/> <br/>
			<label id="PUHT">Prix unitaire hors taxe :</label><br/>
			<input type="text" name="PUHT"/> <br/>
			<input type="submit" value="Valider" />
		</form>
		
		<?php
			if (	isset($_POST['Description']) and
					isset($_POST['PUHT']) and
					!empty($_POST['Description']) and
					!empty($_POST['PUHT']))
					{
						//preparation de la requete
						$req = $bdd->prepare('INSERT INTO produits(Des,PUHT) VALUES (:Description,:PUHT)');
						$req->execute(array(
							//''=>$_POST[''],
							'Description'=>$_POST['Description'],
							'PUHT'=>$_POST['PUHT']
							));
							
						echo "Votre requête a été ajouter à la base.";
							
					$req->closeCursor();
					
					}
		?>


		<br/><br/>
		<!--Formulaire pour mettre à jour un produit -->
		<strong>Pour mettre à jour un produit, veuillez entrer le numéro du produit que vous souhaitez modifier, puis les nouvelles informations :</strong><br/>
		<i>(Vous devez compléter tout les champs)</i>
	
		<br/><br/>
	
        <form action="produits.php" method="POST">
			<label id="numProduit">Numéro du produit :</label><br/>
			<input type="text" name="numProduit"/><br/>
			<label id="newDescription">Description :</label><br/>
			<input type="text" name="newDescription"/> <br/>
			<label id="newPUHT">Prix unitaire hors taxe :</label><br/>
			<input type="text" name="newPUHT"/> <br/>
			<input type="submit" value="Valider" />
		</form>
		</form>
		
		<?php
		
		//Vérification que tout les champs sont renseignés
			if (isset($_POST['numProduit']) and
			isset($_POST['newDescription']) and
			isset($_POST['newPUHT']) and
			!empty($_POST['numProduit']) and
			!empty($_POST['newDescription']) and
			!empty($_POST['newPUHT']))
			{
				
		//Préparation de la requete
				$req = $bdd->prepare('UPDATE produits SET Des=:newDescription, PUHT=:newPUHT WHERE NumProduit=:numProduit');
		
		//Exécution de la requête
				$req->execute(array(
					//''=>$_POST[''],
					'numProduit'=>$_POST['numProduit'],
					'newDescription'=>$_POST['newDescription'],
					'newPUHT'=>$_POST['newPUHT']
					));
					
				echo "Votre requête a été effectuer sur la base.";
					
		$req->closeCursor();
			}
		?>

		<br/><br/>

		<!--Formulaire pour supprimer un produit -->
		<strong>Pour supprimer un produit, veuillez entrer le numéro du produit que vous souhaitez supprimer :</strong>
	
		<br/><br/>
	
        <form action="produits.php" method="POST">
			<label id="numeroProduit">Numéro du produit :</label><br/>
			<input type="text" name="numeroProduit"/><br/>
			<input type="submit" value="Valider" />
		</form>
		
		<?php
		
		//Vérification que le champ est renseigné
			if (isset($_POST['numeroProduit']) and
			!empty($_POST['numeroProduit']))
			{
				
		//Préparation de la requete
				$req = $bdd->prepare('DELETE FROM produits WHERE NumProduit=:numeroProduit');
		
		//Exécution de la requête
				$req->execute(array(
					//''=>$_POST[''],
					'numeroProduit'=>$_POST['numeroProduit'],
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