<?php $this->titre = "Blog Alaska - Historique"; ?>

<h1>Historique de modération</h1>

<div id="wrapper-logs">
	<!-- Commentaires validés -->
	<div id="editwrapper" class="wrapperlogs">
		<?php 
		foreach ($logsMod as $historiqueEdit): ?>
		<div class="comment logs box">
			<div class="editstatus">
				<a href="<?="index.php?action=billet&id=" . $historiqueEdit['post_id']?>"/>Ce commentaire a été validé le <time><?= $historiqueEdit['mod_date_fr'] ?></time></a>
			</div>
			<p>Auteur : <?= htmlspecialchars($historiqueEdit['author']) ?></p>
			<p>Posté le <time><?= $historiqueEdit['post_date_fr'] ?></time></p>
			<p>Commentaire :</p> <?= htmlspecialchars($historiqueEdit['oldcontent']) ?></p>
		</div>
		<?php endforeach; ?>
	</div>
	
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