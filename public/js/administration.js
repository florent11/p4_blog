var Administration = {
	buttonTrash: document.getElementsByClassName("fa-trash"),  // Attribut de sélection du boutton "Trash"
	buttonRecent: document.getElementById("recent"),  // Attribut de sélection du boutton "Plus Récent"
	buttonAncien: document.getElementById("ancien"),  // Attribut de sélection du boutton "Plus Ancien"
	url: window.location.search.substr(1).split("&"),  // Attribut récupérant les infos de l'URL
	
	// Méthode qui gère la confirmation de suppression d'un billet
	deleteAlert: function() {
		for(var i=0; i < this.buttonTrash.length; i++) {
			this.buttonTrash[i].addEventListener("click", function(e) {
			if(confirm("Voulez vous supprimer cet élément ?")){
				console.log("Billet Supprimé");
			} 
			else {
				e.preventDefault();
				}
			});
		}    
	},

	// Méthode qui gère la couleur des boutons de tri des billets
	sortBillet: function() {
		if(this.url=="action=admin,sort=desc") {
			this.buttonRecent.style.background = "#6f6f6f";
			this.buttonRecent.style.color = "white";
			this.buttonRecent.style.textShadow = "none";
		}
		else if(this.url=="action=admin,sort=asc") {
			this.buttonAncien.style.background = "#6f6f6f";
			this.buttonAncien.style.color = "white";
			this.buttonAncien.style.textShadow = "none";	
		}	
	},

	// Gestion des évènements 
	activerEvents: function() {
		this.deleteAlert();
		this.sortBillet();
	}
};

Administration.activerEvents(); //Appel de la Méthode "Gestion des évènements"			
