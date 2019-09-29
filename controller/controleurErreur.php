<?php

require_once 'core/viewClass.php';

class controleurErreur
{
    // Affiche une erreur
	public function erreur($msgErreur) 
	{
		$vue = new View("Error");
		$vue->generer(array('msgErreur' => $msgErreur));
    }
}