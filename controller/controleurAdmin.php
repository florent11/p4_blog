<?php 

require_once '../model/billet.php';
require_once '../model/admin.php';
require_once '../view/viewClass.php';

class ControleurAdmin {

	private $signCom;

	public function __construct() {
		$this->administration = new Admin();
		$this->billet = new Billet();
	}

	// Afficher formulaire de connexion
	public function connexion() {
		$vue = new View("Connexion");
		$vue->generer();
	}
	
	// Afficher formulaire Creation billet
	public function createView(){
		$vue = new View("Create");
		$vue->generer();
	}
	
	// Afficher formulaire Modif Billet
	public function updateView($idBillet) {
		$billet = $this->billet->getBillet($idBillet);
		$vue = new View("Modifier");
		$vue->generer(array("billet" => $billet));
	}
	
	// Afficher logs modération
	public function logsView(){
		$logsMod = $this->administration->getLogsBetterMod();
		$logsDel = $this->administration->getLogsBetterDel();
		$vue = new View("Logs");
		$vue->generer(array("logsMod" => $logsMod, "logsDel" => $logsDel));
	}
	
	public function deconnexion() {
		session_unset();
		session_destroy();
		header('Location: index.php');
    }
    
    public function admin() {
		if(isset($_SESSION['userId'])) {
		
			$commentaires = $this->administration->getSignCom();
			$billets = $this->billet->getBillets();
			// Generation vue.
			$vue = new View("Admin");
			$vue->generer(array('billets' => $billets, 'commentaires' => $commentaires));
		} else {
			header('Location: index.php');
			echo 'Mauvaise session';
		}
	}

	// Espace administration
	public function connexionAdmin(){
		$connexion = false;
		if(isset($_POST['username']) && isset($_POST['password'])) {
		
			$username = ($_POST['username']);
			$password = ($_POST['password']);
			$admin = $this->administration->getAccountInfo($username);
			// $pass_hache = password_hash($password, PASSWORD_DEFAULT); 
			$isPassCorrect = password_verify($password, $admin['pass']);
			// echo $isPassCorrect;
			if($username == 'Admin' && $isPassCorrect) {
			
				$_SESSION['userId'] = $username;
				$connexion = true;
			} else {
				$connexion = false;
			}
		}
		return $connexion;
	}