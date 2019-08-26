<?php
session_start();

require 'core/routeur.php';

$routeur = new Routeur();
$routeur->routerRequete();
