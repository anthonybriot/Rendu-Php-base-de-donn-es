<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Client</title>
  <link rel="stylesheet" href="style1.css">
  <script src="script.js"></script>
</head>

<?php
	?>
	<header><h1>
	<?php
	echo "TABLE CLIENT";
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
				
	//On sélectionne toute la table			
	$reponse = $bdd->query('SELECT * FROM client');
	?><section><?php
	//Affichage de chaque ligne de la table
	while ($donnees = $reponse->fetch())
	{
		?>
		
		<table>
		<tr>
		<th><strong>NumClient</strong> : <?php echo $donnees['NumClient']; ?></th>
		<th><strong>Nom</strong> : <?php echo $donnees['NomClient']; ?></th>
		<th><strong>Prenom</strong> : <?php echo $donnees['PrenomClient']; ?></th>
		<th><strong>Adresse</strong> : <?php echo $donnees['AdresseClient']; ?></th>
		<th><strong>Ville</strong> : <?php echo $donnees['VilleClient']; ?></th>
		<th><strong>Code postal</strong> : <?php echo $donnees['Cp']; ?></th>
		<th><strong>Pays</strong> : <?php echo $donnees['PaysClient']; ?></th>
		</tr>
		</table>
		<?php
	}
		?>
		
		<br/><br/>
		
		<!-- première recherche -->
		<!--Formulaire pour la recherche d'un NumClient dans la table client -->
		<strong>Entrez un NumClient pour voir le client correspondant :</strong>
		<br/><br/>
        <form action="client.php" method="POST">
			<input type="text" name="Numero"/><br/>
			<input type="submit" value="Valider" />
		</form>
	
		<?php
		//Vérification du champ, s'il est remplit
		if (isset($_POST['Numero']) and !empty($_POST['Numero']))
		{
			//Préparation de la requête select pour NumClient=?(ici ? est Numero)
			$req = $bdd->prepare('SELECT NumClient,NomClient,PrenomClient,AdresseClient,VilleClient,Cp,PaysClient FROM client WHERE NumClient=?');
			
			//Exécution
			$req->execute(array($_POST['Numero']));
			
			//Affichage
			while ($donnees = $req->fetch())
			{
			?>
			<table>
			<tr>
			<th><strong>NumClient</strong> : <?php echo $donnees['NumClient']; ?></th>
			<th><strong>Nom</strong> : <?php echo $donnees['NomClient']; ?></th>
			<th><strong>Prenom</strong> : <?php echo $donnees['PrenomClient']; ?></th>
			<th><strong>Adresse</strong> : <?php echo $donnees['AdresseClient']; ?></th>
			<th><strong>Ville</strong> : <?php echo $donnees['VilleClient']; ?></th>
			<th><strong>Code postal</strong> : <?php echo $donnees['Cp']; ?></th>
			<th><strong>Pays</strong> : <?php echo $donnees['PaysClient']; ?></th>
			</tr>
			</table>
			<?php
			}
		}
			?>
			
		<br/><br/>
		
		<!-- seconde recherche -->
		<!--Formulaire pour la recherche d'un NomClient dans la table client -->
		<strong>Entrez un NomClient pour voir les détails du ou des client(s) correspondant(s) :</strong>
		
		<br/><br/>
		
        <form action="client.php" method="POST">
			<input type="text" name="nom"/><br/>
			<input type="submit" value="Valider" />
		</form>
	
		<?php
		//Vérification du champ, s'il est remplit
		if (isset($_POST['nom']) and !empty($_POST['nom']))
		{
			//Préparation de la requête select pour NomClient=?(ici ? est nom)
			$req = $bdd->prepare('SELECT NumClient,NomClient,PrenomClient,AdresseClient,VilleClient,Cp,PaysClient FROM client WHERE NomClient=?');
		
			//Exécution
			$req->execute(array($_POST['nom']));
			
			//Affichage
			while ($donnees = $req->fetch())
			{
			?>
			<table>
			<tr>
			<th><strong>NumClient</strong> : <?php echo $donnees['NumClient']; ?></th>
			<th><strong>Nom</strong> : <?php echo $donnees['NomClient']; ?></th>
			<th><strong>Prenom</strong> : <?php echo $donnees['PrenomClient']; ?></th>
			<th><strong>Adresse</strong> : <?php echo $donnees['AdresseClient']; ?></th>
			<th><strong>Ville</strong> : <?php echo $donnees['VilleClient']; ?></th>
			<th><strong>Code postal</strong> : <?php echo $donnees['Cp']; ?></th>
			<th><strong>Pays</strong> : <?php echo $donnees['PaysClient']; ?></th>
			</tr>
			</table>
			<?php
			}
		}
			?>

		<!-- Test recherche avec 1 ou plusieurs critères
		<br/><br/>
		<strong> :</strong>
		<br/><br/>
        <form action="client.php" method="POST">
			<label id="nomClient">Nom du client :</label><br/>
			<input type="text" name="nomClient"/><br/>
			<label id="prenomClient">Prenom du client :</label><br/>
			<input type="text" name="prenomClient"/><br/>
			<label id="adresseClient">Adresse du client :</label><br/>
			<input type="text" name="adresseClient"/><br/>
			<label id="villeClient">Ville du client :</label><br/>
			<input type="text" name="villeClient"/><br/>
			<label id="cpClient">Code Postal du client :</label><br/>
			<input type="text" name="cpClient"/><br/>
			<label id="paysClient">Pays du client :</label><br/>
			<input type="text" name="paysClient"/><br/><br/>
			<input type="submit" value="Valider" />
		</form>
		 -->	
		<?php
		/*
		//Vérification qu'un champ est renseigné
			if (	(isset($_POST['nomClient']) and !empty($_POST['nomClient'])) or
					(isset($_POST['prenomClient']) and !empty($_POST['prenomClient'])) or
					(isset($_POST['adresseClient']) and !empty($_POST['adresseClient'])) or
					(isset($_POST['villeClient']) and !empty($_POST['villeClient'])) or
					(isset($_POST['cpClient']) and !empty($_POST['cpClient'])) or
					(isset($_POST['paysClient']) and !empty($_POST['paysClient']))
				);			
			{
			//Préparation de la requête select pour NomClient=?(ici ? est nom)
			$req = $bdd->prepare('SELECT NumClient,NomClient,PrenomClient,AdresseClient,VilleClient,Cp,PaysClient FROM client WHERE NomClient=? OR PrenomClient=?');
			//Exécution
			$req->execute(array($_POST['nomClient']));
			
			//Affichage
			while ($donnees = $req->fetch())
			{
			?>
			<table>
			<tr>
			<th><strong>NumClient</strong> : <?php echo $donnees['NumClient']; ?></th>
			<th><strong>Nom</strong> : <?php echo $donnees['NomClient']; ?></th>
			<th><strong>Prenom</strong> : <?php echo $donnees['PrenomClient']; ?></th>
			<th><strong>Adresse</strong> : <?php echo $donnees['AdresseClient']; ?></th>
			<th><strong>Ville</strong> : <?php echo $donnees['VilleClient']; ?></th>
			<th><strong>Code postal</strong> : <?php echo $donnees['Cp']; ?></th>
			<th><strong>Pays</strong> : <?php echo $donnees['PaysClient']; ?></th>
			</tr>
			</table>
			<?php
			}
		}
		*/?>
		
		
		<br/><br/>
		
		<!--Formulaire pour ajouter un client -->
		<strong>Pour ajouter un client, veuillez compléter tous les champs et valider :</strong>
	
		<br/><br/>
	
        <form action="client.php" method="POST">
			<label id="nomClient">Nom du client :</label><br/>
			<input type="text" name="nomClient"/><br/>
			<label id="prenomClient">Prenom du client :</label><br/>
			<input type="text" name="prenomClient"/><br/>
			<label id="adresseClient">Adresse du client :</label><br/>
			<input type="text" name="adresseClient"/><br/>
			<label id="villeClient">Ville du client :</label><br/>
			<input type="text" name="villeClient"/><br/>
			<label id="cpClient">Code Postal du client :</label><br/>
			<input type="text" name="cpClient"/><br/>
			<label id="paysClient">Pays du client :</label><br/>
			<input type="text" name="paysClient"/><br/>
			<input type="submit" value="Valider" />
		</form>
		
		<?php
		
		//Vérification que tout les champs sont renseignés
			if (isset($_POST['nomClient']) and
			isset($_POST['prenomClient']) and
			isset($_POST['adresseClient']) and
			isset($_POST['villeClient']) and
			isset($_POST['cpClient']) and
			isset($_POST['paysClient']) and
			!empty($_POST['nomClient']) and
			!empty($_POST['prenomClient']) and
			!empty($_POST['adresseClient']) and
			!empty($_POST['villeClient']) and
			!empty($_POST['cpClient']) and
			!empty($_POST['paysClient']))
			{
				
		//Préparation de la requete
				$req = $bdd->prepare('INSERT INTO client(NomClient,PrenomClient,AdresseClient,Cp,VilleClient,PaysClient) VALUES (:nomClient,:prenomClient,:adresseClient,:villeClient,:cpClient,:paysClient)');
		
		//Exécution de la requête
				$req->execute(array(
					//''=>$_POST[''],
					'nomClient'=>$_POST['nomClient'],
					'prenomClient'=>$_POST['prenomClient'],
					'adresseClient'=>$_POST['adresseClient'],
					'villeClient'=>$_POST['villeClient'],
					'cpClient'=>$_POST['cpClient'],
					'paysClient'=>$_POST['paysClient']
					));
					
				echo "Votre requête a été ajouter à la base.";
					
		$req->closeCursor();
			}
		?>

		<br/><br/>
		<!--Formulaire pour mettre à jour un client -->
		<strong>Pour mettre à jour un client, veuillez entrer le numéro du client que vous souhaitez modifier, puis les nouvelles informations :</strong><br/>
		<i>(Vous devez compléter tout les champs)</i>
	
		<br/><br/>
	
        <form action="client.php" method="POST">
			<label id="numClient">Numéro du client :</label><br/>
			<input type="text" name="numClient"/><br/>
			<label id="newNom">Nom du client :</label><br/>
			<input type="text" name="newNom"/><br/>
			<label id="newPrenom">Prenom du client :</label><br/>
			<input type="text" name="newPrenom"/><br/>
			<label id="newAdresse">Adresse du client :</label><br/>
			<input type="text" name="newAdresse"/><br/>
			<label id="newVille">Ville du client :</label><br/>
			<input type="text" name="newVille"/><br/>
			<label id="newCp">Code Postal du client :</label><br/>
			<input type="text" name="newCp"/><br/>
			<label id="newPays">Pays du client :</label><br/>
			<input type="text" name="newPays"/><br/>
			<input type="submit" value="Valider" />
		</form>
		
		<?php
		
		//Vérification que tout les champs sont renseignés
			if (isset($_POST['numClient']) and
			isset($_POST['newNom']) and
			isset($_POST['newPrenom']) and
			isset($_POST['newAdresse']) and
			isset($_POST['newVille']) and
			isset($_POST['newCp']) and
			isset($_POST['newPays']) and
			!empty($_POST['numClient']) and
			!empty($_POST['newNom']) and
			!empty($_POST['newPrenom']) and
			!empty($_POST['newAdresse']) and
			!empty($_POST['newVille']) and
			!empty($_POST['newCp']) and
			!empty($_POST['newPays']))
			{
				
		//Préparation de la requete
				$req = $bdd->prepare('UPDATE client SET NomClient=:newNom, PrenomClient=:newPrenom, AdresseClient=:newAdresse, VilleClient=:newVille, Cp=:newCp, PaysClient=:newPays WHERE NumClient=:numClient');
		
		//Exécution de la requête
				$req->execute(array(
					//''=>$_POST[''],
					'numClient'=>$_POST['numClient'],
					'newNom'=>$_POST['newNom'],
					'newPrenom'=>$_POST['newPrenom'],
					'newAdresse'=>$_POST['newAdresse'],
					'newVille'=>$_POST['newVille'],
					'newCp'=>$_POST['newCp'],
					'newPays'=>$_POST['newPays']
					));
					
				echo "Votre requête a été effectuer sur la base.";
					
		$req->closeCursor();
			}
		?>

		<br/><br/>

		<!--Formulaire pour supprimer un client -->
		<strong>Pour supprimer un client, veuillez entrer le numéro du client que vous souhaitez supprimer :</strong>
	
		<br/><br/>
	
        <form action="client.php" method="POST">
			<label id="numClient">Numéro du client :</label><br/>
			<input type="text" name="numClient"/><br/>
			<input type="submit" value="Valider" />
		</form>
		
		<?php
		
		//Vérification que le champ est renseigné
			if (isset($_POST['numClient']) and
			!empty($_POST['numClient']))
			{
				
		//Préparation de la requete
				$req = $bdd->prepare('DELETE FROM client WHERE NumClient=:numClient');
		
		//Exécution de la requête
				$req->execute(array(
					//''=>$_POST[''],
					'numClient'=>$_POST['numClient'],
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
		