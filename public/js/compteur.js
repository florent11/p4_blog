class Compteur 
{
    constructor() 
    {
      this.secondes = 6;  // Attribut qui défini le chiffre de départ du compteur décroissant
    }

    // Méthode qui gère le fonctionnement du compteur
    compteurStart() 
    {
       var secondes = this.secondes;
       setInterval(function(){
            secondes--;
            console.log(secondes);
            document.getElementById("compteur").innerHTML = "Redirection vers la page du billet dans 0" + secondes + " secondes";

            if (secondes == 1) {
                clearInterval(); 
            }
        },1000);      
    }
}

const compteur = new Compteur();  // Création d'une instance de la classe "Compteur"
compteur.compteurStart();  // Appel de la méthode "compteurStart"