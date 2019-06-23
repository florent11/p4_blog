<?php

require_once "model/model.php";

Class Admin extends Model 

{

	// Recuperation infos compte
	public function getAccountInfo($username)
	{
		$sql = "SELECT * FROM members WHERE name = ?";
		$admin = $this->executerRequete($sql, array($username));
		return $admin->fetch();
	}
	
	// Liste commentaires signalés
	public function getSignCom()
	{
		$sql = 'SELECT com_id as com_id, DATE_FORMAT(com_date, \'%d/%m/%Y à %Hh%imin%ss\') as date_fr, com_auteur as author, com_contenu as content 
		FROM `comments` WHERE COM_SIGNALER = 1';
		$signCom = $this->executerRequete($sql);
		return $signCom;
	}
	
	// Liste commentaires moderés
	public function getModCom()
	{
		$sql = "SELECT * FROM `comments` WHERE COM_SIGNALER = 0 AND COM_MODERE = 1";
		$modCom = $this->executerRequete($sql);
		return $modCom->fetchAll();
	}