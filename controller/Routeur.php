<?php

require_once 'controleurAccueil.php'; 
require_once 'controllerBillet.php';
require_once 'controleurAdmin.php';
require_once 'view/viewClass.php';
require_once 'ctrlAdminRegister.php'; 

class Routeur {

	private $ctrlAccueil;
	private $ctrlBillet;
	private $ctrlAdmin;
	private $ctrlAdminRegister;

	public function __construct() {
		$this->ctrlAccueil = new controleurAccueil();
		$this->ctrlBillet = new controleurBillet();
		$this->ctrlAdmin = new controleurAdmin();
		$this->ctrlAdminRegister = new ctrlAdminRegister();
	}

	// Traite une requête entrante
	public function routerRequete() {
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

						case 'connexion':
							$this->ctrlAdmin->connexion();
						break;
						
						case 'admin':
						$this->ctrlAdmin->displayAdmin();
						break;
						
						case 'connexionAdmin':
							$connexion = $this->ctrlAdmin->connexionAdmin();
							if($connexion){
								$order = "desc";
								$this->ctrlAdmin->displayAdmin($order);
							} else {
								throw new Exception("Erreur de connexion");
							}	
						break;
						
						case 'creer':
							$titreBillet = $this->getParametre($_POST, 'title');
							$contenuBillet = $this->getParametre($_POST, 'content');
							$this->ctrlAdmin->create($titreBillet, $contenuBillet);
						break;
						
						case 'supprimer':
							$idBillet = $this->getParametre($_GET, 'id');
							$this->ctrlAdmin->suppress($idBillet);
						break;
						
						case 'vueModifier':
							$idBillet = $this->getParametre($_GET, 'id');
							$this->ctrlAdmin->updateView($idBillet);
						break;
						
						case 'create':
							$this->ctrlAdmin->createView();
						break;
						
						case 'logs':
							$this->ctrlAdmin->logsView();
						break;
						
						case 'modifier':
							$idBillet = $this->getParametre($_GET, 'id');
							$titreBillet = $this->getParametre($_POST, 'title');
							$contenuBillet = $this->getParametre($_POST, 'content');
							$this->ctrlAdmin->update($idBillet, $titreBillet, $contenuBillet);
						break;
						
						case 'moderer':
							$idCom = $this->getParametre($_POST, 'cid');
							$modCom = $this->getParametre($_POST, 'modCom');
							$this->ctrlAdmin->moderateCom($modCom, $idCom);
						break;
						
						case 'suppresscom':
							$idCom = $this->getParametre($_GET, 'id');
							$this->ctrlAdmin->suppressCom($idCom);
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
				$this->erreur($e->getMessage());
			}
		}

	// Affiche une erreur
	private function erreur($msgErreur) {
		$vue = new View("Error");
		$vue->generer(array('msgErreur' => $msgErreur));
	}
	  
	// Recherche un paramètre dans un tableau
	private function getParametre($tableau, $nom) {
		if (isset($tableau[$nom])) {
			return $tableau[$nom];
		} else
			throw new Exception("Parametre '$nom' absent");
	}

}