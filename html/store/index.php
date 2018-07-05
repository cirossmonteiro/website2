<!DOCTYPE html>
<html>
	<head>
  		<title>Freed Soul - Online Store</title>
  		<?php
			//echo file_get_contents("styles.html");
		?>
		<link rel="stylesheet" type="text/css" href="catarina.css">
		<link rel="stylesheet" type="text/css" href="allstyle.css">
	</head>



	<!-- body background = "product_pics/prod209"-->
	<body>
		<script src = "allscripts.js"></script>
		<?php
			//echo file_get_contents("scripts.html");
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			echo file_get_contents("navigation_carrossel.html");
			echo "<br><br>";
			echo file_get_contents("nav_pages/cart.html");
      echo "<br><br>";
      echo file_get_contents("nav_pages/login.html");
      echo "<br><br>";
      echo file_get_contents("nav_pages/register.html");
      echo "<br><br>";
		?>





		<!--div class = "login">
	 		<div style="text-align:center">
	 			<form action = 'login.php' method = 'post'>
					E-mail: <input style='bgcolor:#78600B' type = 'text' name = 'email' id = 'email' onblur = 'check_email(this);'><br>
					Password: <input type = 'password' name = 'passw'><br>
					<input type = 'submit' id = 'inlogin' value = 'Login' onmouseenter = "check_email(this);">
					<a href = 'register.php'> Create account</a>
				</form><br>
				<span id = "login_message"></span>
	 		</div>
	 	</div>-->



	 	<!--<div style="display: inline-flex;">
			<img src = "logo-154x128.png" height = 100 width = 100>
		</div><br>-->

		<!--
		<button type = "button" id = "bnew_product" onclick = "window.location.replace('new_product.php');" style = "display:none;">Edit products</button><br>
		<button type = "button" id = "blogin" onclick = "login_open();">Login</button><br>
		<button type = "button" id = "blogout" onclick = "window.location.replace('logout.php');" style = "display:none;">Logout</button><br>
		<button type = "button" onclick = "print_cart();"> My Cart</button><br>
		<button type = "button" onmousedown = "empty_cart();">Empty cart</button><br>
		<button type = "button" onmousedown = "window.location.replace('check_out.php');">Check out</button><br>-->

		<section class="mbr-section mbr-section__container article" id="header3-3" data-rv-view="2" style="background-color: rgb(255, 255, 255); padding-top: 60px; padding-bottom: 20px;">
    		<div class="container">
			 	<?php
				 	ini_set('display_errors', 1);
					ini_set('display_startup_errors', 1);
					error_reporting(E_ALL);

					$root = substr($_SERVER["DOCUMENT_ROOT"],0,-4);
					require $root."access.php";

			 		$conn = mysqli_connect($servername, $username, $password, $dbname);
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}


					$cmd = "select * from products order by id desc;";
					$res = mysqli_query($conn,$cmd);

					$print = "<br><br><div class = \"prods\">";
					$product = file_get_contents("product_index.html");


					while ($row = $res->fetch_assoc())
						$print .= sprintf($product,$row['name'],$row['price'],$row['description'],$row['stock'],$row['id'],$row['id'],$row['id']);

					$print .= "</div>";
					echo $print;
					mysqli_close($conn);
			 	?>
			</div>
		</section><br><br><br><br>

	 	<?php
	 		echo file_get_contents("onde_estamos.html");
	 	?>


	 	<script src = "index.js"></script>
	 </body>
</html>
