<?php $this->titre = "Blog Alaska - Historique"; ?>

<h1>Historique de modération</h1>

<div id="wrapper-logs">
	
	<!-- Commentaires effacés -->
	<div id="deletewrapper" class="wrapperlogs">
		<?php
		foreach ($logsDel as $historiqueDel): ?>
		<div class="comment logs box">
			<div class="comstatus">
				<p>Un commentaire a été supprimé le <time><?= $historiqueDel['mod_date_fr'] ?></time></p>
			</div>
			<p>Auteur : <?= htmlspecialchars($historiqueDel['author']) ?>
			<p>Posté le <time><?= $historiqueDel['post_date_fr'] ?></time></p>
			<p>Commentaire : <?= htmlspecialchars($historiqueDel['oldcontent']) ?></p>
		</div>
		<?php endforeach; ?>
	</div>
</div>