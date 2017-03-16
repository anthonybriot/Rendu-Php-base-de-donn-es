<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Impression</title>
  <link rel="stylesheet" href="style1.css">
  <script src="script.js"></script>
</head>

<?php

	?>
	<header><h1>
	<?php
	echo "IMPRESSION FACTURE";
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
        <form action="creatfacture.php" method="POST">
			<input type="text" name="Numero"/><br/>
			<input type="submit" value="Valider" />
		</form>
	
		<?php
		if (isset($_POST['Numero']) and !empty($_POST['Numero']))
		{
			$reponse = $bdd->prepare('SELECT NumFacture,DateFacture,NumClient FROM facture WHERE NumFacture=?');
			$reponse->execute(array($_POST['Numero']));
			$req1 = $reponse->fetch();
			$reponse->closeCursor();
			
			$reponse = $bdd->prepare('SELECT Qte, NumProduit FROM d_facture WHERE Numfacture=?');
			$reponse->execute(array($_POST['Numero']));
			$req2 = $reponse->fetch();
			$reponse->closeCursor();
			
			$reponse = $bdd-> prepare('SELECT NomClient,PrenomClient,AdresseClient,Cp,VilleClient,PaysCLient FROM client WHERE client.NumClient=facture.NumClient');
			$req3 = $reponse->fetch();
			$reponse->closeCursor();
			
			$reponse = $bdd-> prepare('SELECT NumProduit, Des, PUHT FROM produits WHERE produits.NumProduit = d_facture.NumProduit' );
			$req4 = $reponse->fetch();
			$reponse->closeCursor();
			
		
		?>
	
			<table>
			<tr>
			<th><strong>NumFacture</strong> : <?php echo $req1['NumFacture']; ?></th>
			<th><strong>DateFacture</strong> : <?php echo $req1['DateFacture']; ?></th>
			<th><strong>NumClient</strong> : <?php echo $req1['NumClient']; ?></th>
			<th><strong>Quantité</strong> : <?php echo $req2['Qte']; ?></th>
			<th><strong>NumProduit</strong> : <?php echo $req2['NumProduit']; ?></th>
			<th><strong>NomClient</strong> : <?php echo $req3['NomClient']; ?></th>
			<th><strong>PrenomClient</strong> : <?php echo $req3['PrenomClient']; ?></th>
			<th><strong>AdresseClient</strong> : <?php echo $req3['AdresseClient']; ?></th>
			<th><strong>Cp</strong> : <?php echo $req3['Cp']; ?></th>
			<th><strong>VilleClient</strong> : <?php echo $req3['VilleClient']; ?></th>
			<th><strong>PaysClient</strong> : <?php echo $req3['PaysClient']; ?></th>
			<th><strong>Description</strong> : <?php echo $req4['Des']; ?></th>
			<th><strong>PUHT</strong> : <?php echo $req4['PUHT']; ?></th>
			</tr>
			</table>
			
			
		<?php
		}
		?>
			
			
			
	</section>
	<footer>
    Anthony Briot © 2017 Projet PHP
	</footer>
    </body>
</html>


