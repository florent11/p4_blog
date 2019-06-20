<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Billet Simple pour l'Alaska, une histoire de Jean Forteroche">
		<link rel="stylesheet" href="public/style.css" />
		<link rel="icon" type="image/png" href="public/images/favicon.png" />
		<title><?= $titre ?></title>
		<!-- Font Awesome CDN -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" integrity="sha256-39jKbsb/ty7s7+4WzbtELS4vq9udJ+MDjGTD5mtxHZ0=" crossorigin="anonymous" />
		<!-- Tiny MCE -->
		<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
  		<script>tinymce.init({selector:'textarea'});</script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="brand">
					<a href="index.php">
						<img id="logo" src="public/images/logo2.png" alt="Logo Blog" title="Logo Alaska" />
					</a>
					<h1 id="blogTitle"><a href="index.php">Billet simple pour l'Alaska</a></h1>
				</div>
					
				<div id="login">
					<?php
					if(isset($_SESSION['userId'])){
						echo '<p><a href="index.php?action=administration&sort=desc" class="button-connexion" id="logintext">Administration</a></p>
							<a href="index.php?action=administration&sort=desc" class="fas fa-tasks button-connexion" id="loginlogo"></a>
							<p><a href="index.php?action=deconnexion" class="button-connexion" id="logintext">Deconnexion</a></p>
							<a href="index.php?action=deconnexion" class="fas fa-sign-out-alt button-connexion" id="loginlogo"></a>';
					}else {
						echo '<form method="POST" id="connexionAdmin" action="index.php?action=connexionAdmin">
						<input type="text" name="username" placeholder="Identifiant" required/>
						<input type="password" name="password" placeholder="Mot de passe" required/>
						<input type="submit" class="button-connexion" id="logintext" value="Connexion">
						</form>
						<button class="button-connexion" id="loginlogo" form="connexionAdmin"><i class="fas fa-sign-in-alt"></i></button>';
					}
					?>
				</div>
					
			</div>
				<?= $content ?> 
			<footer>
				Billet Simple pour l'Alaska, écrit par Jean Forteroche.
			</footer>
		</div>
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"
				integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  	crossorigin="anonymous"></script>
		<!-- JS -->
		<script src="public/js/main.js"></script>
	</body>
</html>