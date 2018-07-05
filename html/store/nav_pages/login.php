<!DOCTYPE html>
<html>
	<head>
	 	<title>Freed Soul - Online Store</title>
	</head>
	<body>
	<div style="display: inline-flex;">
		<img src = "online_store_logo.png" height = 100 width = 100>
		<form action = "login.php" method = "post">
			E-mail: <input type = "text" name = "email">
			Password: <input type = "password" name = "passw">
			<input type = "submit" value = "Login">
			<a href = "register.html"> Create account</a>
		</form>
	</div><br>
		<?php
			// implementar cookie
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			echo "Under development3<br><br>";

			$root = substr($_SERVER["DOCUMENT_ROOT"],0,-4);
			require $root."access.php";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
				echo "error: ".mysqli_connect_error();
				exit();
			}
			
			$cmd = "select id, name, admin from users where email = '%s';";
			$cmd = sprintf($cmd,$_POST['email']);
			
			if ($res = mysqli_query($conn, $cmd))
			if (mysqli_num_rows($res) == 0)
				echo "You don't have an account here.<br>";
			else {
				$row = mysqli_fetch_assoc($res);
				setcookie('usid',$row['id'], time() + (86400 * 30), "/");
				setcookie('admin',$row['admin'], time() + (86400 * 30), "/");
				//echo sprintf("hello, %s! admin: %d",$row['name'],$row['admin']);

				

				header("location: index.php");
			}

			mysqli_close($conn);
		?>
	</body>
</html>