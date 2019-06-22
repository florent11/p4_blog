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
    
    public function displayAdmin($order) {
		if(isset($_SESSION['userId'])){
			$commentaires = $this->administration->getSignCom();
			$commentnbr = $this->administration->countSignCom();
			// $admin = $this->administration->getAccountInfo($username);
				
			// Billets Croissant / Decroissant
			// $sortPost = "desc";
			$_SESSION['sort'] = $order;
			if($_SESSION['sort'] == 'desc') {
				$billets = $this->billet->getBillets();
				} else {
				$billets = $this->billet->getBilletsAsc();
			}
			// Generation vue.
			$vue = new View("Admin");
			$vue->generer(array('admin' => $_SESSION['userId'], 'billets' => $billets, 'commentaires' => $commentaires, 'signComNbr' => $commentnbr));
		} else {
			header('Location: index.php');
		}
	}
	
	
	// Afficher commentaire signalés panel Admin
	public function displaySignCom(){
		$commentaires = $this->administration->getSignCom();
	}
	
	//-- Modération --//

	
	// Moderer commentaire
	public function moderateCom($contenus, $idCommentaire){
		$this->administration->insertLogs($idCommentaire);
		$this->administration->insertLogsMod($idCommentaire);
		$this->administration->modSignCom($contenus, $idCommentaire);
		header('Location: index.php?action=administration&sort=desc');
	}
	
	// Suppression commentaire
	public function suppressCom($idCommentaire){
		$this->administration->insertLogs($idCommentaire);
		$this->administration->insertLogsSupp($idCommentaire);
		$this->administration->suppressCom($idCommentaire);
		header('Location: index.php?action=administration&sort=desc');
	}
	
	
	//--- CRUD ---//
	// Creation Billet
	public function create($title, $content)
	{
		$this->administration->create($title, $content);
		header('Location: index.php?action=administration&sort=desc');
	}
	
	// Suppression Billet
	public function suppress($idBillet)
	{
		$this->administration->suppress($idBillet);
		header('Location: index.php?action=administration&sort=desc');
	}
	
	// Modification Billet
	public function update($idBillet, $titreBillet, $contenuBillet)
	{
		$this->administration->update($idBillet, $titreBillet, $contenuBillet);
		header('Location: index.php?action=administration&sort=desc');
	}
		

}