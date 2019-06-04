<?php

session_start();

require 'controller/Routeur.php';

$routeur = new Routeur();
$routeur->routerRequete();
