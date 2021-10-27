
$(document).ready(function(){

	$('#login_signin').keyup(function(event){
			var texte=$("#login_signin").val();
			
			//texte=texte.toLowerCase();
			$('#login_signin').val(texte.replace(/ /g,"-"));   //remplace l'espace par un trait
	});

	$('#password_signin').keyup(function(event){   
        //supprime le dernier character s'il s'agit d'un espace
        /*
        if(event.key == " "){
            $('#password').val($('#password').val().slice(0, -1));
        }
        */
        //supprime tout les espaces mêmes lorsque l'utilisateur reste appuyé sur espace
        $('#password_signin').val($('#password_signin').val().replace(/ +?/g, ''));

        var password=$("#password_signin").val();
		var password_confirmation=$("#password_confirmation_signin").val();
		$('#erreur-password').toggle(password.length<6);
		$('#erreur-conf').toggle(password !== password_confirmation);
        verifyVisibility();
	});

	$('#password_confirmation_signin').keyup(function(event){
        //supprime le dernier character s'il s'agit d'un espace
        /*
        if(event.key == " "){
            $('#password_confirmation').val($('#password_confirmation').val().slice(0, -1));
        }
        */
        //supprime tout les espaces mêmes lorsque l'utilisateur reste appuyé sur espace
        $('#password_confirmation_signin').val($('#password_confirmation_signin').val().replace(/ +?/g, ''));


		var password=$("#password_signin").val();
		var password_confirmation=$("#password_confirmation_signin").val();
		$('#erreur-conf').toggle(password !== password_confirmation);
        verifyVisibility();
	});

				
							
	console.log("La mise en place est finie. En attente d'événements...");


});


function verifyVisibility(){
    if(document.getElementById("erreur-password").style.display=="none" && document.getElementById("erreur-conf").style.display=="none"){
        $('#submitForm').attr("disabled", false);
    }else{
        $('#submitForm').attr("disabled", true);
    }
}



function functionVerif(){
    var pass1 = document.getElementById("password_signin").value
    var pass2 = document.getElementById("password_confirmation_signin").value

    if(pass1 !== pass2){
        alert("La confirmation du mot de passe est différente du mot de passe saisi. Veuillez recommencer.");
        return false;
    }
}