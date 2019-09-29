<?php

require_once 'model.php';

Class Admin extends Model 
{
	// Recuperation infos compte
	public function getAccountInfo($username)
	{
		$sql = 'select * from members where name = ?';
		$admin = $this->executerRequete($sql, array($username));
		return $admin->fetch();
	}
	
	// Liste commentaires signalés
	public function getSignCom()
	{
		$sql = 'select com_id as com_id, date_format(com_date, \'%d/%m/%Y à %Hh%imin%ss\') as date_fr, com_auteur as author, com_contenu as content 
		from `comments` where com_signaler = 1';
		$signCom = $this->executerRequete($sql);
		return $signCom;
	}

	// Liste commentaires à valider
	public function getComToValid()
	{
		$sql = 'select com_id as com_id, date_format(com_date, \'%d/%m/%Y à %Hh%imin%ss\') as date_fr, com_auteur as author, com_contenu as content 
		from `comments` where com_a_valider = 0';
		$comToValid = $this->executerRequete($sql);
		return $comToValid;
	}

	// Valide le commentaire posté par le visiteur
	public function validCom($idCommentaire)
	{
		$sql = 'update comments set com_a_valider = 1 where com_id = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Liste commentaires moderés
	public function getModCom()
	{
		$sql = 'select * from `comments` where com_signaler = 0 and com_modere = 1';
		$modCom = $this->executerRequete($sql);
		return $modCom->fetchAll();
    }
    
	// Liste historique moderation 
	public function getLogs()
	{
		$sql = 'select log_id as log_id, com_id as id, date_format(com_date, \'%d/%m/%Y à %Hh%imin%ss\') 
		as date_fr, com_author as author, com_content as content, post_id as post_id, mod_type as mod_type, date_format(log_date, \'%d/%m/%Y à %Hh%imin%ss\') as log_date_fr from logs order by log_id desc';
		$logs = $this->executerRequete($sql);
		return $logs->fetchAll();
	}
	
	// Liste historique commentaires Supprimés
	public function getLogsBetterDel()
	{
		$sql = 'select log_id as log_id, com_id as id, date_format(com_date, \'%d/%m/%Y à %Hh%imin%ss\') 
		as post_date_fr, com_author as author, com_content as oldcontent, post_id as post_id, mod_type as mod_type, date_format(log_date, \'%d/%m/%Y à %Hh%imin%ss\') as mod_date_fr 
		from logs where mod_type = "deleted" order by log_id desc';
		$logs = $this->executerRequete($sql);
		return $logs->fetchAll();
	}

	// Liste historique commentaires Modéré
	public function getLogsBetterMod()
	{
		$sql ='select logs.log_id as log_id, date_format(logs.com_date, \'%d/%m/%Y à %Hh%imin%ss\') as post_date_fr, comments.com_id as com_id, comments.COM_AUTEUR as author,
		logs.com_content as oldcontent, comments.com_contenu as newcontent, date_format(logs.log_date, \'%d/%m/%Y à %Hh%imin%ss\') as mod_date_fr, comments.bil_id as post_id 
		from logs inner join comments on logs.com_id = comments.com_id where logs.mod_type = "moderated" order by log_id desc';
		$logsMod = $this->executerRequete($sql);
		return $logsMod->fetchAll();
	}
	
	// Nombre commentaire à moderer
	public function countSignCom()
	{
		$sql = 'select count(*) as nbsigncoms from comments where com_signaler = 1';
		$commentSignNumber = $this->executerRequete($sql);
		return $commentSignNumber->fetch();
	}

	// Nombre commentaire à valider
	public function countComToValid()
	{
		$sql = 'select count(*) as nbcomstovalid from comments where com_a_valider = 0';
		$commentToValidNumber = $this->executerRequete($sql);
		return $commentToValidNumber->fetch();
	}
	
	// Modérer commentaire signalés
	public function modSignCom($contenus, $idCommentaire)
	{
		$sql = 'update comments set com_signaler = 0, com_modere = 1, com_contenu = ? where com_id = ?';
		$this->executerRequete($sql, array($contenus, $idCommentaire));
	}

	// Supprimer commentaire signalé 
	public function suppressCom($idCommentaire)
	{
		$sql = 'delete from comments where com_id = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Insertion logs moderation
	public function insertLogs($idCommentaire)
	{
		$sql = 'insert into logs(com_id, com_date, com_author, com_content, post_id) 
				select com_id, com_date, com_auteur, com_contenu, bil_id from comments where com_id = ?';
		$this->executerRequete($sql, array($idCommentaire));
	} 
	
	// Insertion type "Supprimé" log Modération 
	public function insertLogsSupp($idCommentaire)
	{
		$sql = 'update logs set mod_type = "deleted" where com_id = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}

	// Insertion type "Modéré" log Modération 
	public function insertLogsMod($idCommentaire)
	{
		$sql = 'update logs set mod_type = "moderated" where com_id = ?';
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Creation Billet
	public function create($titre, $content)
	{
		$sql = 'insert into posts(bil_date, bil_titre, bil_contenu, auteur_id) values(now(), ?, ?, ?)';
		$this->executerRequete($sql, array($titre, $content, $_SESSION['userId']));
	}
	
	// Suppression Billet
	public function suppress($idBillet)
	{
		$sql = 'delete from posts where bil_id = ?';
		$this->executerRequete($sql, array($idBillet));
	}
	
	// Modification Billet
	public function update($idBillet, $titreBillet, $contenuBillet)
	{
		$sql = 'update posts set bil_titre = ?, bil_contenu = ? where bil_id = ?';
		$this->executerRequete($sql, array($titreBillet, $contenuBillet, $idBillet));
	}
}

