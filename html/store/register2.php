<!DOCTYPE html>
<html>
	<head>
	 	<title>Freed Soul - Online Store</title>
	</head>
	<body>
		<?php
			// verificar se usuario existe (pelo email) para evitar duplicata
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			echo "Under development3<br><br>";

			$root = substr($_SERVER["DOCUMENT_ROOT"],0,-4);
			require $root."access.php";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
				echo "Can't connect.<br>";
				exit();
			}
			else
				echo "Connected to db.<br>";

			$cmd = "insert into users (name, email, cep, logradouro, complemento, bairro, cidade, estado, utype,hashpw) values ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');";
			
			$cmd = sprintf($cmd,$_POST['name'],$_POST['email'],$_POST['cep'],$_POST['logradouro'],$_POST['complemento'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], $_POST['utype'], $_POST['hashpw']);

			$res = mysqli_query($conn, $cmd);
			mysqli_close($conn);
			if ($res) {
		    	echo "New record created successfully";
		    	header("location: index.php");
			}
		    else
		    	echo "Error: " . $cmd . "<br>" . mysqli_error($conn);
		?>
	</body>
</html>