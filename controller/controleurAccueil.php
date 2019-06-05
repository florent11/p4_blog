<?php

require_once 'model/billet.php';
require_once 'view/viewClass.php';


class ControleurAccueil {

  private $billet;

  public function __construct() {
    $this->billet = new Billet();
  }