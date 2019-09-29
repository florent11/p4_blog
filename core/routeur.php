<?php

require_once 'controller/controleurAccueil.php'; 
require_once 'controller/controleurBillet.php';
require_once 'controller/controleurAdmin.php';
require_once 'controller/ctrlAdminRegister.php'; 
require_once 'controller/controleurErreur.php'; 
require_once 'viewClass.php';

class Routeur 
{
	private $ctrlAccueil;
	private $ctrlBillet;
	private $ctrlAdmin;
	private $ctrlAdminRegister;
	private $ctrlErreur;

	public function __construct() 
	{
		$this->ctrlAccueil = new controleurAccueil();
		$this->ctrlBillet = new controleurBillet();
		$this->ctrlAdmin = new controleurAdmin();
		$this->ctrlAdminRegister = new ctrlAdminRegister();
		$this->ctrlErreur = new controleurErreur();
	}

	// Traite une requête entrante
	public function routerRequete() 
	{
		try {
			if (isset($_GET['action'])) {
		
				switch($_GET['action']) {
					case 'billet':
						$idBillet = intval($this->getParametre($_GET, 'id'));
						if ($idBillet != 0) {
							$this->ctrlBillet->billet($idBillet);
						}
						else {
							throw new Exception("Identifiant de billet non valide");
						}
						break;
				
					case 'commenter':
						$auteur = $this->getParametre($_POST, 'auteur');
						$contenu = $this->getParametre($_POST, 'contenu');
						$idBillet = $this->getParametre($_POST, 'id');
						$this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
						break;
							
					case 'signaler':
						$idBillet = $this->getParametre($_POST, 'idBillet');
						$idCom = $this->getParametre($_POST, 'idCom');
						$this->ctrlBillet->signaler($idBillet, $idCom);
						break;
						
					case 'deconnexion':
						$this->ctrlAdmin->deconnexion();
						break;

					case 'admin':
						if($connexion == false){
							$connexion = $this->ctrlAdmin->connexionAdmin();
						}
						if($_SESSION['username']){
							if(isset($_GET["sort"])) {
								$order = $this->getParametre($_GET, 'sort');
							}
							else {
								$order = "desc";
							}
							$this->ctrlAdmin->displayAdmin($order);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'create':
						if($_SESSION['username']){
							$this->ctrlAdmin->createView();
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;	

					case 'creer':
						if($_SESSION['username']){
							$titreBillet = $this->getParametre($_POST, 'title');
							$contenuBillet = $this->getParametre($_POST, 'content');
							$this->ctrlAdmin->create($titreBillet, $contenuBillet);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'supprimer':
						if($_SESSION['username']){
							$idBillet = $this->getParametre($_GET, 'id');
							$this->ctrlAdmin->suppress($idBillet);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'vueModifier':
						if($_SESSION['username']){
							$idBillet = $this->getParametre($_GET, 'id');
							$this->ctrlAdmin->updateView($idBillet);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'modifier':
						if($_SESSION['username']){					
							$idBillet = $this->getParametre($_GET, 'id');
							$titreBillet = $this->getParametre($_POST, 'title');
							$contenuBillet = $this->getParametre($_POST, 'content');
							$this->ctrlAdmin->update($idBillet, $titreBillet, $contenuBillet);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
					
					case 'validComment':
						if($_SESSION['username']){
							$idCom = $this->getParametre($_POST, 'cid');
							$this->ctrlAdmin->validComment($idCom);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'moderer':
						if($_SESSION['username']){
							$idCom = $this->getParametre($_POST, 'cid');
							$modCom = $this->getParametre($_POST, 'modCom');
							$this->ctrlAdmin->moderateCom($modCom, $idCom);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'suppresscom':
						if($_SESSION['username']){
							$idCom = $this->getParametre($_GET, 'id');
							$this->ctrlAdmin->suppressCom($idCom);
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;

					case 'logs':
						if($_SESSION['username']){
							$this->ctrlAdmin->logsView();
						}
						else {
							throw new Exception("Administrateur non connecté");
						}
						break;
						
					case 'registration':
							$this->ctrlAdminRegister->createFormView();
						break;

					case 'adminregistration':
							$name = $this->getParametre($_POST, 'nom');
							$pass = $this->getParametre($_POST, 'password');
							$this->ctrlAdminRegister->registration($name, $pass);
						break;
	
					default:
						throw new Exception("Action non valide");
				}
			}
			else { // Aucune action definie : affichage de l'accueil
				$this->ctrlAccueil->accueil();
			}
		}
			catch (Exception $e) {
				$this->ctrlErreur->erreur($e->getMessage());
			}
		}
		
	// Recherche un paramètre dans un tableau
	private function getParametre($tableau, $nom) 
	{
		if (isset($tableau[$nom])) {
			return $tableau[$nom];
		} 
		else {
			throw new Exception("Parametre '$nom' absent");
		}	
	}
}