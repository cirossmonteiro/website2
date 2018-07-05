<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="catarina.css">
  		<title>Freed Soul - Online Store</title>
	</head>
	 <body>

	 	<?php
	 		if (isset($_COOKIE['usid']))
	 			header("location: index.php");
	 	?>

	 	<div style="display: inline-flex;">
			<img src = "logo-154x128.png" height = 100 width = 100>
			<form>
				E-mail: <input type = "text" name = "email">
				Password: <input type = "password" name = "passw">
				<input type = "submit" value = "Login">
			</form>
		</div><br>
		<h2>Register</h2>
		<div class = "register">
			<form action = "register2.php" method = "post">

				Name: <input type = "text" name = "name" id = "name"><br>

				E-mail: <input type = "text" name = "email" id = "email"><br>

				CEP(xxxxx-xxx): <input type = "text" oninput = "fcep(this);" name = "cep" id = "cep"><br>

				Logradouro: <input type = "text" name = "logradouro" id = "logradouro"> Número: <input type = "text" name = "numero" id = "numero" size = 1>
				Complemento: <input type = "text" name = "complemento" id = "complemento"><br>

				Bairro: <input type = "text" name = "bairro" id = "bairro">
				Cidade: <input type = "text" name = "cidade" id = "cidade">
				Estado: <input type = "text" name = "estado" id = "estado" size = 1><br>

				Password: <input type = "password" name = "pass1" id = "pass1"><br>

				Confirm: <input type = "password" name = "pass2" id = "pass2" onkeyup = "validation()" onblur = "validation()"><span id = "pass2p"></span><br>

				User: 
				<input type = "radio" name = "type_user" value = 0 checked> Regular user
				<input type = "radio" name = "type_user" value = 1>Admin<br>

				<input type = "submit" value = "Register" id = "send" disabled>
				
			</form>
		</div>

		<script src = "register.js"></script>
	 </body>
</html>