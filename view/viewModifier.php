<?php $this->titre = "Blog Alaska - Modifier un billet"; ?>

<div id="wrapper-home">
	<h2>Modifier un Billet</h2>
	<form method="POST" action="<?= "index.php?action=modifier&id=" . $billet['id']?>" id="modifier_form">
		<input type="text" name="title" value="<?= $billet['titre'] ?>" /><br/>
		<textarea id="editable" rows="30" cols="20" name="content" form="modifier_form"><?= $billet['contenu'] ?></textarea>
	</form>
	<div class="buttonRow">
		<button class="button left" form="modifier_form">Modifier le Billet</button>
		<a href="index.php?action=administration&sort=desc" class="button right">Retour Administration</a>
	</div>
</div>