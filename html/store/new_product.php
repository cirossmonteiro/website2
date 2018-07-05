<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="catarina.css">
  <title>Freed Soul - Online Store</title>
</head>
 <body>
 	<div id = "log">log here</div>
 	<script src = "new_product.js"></script>
 	<div style="display: inline-flex;">
		<img src = "logo-154x128.png" height = 100 width = 100>
		<?php
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			if (isset($_COOKIE['usid'])) {
				if ($_COOKIE['admin'])
					echo "Register new product.<br>";
				else
					echo "You are not allowed here.";
			}
			else
				echo "You need to login first.<br><a href = 'index.php'>Home</a>";
		?>
	</div><br>
 	<?php
 		if (isset($_COOKIE['usid'])) {
			if (!$_COOKIE['admin'])
				exit();
 		}
		else
			exit();

		if (isset($_COOKIE['message']))
			if ($_COOKIE['message'] != "none") {
				echo $_COOKIE['message'];
				setcookie("message", "none", time() + (86400 * 30), "/");
			}

	 	ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		echo file_get_contents("new_product.html");

 		require "/var/www/access.php";

 		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
			die("Connection failed: " . $conn->connect_error);
		}
		else
			echo "Connected to db<br>";


		$cmd = "select * from products order by id desc;";
		$res = mysqli_query($conn,$cmd);

		$print = "<br><br><div>";
		//$product = "<div style = \"width:200px;float:left;\">Name: %s<br>Price: %.2f<br>Description: %s<br>Stock: %d<br><img src = '%s'  onerror=\"this.src='default_product.png'\" width = 100 height = 100></div>\n";
		$product = file_get_contents("product_new.html");


		while ($row = $res->fetch_assoc())
			$print .= sprintf($product,$row['id'],$row['name'],$row['id'],$row['price'],$row['id'],$row['description'],$row['id'],$row['stock'],"product_pics/prod".$row['id'],$row['id'],$row['id']);

		$print .= "</div>";
		echo $print;
		mysqli_close($conn);
 	?>
 </body>
</html>
