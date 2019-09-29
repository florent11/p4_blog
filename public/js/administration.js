class Administration 
{
	constructor() 
	{
	this.buttonTrash = document.getElementsByClassName("fa-trash");  // Attribut de sélection du bouton "Trash"
	this.buttonRecent = document.getElementById("recent");  // Attribut de sélection du bouton "Plus Récent"
	this.buttonAncien = document.getElementById("ancien");  // Attribut de sélection du bouton "Plus Ancien"
	this.urlParams = new URLSearchParams(location.search);  // Attribut récupérant les infos de l'URL
	this.logoHome = document.getElementById("logo");  // Attribut de sélection du logo du blog
	}

	// Méthode qui gère la confirmation de suppression d'un billet
	deleteAlert()
	{
		for(var i=0; i < this.buttonTrash.length; i++) {
			this.buttonTrash[i].addEventListener("click", function(e) {
			if(!confirm("Voulez vous supprimer cet élément ?")){
				e.preventDefault();
				}
			});
		}    
	}

	// Méthode qui gère la couleur des boutons de tri des billets
	sortBillet()
	{
		if(this.urlParams.has("sort")) {
			if(this.urlParams.get("sort") == "desc") {
				this.buttonRecent.style.background = "#6f6f6f";
				this.buttonRecent.style.color = "white";
				this.buttonRecent.style.textShadow = "none";
			}
			else if(this.urlParams.get("sort") == "asc") {
				this.buttonAncien.style.background = "#6f6f6f";
				this.buttonAncien.style.color = "white";
				this.buttonAncien.style.textShadow = "none";	
			}
		}	
	}

	// Méthode qui désactive le lien vers la page d'accueil lors du clic sur le logo
	deleteHomeLink()
	{
		if(this.urlParams.has("action")) {
			if(this.urlParams.get("action") == "create" || this.urlParams.get("action") == "vueModifier" || this.urlParams.get("action") == "billet") {
				this.logoHome.addEventListener("click", (function(e){
					e.preventDefault();
				}));	
			}	
		}	
	}

	// Gestion des évènements 
	activerEvents()
	{
		this.deleteAlert();  // Appel de la méthode "deleteAlert"
		this.sortBillet();  // Appel de la méthode "sortBillet"
		this.deleteHomeLink();  // Appel de la méthode "deleteHomeLink"
	}
}

const administration = new Administration();
administration.activerEvents();  // Appel de la méthode "Gestion des évènements"			