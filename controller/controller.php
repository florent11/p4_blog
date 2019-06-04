<?php

require '../model/billet.php';

// Affiche la liste de tous les billets du blog
function accueil()
{
	$modelBillet = new Billet;
	$billets = $modelBillet->getBillets();
	//require 'view/view.php'; 
}
accueil();

// Affiche les details sur un billets
function billet($idBillet)
{
	$modelBillet = new Billet;
	$billet = $modelBillet->getBillet($idBillet);

	$modelCommentaires = new Commentaire;
	$commentaires = $modelCommentaires->getCommentaires($idBillet);
	require '../view/viewBillet.php';
}

// Affiche une erreur
function erreur($msgErreur)
{
	//require 'view/errorView.php';
}
