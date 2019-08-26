<?php $this->titre = "Blog Alaska - Administration"; ?>

<div id="wrapper-admin">
	
	<div id="admin">
	
		<h1>Administration</h1>
		<div class="boxadmin">
			<i class="fas fa-plus-circle adminicon"></i>
			<h2 class="moderationstatus"><a href="index.php?action=create">Creer un nouveau Billet</a></h2>
		</div>
		<div class="buttonRow boxsort">

			<a href="index.php?action=admin&sort=desc" class="button" id="recent">Plus Récent</a>
			<hr>
			<a href="index.php?action=admin&sort=asc" class="button" id="ancien">Plus Ancien</a>

		</div>
		
		<div id="billet-wrapper">
		<?php
			foreach ($billets as $billet): ?>
			<div class="adminbillet">
				<a href="<?= "index.php?action=billet&id=" . $billet['bil_id'] ?>">
					<h3><?= $billet['bil_titre'] ?></h3>
				</a>
				
				<div class="buttonAdmin">
					<a href="<?= "index.php?action=vueModifier&id=" . $billet['bil_id'] ?>" title="Modifier Billet" class="fas fa-pen-square"></a>
					<a href="<?= "index.php?action=supprimer&id=" . $billet['bil_id'] ?>" title="Supprimer Billet" class="fas fa-trash"></a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
		
	<div id="moderation">
		<h1>Modération commentaire</h1>
		<div class="boxadmin">
			<?php 
				if($signComNbr['nbsigncoms'] > 1) {
					echo "<i class='fas fa-exclamation-triangle adminicon'></i>
					<h2 class='moderationstatus'>Il y a " . $signComNbr['nbsigncoms'] . " commentaires à modérer</h2>";
				} else if($signComNbr['nbsigncoms'] == 1) {
					echo "<i class='fas fa-exclamation-triangle orange adminicon'></i>
					<h2 class='moderationstatus'>Il y a " . $signComNbr['nbsigncoms'] . " seul commentaire à modérer</h2>";
				} else {
					echo "<i class='fas fa-check-circle adminicon'></i>
					<h2 class='moderationstatus'>Tout va bien, il n'y a rien à modérer</h2>";
				}
			?>
		</div>
		<div class="boxadmin">
			<i class='fas fa-history adminicon'></i>
			<h2 class="moderationstatus"><a href='index.php?action=logs'>Accéder à l'historique de modération</a></h2>
		</div>
		<?php
		$nb = 0;
		foreach ($commentaires as $signComs): 
		$nb ++;
		?>
		
		<article class="comment box">
			<header>
			<!-- Titre du commentaire !-->
				<div class="modComInfo">
					<p>Commentaire ID : <?= $signComs['com_id'] ?> </p>
					<p>Posté par : <strong><?= htmlspecialchars($signComs['author'])?></strong> le <?= $signComs['date_fr']?></p>
					<a class="fas fa-times-circle crosscom" title="Supprimer Commentaire" href="index.php?action=suppresscom&id=<?= $signComs['com_id'] ?>"></a>
				</div>
			</header>

			<div class="editcom">
				<form method="post" class="editform" action="index.php?action=moderer">
					<input type="hidden" name="cid" value="<?= $signComs['com_id'] ?>" />
					<input type="hidden" name="modCom" value="<?= $signComs['content'] ?>" />
					<p> <?= $signComs['content']?> </p>
					<button class="button modbutton">Valider</button>
				</form>
			</div>
		</article>

		<?php endforeach; ?>
	</div>
</div>
