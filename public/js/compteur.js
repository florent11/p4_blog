var Compteur = {
    minutes : 00, // Minutes du compte à rebours
    secondes : 05, // Secondes du compte à rebours
    secondesElt : null, // Éléments secondes (celui qui sera inséré dans le HTML)

    // Méthode de fonctionnement du compte à rebours
    compteurStart : function() {
        
        if(this.secondes < 10) { // Si il reste moins de 10 secondes
            // Ajoute un 0 devant les secondes
            this.secondesElt = "0" + this.secondes;
        } else {
            // Sinon les secondes s'affichent normalement
            this.secondesElt = this.secondes;
        }
    

        if((this.secondes >= 0)) { // S'il reste plus de 0 seconde

            // On diminue les secondes
            this.secondes--;

        } else if((this.secondes <= 0)) { // Sinon si les secondes inférieures ou égale à 0

            // On replace les secondes à 05
            this.secondes = 05;
            this.secondesElt = "0" + this.secondes;
        }
        // Insertion du compte à rebours dans le HTML
        document.getElementById("compteur").innerHTML = this.secondesElt;
    }

   /* // Gestion des évènements
   activerEvents: function() {
      // Lancement du compte à rebours
        
	}*/
}
//Compteur.activerEvents();  //Appel de la Méthode "Gestion des évènements"
setInterval(Compteur.compteurStart(), 1000);