<?php
    session_start();
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <link rel="stylesheet" href="style1.css">
  <script src="script.js"></script>
</head>
    <body>
        <?php
				//si utilisateur connecté
            if (!empty($_SESSION['PSEUDO']))
			{
               ?><header><h1><?php
				echo 'Bonjour '.$_SESSION['PSEUDO'].' !';
				?></h1><?php
				echo '<a href="deconnexion.php"> se deconnecter</a>';
				?></header><?php
			echo'<br/>';
			echo'<br/>';
			?>
			<section>
			<nav id="menu">
			<div class="element">
			
			<a href='client.php'>CLIENT</a>
			</form>
			</div>
			
			<div class="element">
			
			<a href='facture.php'>FACTURE</a>
			</form>
			</div>
			
			<div class="element">
			
			<a href='produits.php'>PRODUITS</a>
			</form>
			</div>
			
			<div class="element">
			
			<a href='creatfacture.php'>IMPRESSION</a>
			</form>
			</div>
			</nav>
			</section>
			
			<?php
			
            }else
			{
		?>
						<header>
						<div class="header-wrapper">
                        <h1>Inscription</h1>
						</div>
						</header>

						<br/><br/>

						<section>
					<p>	Inscription : <br/>
                        <form action="inscription.php" method="POST">
                            <label id="pseudo">Pseudo</label><br/>
                            <input type="text" name="pseudo"/><br/><br/>
                            <label id="password">Mot de passe</label><br/><input type="password" name="password"/><br/>
                            <input type="submit" value="Valider" />
                        </form><br/><br/>
                        Connexion :<br/><br/>
                        <form action="connexion.php" method="POST">
                            <label id="pseudo">Pseudo</label><br/>
                            <input type="text" name="pseudo"/><br/><br/>
                            <label id="password">Mot de passe</label><br/><input type="password" name="password"/><br/>
                            <input type="submit" value="Valider" />
                        </form>
						</section>
                    </p>
                <?php
            }
        ?>

	<footer>
    Anthony Briot © 2017 Projet PHP
	</footer>
    </body>
</html>


<!--A FAIRE : 		TRAVAIL 1 : page connexion/deconnexion/inscription/password hash 		-> fini
					TRAVAIL 2 : affichage fiche client/produits/facture + css 				-> fini
					TRAVAIL 3 : affichage d'une ligne avec numclient/ajouter client/produit -> fini
								update de la table client/produit							-> fini
								delete client/produit/facture 								-> fini 
					TRAVAIL 4 :	version imprimable css print								-> à finir <-
					TRAVAIL 5 : ReadMe installation/utilisation 							-> à finir <-

					date de rendu fixé au vendredi 17/03 sur l'ensemble des modules demandés dans le sujet.



!-->