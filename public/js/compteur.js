class Compteur 
{
    constructor() 
    {
      this.secondes = 6;
    }

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

const compteur = new Compteur();
compteur.compteurStart();