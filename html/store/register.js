function fcep(input){
	var str = input.value;
	if (input.value.length == 10) {
		input.value = input.value.slice(0,input.value.length-1);
		return;
	}
	for (var i = 0, j = str.length; i < j; i++) {
		var c = str.charAt(i);
		var ind = str.charCodeAt(i);
		if ((ind < 48 || ind > 57 ) && (ind != 45 || i != 5) ) {
			str = str.replace(c,'');
			i--;
			j--;
		}
	}
	if (input.value != str)
		input.value = str;
	if (input.value.length == 6 && input.value.charAt(5) != "-")
		input.value = input.value.slice(0,5)+"-"+input.value.charAt(5);
	if (input.value.length == 9) {
		var cep = parseInt(input.value.slice(0,5)+input.value.slice(6,9));
		f2cep(cep);
	}
}

function f2cep(num) {
	try{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            document.getElementById("logradouro").value = data['logradouro'];
            document.getElementById("bairro").value = data['bairro'];
            document.getElementById("cidade").value = data['cidade'];
            document.getElementById("estado").value = data['estado'];
            document.getElementById("numero").focus();
        }
    };
    xhttp.open("GET", "https://api.postmon.com.br/v1/cep/"+String(num), false);
    xhttp.send();
   	}
   	catch(err){
   		alert(err.message);
   	}
}

function validation() {
	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value;
	var address = document.getElementById('address').value;
	var p1 = document.getElementById('pass1').value;
	var p2 = document.getElementById('pass2').value;
	var i;

	var points = 0;

	var log = "";

	// validating name: at least one space
	if (name.length >= 5 && name.search(' '))
		points++;
	else
		log += "name, ";

	//validating e-mail
	if (email.length >= 5 && email.search('@') && email.search(/\./))
		points++;
	else
		log += "email, ";

	// validating address
	if (logradouro.length >= 5 && address.search(' ')+1)
		points++;
	else
		log += "logradouro, ";

	// validating password: only 0-9, a-z, A-Z, at least 8 characters
	if (p1 == p2 && p1.length >= 8){

		for (i = 0; i < p1.length; i++)
			if (!((48 <= p1.charCodeAt(i) && p1.charCodeAt(i) <= 57) ||
				(65 <= p1.charCodeAt(i) && p1.charCodeAt(i) <= 90) ||
				(97 <= p1.charCodeAt(i) && p1.charCodeAt(i) <= 122)))
				break;

		if (i == p1.length)
			points++;

	}
	else
		log += "password, ";

	if (points == 4) {
		document.getElementById('send').disabled = false;
		document.getElementById('pass2p').innerHTML = "";
	}
	else {
		document.getElementById('send').disabled = true;
		document.getElementById('pass2p').innerHTML = "Bad data provided: ".concat(log);
	}

}

function fsubmit() {
	// implementar hash aqui
	document.getElementById('pass1').value += "opa";
	return true;
}