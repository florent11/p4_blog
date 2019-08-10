<?php $this->titre = "Blog Alaska - " . $billet['titre'];?>

<div id="wrapper-home">
	<div class="wrapper">
		<article class="billet box">
		  <header>
			<h1 class="postTitle"><?= $billet['titre'] ?></h1>
			<time><i>Le <?= $billet['date_fr'] ?></i></time>
		  </header>
		  <p><?= $billet['contenu'] ?></p>
		</article>
	</div>
	
	<div class="wrapper">
		<header class="box">
		  <h1 class="commentTitle">Il y a <?= $totalCommentaires['nbcomments'] ?> commentaires pour <?= $billet['titre'] ?></h1>
		</header>

		<?php foreach ($commentaires as $commentaire): ?>
		<div class="comment box">
		  <div class="commentInfo"><b><?= htmlspecialchars($commentaire['auteur']) ?></b> posté le <?= $commentaire['date_fr'] ?> 
			<form method="post" action="index.php?action=signaler">
				<input type="hidden" name="idBillet" value="<?= $billet['id'] ?>" />
				<input type="hidden" name="idCom" value="<?= $commentaire['id'] ?>" />
				<div class="signaler">
				<?php
					if($commentaire['signaler'] == 1){
						echo "<i class='signalinfo'>Ce contenu a déjà été signalé</i>";
					} else {
						echo '<button class="fas fa-exclamation-circle" title="Signaler le commentaire" ></button>';
					};
					?>
				</div>
			</form>
		  </div>

		  <p><?= $commentaire['contenu'] ?></p>
		</div>
		<?php endforeach; ?>
		<header class="box">
			<h2 class="commentTitle">Laissez-moi un commentaire !</h2>
		</header>
		<form id="commentform" method="post" action="index.php?action=commenter">
			<div class="form-bloc">
				<input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" required /><br />
				<textarea id="commentformcontent" name="contenu" rows="8" placeholder="Votre commentaire" required></textarea><br />
				<input type="hidden" name="id" value="<?= $billet['id'] ?>" />
			</div>
			<div class="form-bloc">
				<input type="submit" class="button submit" value="Poster" />
			</div>
		</form>
	</div>
</div>
