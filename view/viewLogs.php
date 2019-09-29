<?php $this->titre = "Blog Alaska - Historique"; ?>

<h1>Historique de modération</h1>

<div id="wrapper-logs">
	<!-- Commentaires Modéré -->
	<div id="editwrapper" class="wrapperlogs">
		<?php 
		foreach ($logsMod as $historiqueEdit): ?>
		<div class="comment logs box">
			<div class="editstatus">
				<a href="<?="index.php?action=billet&id=" . $historiqueEdit['post_id']?>"/>Ce commentaire a été modéré le <span class="time"><?= $historiqueEdit['mod_date_fr'] ?></span></a>
			</div>
			<p>Auteur : <?= htmlspecialchars($historiqueEdit['author']) ?></p>
			<p>Posté le <span class="time"><?= $historiqueEdit['post_date_fr'] ?></span></p>
			<p>Commentaire :<?= $historiqueEdit['oldcontent'] ?></p>
		</div>
		<?php endforeach; ?>
	</div>
	
	<!-- Commentaires effacés -->
	<div id="deletewrapper" class="wrapperlogs">
		<?php
		foreach ($logsDel as $historiqueDel): ?>
		<div class="comment logs box">
			<div class="comstatus">
				<p>Ce commentaire a été supprimé le <span class="time"><?= $historiqueDel['mod_date_fr'] ?></span></p>
			</div>
			<p>Auteur : <?= htmlspecialchars($historiqueDel['author']) ?></p>
			<p>Posté le <span class="time"><?= $historiqueDel['post_date_fr'] ?></span></p>
			<p>Commentaire : <?= $historiqueDel['oldcontent'] ?></p>
		</div>
		<?php endforeach; ?>
	</div>
</div>