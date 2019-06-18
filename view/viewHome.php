<?php ini_set('display_errors', 'on')?>
<?php $this->titre = "Blog Alaska : Accueil"; ?>


<div id="wrapper-home">
	<?php foreach ($billets as $billet): ?>
	<div class="wrapper">
		<article class="billet box">
			<header>
				<a href="<?= "index.php?action=billet&id=" . $billet['id'] ?>">
					<h2 class="postTitle"><?= $billet['bil_titre'] ?></h1>
				</a>
				<div class="timeinfo">
					<time><i>Le <?= $billet['bil_date'] ?></i></time>
				</div>
			</header>
			<div class="wrapper">
				<p><?= $billet['bil_contenu'] ?></p>
			</div>
		</article>
	</div>
	<?php endforeach; ?>

</div>