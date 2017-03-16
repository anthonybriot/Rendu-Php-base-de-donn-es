<?php
	//Connexion bdd Mysql
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=facture_cours', 'root', '',Array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	//verif si champ remplis
	if (isset($_POST['pseudo']) and isset($_POST['password']) and !empty($_POST['pseudo']) and !empty($_POST['password']))
	{
		//preparation de la requete
		$req = $bdd->prepare('INSERT INTO connexion(pseudo,password) VALUES (:pseudo,:password)');
		//envoie des données dans la base
		$req->execute(array(
					'pseudo'=>$_POST['pseudo'],
					//'password'=>$_POST['password']
					//'password'=>hash('md2', $_POST['password'])
					'password'=>password_hash($_POST['password'], PASSWORD_BCRYPT)
					));
					
		$req->closeCursor();
		header('Location: index.php');
	}
?>