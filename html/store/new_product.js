function update_info(but) {
	var id = parseInt(but.id.slice(2));
	var name = document.getElementById("n"+String(id)).value;
	var price = parseFloat(document.getElementById("p"+String(id)).value);
	var description = document.getElementById("d"+String(id)).value;
	var stock = parseInt(document.getElementById("s"+String(id)).value);

	var new_info = {'id':id, 'name':name,
	'price':price, 'description':description, 'stock':stock};
	var tosend = JSON.stringify(new_info);

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var mess = this.responseText;
			alert(mess);
			setTimeout(location.reload(),1);
		}
	}

	xhttp.open("post","update_info.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("data="+tosend);
}

function delete_prod(but) {
	var id = parseInt(but.id.slice(2));
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var mess = this.responseText;
			//alert(mess);
			setTimeout(location.reload(),1);
		}
	}

	xhttp.open("post","delete_prod.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+String(id));
}