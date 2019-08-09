function init(){
	alert();
	displayModeration();
}


function alert() {
	var buttonElts = document.getElementsByClassName("fa-trash");
	for( var i =0; i < buttonElts.length; i++) {
		buttonElts[i].addEventListener("click", function(e) {
			if(confirm("Voulez vous supprimer cet element ?")){
				console.log("Billet Supprimé");
			} else {
				e.preventDefault();
			}
		});
	}
}

function displayModeration() {
	var editDiv = document.getElementsByClassName("editcom");
	var buttonElts = document.getElementsByClassName("buttonDisplay");
	
	for(var i = 0; i < buttonElts.length; i++){
		console.log(editDiv[i]);
		buttonElts[i].addEventListener("click",function() {
			console.log(i);
		});
	}
}




	

init();
			