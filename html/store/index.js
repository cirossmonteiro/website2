function login(){
	var input1 = document.getElementById("email_login");
	var input2 = document.getElementById("password_login");
	var mess = document.getElementById("status_login");
	var but = document.getElementById("submit_login");
	var email = input1.value;
	var password = input2.value;

	if (email.indexOf('@') == -1 || email.indexOf('.') == -1) {
		mess.innerHTML = "This e-mail address is not valid.";
		but.disabled = true;
		return;
	}

	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var ret = this.responseText;
			if (ret == "0") {
				mess.innerHTML = "Account doesn't exist in our system.";
				but.disabled = true;
			}
			else if (ret == "1") {
				mess.innerHTML = "Wrong password";
				but.disabled = true;
			}
			else if (ret == "2") {
				mess.innerHTML = "Welcome back!";
				but.disabled = false;

				window.location.replace("index.php");
			}
			else {
				mess.innerHTML = ret;
				but.disabled = true;
			}
		}
	};

	xhttp.open("post","check_email.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("email="+email+"&passw="+password);
}

function check_key_login(event) {
	if (event.code == "Enter")
		login();
}



/*********************************************************
gets the value of a cookie
**********************************************************/
document.getCookie = function(sName)
{
    sName = sName.toLowerCase();
    var oCrumbles = document.cookie.split(';');
    for(var i=0; i<oCrumbles.length;i++)
    {
        var oPair= oCrumbles[i].split('=');
        var sKey = decodeURIComponent(oPair[0].trim().toLowerCase());
        var sValue = oPair.length>1?oPair[1]:'';
        if(sKey == sName)
            return decodeURIComponent(sValue);
    }
    return '';
}

// check if cookie exist
function existCookie (name){
	if (document.cookie.indexOf(name+'=') == -1)
		return false;
	else
		return true;
}
/*********************************************************
sets the value of a cookie
**********************************************************/
document.setCookie = function(sName,sValue)
{
    var oDate = new Date();
    oDate.setYear(oDate.getFullYear()+1);
    var sCookie = encodeURIComponent(sName) + '=' + encodeURIComponent(sValue) + ';expires=' + oDate.toGMTString() + ';path=/';
    document.cookie= sCookie;
}
/*********************************************************
removes the value of a cookie
**********************************************************/
document.clearCookie = function(sName)
{
     document.cookie = sName + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;"
}

function empty_cart() {
	document.setCookie('cart',JSON.stringify({}));
	var inputs = document.getElementsByClassName("input_prod");
	for (var i = 0; i < inputs.length; i++)
		inputs[i].value = 0;
}

function login(){
	var input1 = document.getElementById("email_login");
	var input2 = document.getElementById("password_login");
	var mess = document.getElementById("status_login");
	var but = document.getElementById("submit_login");
	var email = input1.value;
	var password = input2.value;

	if (email.indexOf('@') == -1 || email.indexOf('.') == -1) {
		mess.innerHTML = "This e-mail address is not valid.";
		but.disabled = true;
		return;
	}

	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var ret = this.responseText.charAt(0);
			if (ret == "0")
				mess.innerHTML = "Account doesn't exist in our system.";
			else if (ret == "1")
				mess.innerHTML = "Wrong password";
			else if (ret == "2") {
				mess.innerHTML = "Welcome back!";
				but.disabled = false;
				var obj = JSON.parse(this.responseText.slice(1));
				document.setCookie("usid", obj['id']);
				document.setCookie("utype", obj['utype']);
				window.location.replace("index.php");
			}
			else
				mess.innerHTML = ret;
		}
	};

	xhttp.open("post","check_email.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("email="+email+"&passw="+password);
}




// for numbers
function validation(input) {
	str = input.value;
	for (var i = 0, j = str.length; i < j; i++) {
		var c = str.charAt(i);
		var ind = str.charCodeAt(i);
		if (ind < 48 || ind > 57) {
			str = str.replace(c,'');
			i--;
			j--;
		}
	}
	if (input.value != str)
		input.value = str;
}

function name_price_qtd(id, qtd) {
		//alert("npq");
		try{

		var xhttp = new XMLHttpRequest();
		//alert("var");

		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				try{
					//alert("id here: "+String(id));
				//alert("onreadystatechange");
				//alert(this.responseText);
				var data = JSON.parse(this.responseText);
				//alert(data);
				var tab = document.getElementById("mycartlist");
				var row = tab.insertRow(-1);
				row.insertCell(0).innerHTML = "<img width = 100 height = 100 src = 'product_pics/prod"+String(id)+"'><span class='tab'>"+data['name'];
				row.insertCell(1).innerHTML = String(data['price']);
				row.insertCell(2).innerHTML = String(qtd);

				var div = document.getElementById("total");
				var subt = parseFloat(div.innerHTML);
				subt += qtd*data['price'];
				div.innerHTML = subt;
				}
				catch(err){
					alert(err.message);
				}

			}
		};
		xhttp.open("GET","product_info.php?id="+String(id),true);
		//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send();
		//alert("end try: "+s);
	}
		catch(err){
			alert(err.message);
		}
}


