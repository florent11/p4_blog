<?php $this->titre = "Blog Alaska - Inscription"; ?>

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