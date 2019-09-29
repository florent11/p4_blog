<?php $this->titre = "Blog Alaska : Accueil"; ?>

<div id="wrapper-home">
	<?php foreach ($billets as $billet): ?>
	<div class="wrapper">
		<article class="billet box">
			<header>
				<a href="<?= "index.php?action=billet&id=" . $billet['bil_id'] ?>">
					<h2 class="postTitle"><?= $billet['bil_titre'] ?></h2>
				</a>
				<div class="timeinfo">
					<p class="time">Le <?= $billet['date_fr'] ?></p>
				</div>
			</header>
			<div class="wrapper">
				<p><?= $billet['bil_contenu'] ?></p>
			</div>
		</article>
	</div>
	<?php endforeach; ?>
</div>