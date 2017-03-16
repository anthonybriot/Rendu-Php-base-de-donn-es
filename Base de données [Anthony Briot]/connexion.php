<?php
	session_start();
	//Connexion bdd Mysql
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=facture_cours', 'root', '',Array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	
	
	if (isset($_POST['pseudo']) and isset($_POST['password']) and !empty($_POST['pseudo']) and !empty($_POST['password']))
	{
		
		$req = $bdd->prepare('SELECT pseudo,password FROM connexion WHERE pseudo=?');
		$req->execute(array	($_POST['pseudo']));
						
		while ($donnees = $req->fetch())
		{
			if ($donnees['pseudo']==$_POST['pseudo'] and password_verify($_POST['password'], $donnees['password']))
			{
				$_SESSION['PSEUDO'] = $_POST['pseudo'];
				header('Location: index.php');
				
			}else
			{
				header('Location: index.php');
			}
		}
	}else
	{
		header('Location: index.php');
	}
?>