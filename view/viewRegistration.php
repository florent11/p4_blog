<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Billet Simple pour l'Alaska, une histoire de Jean Forteroche">
		<link rel="stylesheet" href="public/style.css" />
		<link rel="icon" type="image/png" href="public/images/favicon.png" />
		<title>Blog Alaska - Inscription de l'admin</title>
		<!-- Font Awesome CDN -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" integrity="sha256-39jKbsb/ty7s7+4WzbtELS4vq9udJ+MDjGTD5mtxHZ0=" crossorigin="anonymous" />
	</head>

	<body>  
        <div id="wrapper-home">
	        <h2>Inscription de l'administrateur du blog</h2>
    	    <form method="POST" action="index.php?action=adminregistration" id="registration_form">
		    <p>Nom: <input type="text" name="nom" required /> </p> 
            <p>Mots de Passe: <input type="password" name="password" required /> </p> <br/>
    	    </form>
        <div class="buttonRow">
	    	<button class="button left" form="registration_form">Envoyer</button>
        </div>
        </div>
</body>
</html>