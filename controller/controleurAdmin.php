<?php 
require_once 'model/billet.php';
require_once 'model/admin.php';
require_once 'core/viewClass.php';

class controleurAdmin 
{
	private $signCom;

	public function __construct() 
	{
		$this->administration = new Admin();
		$this->billet = new Billet();
	}

	// Gestion de la connexion à l'espace d'administration
	public function connexionAdmin()
	{
		$connexion = false;
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$admin = $this->administration->getAccountInfo($username);
			$isPassCorrect = password_verify($password, $admin['pass']);
			
			if($isPassCorrect) {
				$_SESSION['username'] = $username;
				$_SESSION['userId'] = $admin['id'];
				$connexion = true;
			} 
			else {
				$connexion = false;
			}
		}
		return $connexion;
    }
    
    // Affichage de de l'espace d'administration
	public function displayAdmin($order="desc") 
	{
		$commentaires = $this->administration->getSignCom();
		$commentnbr = $this->administration->countSignCom();
		$comToValid = $this->administration->getComToValid();		
		$countComToValid = $this->administration->countComToValid();
		// Billets Croissant / Decroissant
		$sortPost = "desc";
		$_SESSION['sort'] = $order;
		if($order == 'desc') {
			$billets = $this->billet->getBillets('desc');
		} 
			else {
			$billets = $this->billet->getBillets('asc');
		}
		// Generation vue.
		$vue = new View("Admin");
		$vue->generer(array('admin' => $_SESSION['userId'], 'billets' => $billets, 'commentaires' => $commentaires, 'signComNbr' => $commentnbr, 'comToValid' => $comToValid, 'validComNbr' => $countComToValid));
	}

	// Fermeture de la session "administrateur"
	public function deconnexion() 
	{
		session_unset();
		session_destroy();
		header('Location: index.php');
    }

	//-- Modération --//
	// Valider un commentaire posté par un visiteur
	public function validComment($idCom)
	{
		$this->administration->validCom($idCom);
		header('Location: index.php?action=admin&sort=desc');
	}

	// Afficher commentaire signalés (panel Admin)
	public function displaySignCom()
	{
		$commentaires = $this->administration->getSignCom();
	}

	// Moderer commentaire (Approuver un commentaire signalé)
	public function moderateCom($contenus, $idCommentaire)
	{
		$this->administration->insertLogs($idCommentaire);
		$this->administration->insertLogsMod($idCommentaire);
		$this->administration->modSignCom($contenus, $idCommentaire);
		header('Location: index.php?action=admin&sort=desc');
	}
	
	// Suppression commentaire
	public function suppressCom($idCommentaire)
	{
		$this->administration->insertLogs($idCommentaire);
		$this->administration->insertLogsSupp($idCommentaire);
		$this->administration->suppressCom($idCommentaire);
		header('Location: index.php?action=admin&sort=desc');
	}

	// Afficher logs modération
	public function logsView()
	{
		$logsMod = $this->administration->getLogsBetterMod();
		$logsDel = $this->administration->getLogsBetterDel();
		$vue = new View("Logs");
		$vue->generer(array("logsMod" => $logsMod, "logsDel" => $logsDel));
	}
	
	
	//--- CRUD ---//
	// Afficher formulaire Creation billet
	public function createView()
	{
		$vue = new View("Create");
		$vue->generer();
	}

	// Creation Billet
	public function create($title, $content)
	{
		$this->administration->create($title, $content);
		header('Location: index.php?action=admin&sort=desc');
	}
	
	// Suppression Billet
	public function suppress($idBillet)
	{
		$this->administration->suppress($idBillet);
		header('Location: index.php?action=admin&sort=desc');
	}

	// Afficher le formulaire Modif Billet
	public function updateView($idBillet) 
	{
		$billet = $this->billet->getBillet($idBillet);
		$vue = new View("Modifier");
		$vue->generer(array("billet" => $billet));
	}

	// Modification Billet
	public function update($idBillet, $titreBillet, $contenuBillet)
	{
		$this->administration->update($idBillet, $titreBillet, $contenuBillet);
		header('Location: index.php?action=admin&sort=desc');
	}
}