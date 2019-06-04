<?php 

Class View 
{
	// Nom du fichier associé à la vue
	private $fichier;
	// Titre de la vue (defini dans le fichier vue)
	private $titre;
	
	public function __construct($action) 
	{
		// Détermination du nom du fichier vue à partir de l'action
		$this->fichier = "view/view" . $action . ".php";
	}

	// Génère et affiche la vue
	public function generer($donnees=[]) 
	{
		// Génération de la partie spécifique de la vue
		$contenu = $this->genererFichier($this->fichier, $donnees);
		// Génération du gabarit commun utilisant la partie spécifique
		//$vue = $this->genererFichier('view/template.php',
		//array('titre' => $this->titre, 'content' => $contenu));
		// Renvoi de la vue au navigateur
		echo $contenu;
	}

	// Génère un fichier vue et renvoie le résultat produit
	private function genererFichier($fichier, $donnees) 
	{
    if (file_exists($fichier)) 
	{
		// Rend les éléments du tableau $donnees accessibles dans la vue
		extract($donnees);
		// Démarrage de la temporisation de sortie
		ob_start();
		// Inclut le fichier vue
		// Son résultat est placé dans le tampon de sortie
		require $fichier;
		// Arrêt de la temporisation et renvoi du tampon de sortie
		return ob_get_clean();
    }
    else {
		throw new Exception("Fichier '$fichier' introuvable");
    }
  }
  
}