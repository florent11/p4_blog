<?php

require_once 'model/billet.php';
require_once 'core/viewClass.php';

class controleurAccueil 
{
  private $billet;

  public function __construct() 
  {
    $this->billet = new Billet();
  }

    // Affiche la liste de tous les billets du blog
    public function accueil() 
    {
        $billets = $this->billet->getBillets();
        $vue = new View("Home");
        $vue->generer(array('billets' => $billets));
    }
}
    