function print_cart() {
	// esta aqui o problema
	//var strcart = "<table id = 'tablecart' >";
	//strcart += "<tr><th>Product</th><th>Price</th><th>Quantity</th></tr>";
	try {
		var cart = JSON.parse(document.getCookie('cart')); // get cart from cookie in JSON notation
		//alert(document.getCookie('cart'));
		//if (Object.keys(cart).length == 0)
		//	strcart += "empty";
		for (var key in cart)
			if (cart[key] > 0){
				var id = parseInt(key.slice(4));
				//alert(id);
				//alert(name_price(id));
				//var data = JSON.parse(name_price_qtd(id));// error message: data is undefined
				//alert(data);
				//var row = "<tr>";
				//row += "<th><img src = 'product_pics/"+key+"'>"+data['name']+"</th>";
				//row += "<th>"+String(data['price'])+"</th>";
				//row += "<th>"+cart[key]+"</th>";
				//strcart += key + " _ "+ cart[key] + "<br>";
				name_price_qtd(id, cart[key]);
			}
		var tab = document.getElementById("mycartlist");
		var row = tab.insertRow(-1);
		var div = document.getElementById("total");
		//var subt = parseFloat(div.innerHTML);
		//row.insertCell(1).innerHTML = div.innerHTML;

	}
	catch(err) {
		alert(err.message);
		//strcart += "<tr><th>empty</th></tr>";
	}
	//strcart += "</table>"
	//div.innerHTML = strcart;
}

function update(but){
	var id = parseInt(but.id.slice(1)); // get id from <button>
	if (document.getElementById('q'+String(id)).value == null
		|| document.getElementById('q'+String(id)).value == "")
		return;

	var qtd = parseInt(document.getElementById('q'+String(id)).value); // get value from <input>

	if (qtd == null)
		return;


	try{
		var cart;
		if (existCookie('cart'))
			cart = JSON.parse(document.getCookie('cart'),true); // get cart from cookie in JSON notation
		else
			cart = {};
	}
	catch(err){
		alert(err.message);
	}

	if (qtd == 0) {
		if ("prod"+String(id) in cart)
			delete cart["prod"+String(id)];
		else
			return;
	}
	else {
		cart["prod"+String(id)] = qtd;
		alert("updated");
	}

	document.setCookie('cart',JSON.stringify(cart));
}

function mousein(div) {
	//div.getElementsByClassName("prodin")[0].style.display = "none";
	//alert("inside box");
	//div.style.boxShadow = "0 10px 13px 0 rgba(0, 0, 0, 0.2), 0 10px 30px 0 rgba(0, 0, 0, 0.19)";
	/*var img = div.getElementsByTagName("img")[0];
	img.height = 200;
	img.width = 200;*/
}

function mouseout(div) {
	//div.getElementsByClassName("prodin")[0].style.display = "block";
	//div.style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)";
	/*var img = div.getElementsByTagName("img")[0];
	img.height = 100;
	img.width = 100;*/
}

function popup_login_open() {
	var div = document.getElementById("div-login");
	var div2 = document.getElementById("div-register");
	div2.style.display = "none";
	div.style.display = "block";
	window.scrollTo(0, 100);
}

function popup_register_open() {
	alert("div-register1");
	var div = document.getElementById("div-register1");
	//var div2 = document.getElementById("div-login");
	//div2.style.display = "none";
	div.style.display = "block";
	window.scrollTo(0, 100);
}

function loaded(){
	//alert(document.cookie);
	if (existCookie("cart")){
		var	cart = JSON.parse(document.getCookie('cart'),true); // get cart from cookie in JSON notation
		var id;
		//alert(document.cookie);
		if (Object.keys(cart).length != 0)
			for (var key in cart) {
				id = parseInt(key.slice(4));
				document.getElementById("q"+String(id)).value = cart[key];
			}
	}
	//window.onclick = login_close;

	var modal = document.getElementById('div-login');
	var modal2 = document.getElementById('div-register');

// When the user clicks anywhere outside of the modal, close it
// vai ter colisão!!!
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	    else if (event.target != modal2) {
	        modal2.style.display = "none";
	    }
	}
	if (existCookie("usid")){
		//alert("logged");
		//alert("loaded");
		//document.getElementById("blogin").style.display = "none";
		//document.getElementById("blogout").style.display = "block";
		// new
		document.getElementById("alogin").style.display = "none";
		document.getElementById("aregister").style.display = "none";
		document.getElementById("alogout").style.display = "block";
		if (existCookie("utype")) {
			//document.getElementById("bnew_product").style.display = "block";
			if (document.getCookie("utype") == '1')
				document.getElementById("anew_product").style.display = "block";
		}

	}
	//else
		//alert("not logged");
	//alert(document.cookie);

}

/*function img_zoom(img) {
	//alert(String(img.style.transform));
	if (img.style.transform == "scale(1.0)")
		img.style.transform = "scale(3.0)";
	else
		img.style.transform = "scale(1.0)";
}*/

function click_cart(){
	//alert("click");
	var div = document.getElementById("mycart");
	div.style.display = "block";
	window.scrollTo(0, 100);
	print_cart();

}

function click_cart2(){
	var div = document.getElementById("mycart");
	div.style.display = "none";
	var tab = document.getElementById("mycartlist");
	tab.innerHTML = "<tr><th>Product</th><th>Price</th><th>Quantity</th></tr>";
	var div2 = document.getElementById("total");
	div2.innerHTML = "0.0";
}

function logout(){
	window.location.replace("logout.php");
}

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

loaded();
