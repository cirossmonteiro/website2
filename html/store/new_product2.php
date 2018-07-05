<?php
	// change temporary folder

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	if (isset($_COOKIE['usid'])) {
		if (!$_COOKIE['admin'])
			header("location: index.php");
	}
	else
		header("location: index.php");

	require "/var/www/access.php";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
		die("Connection failed: " . $conn->connect_error);
	else
		echo "Connected to db<br>";

	$cmd = "insert into products (name, stock, description, price) values ('%s',%d,'%s',%f);";
	$cmd = sprintf($cmd, $_POST['name'], $_POST['stock'],$_POST['description'],$_POST['price']);

	if (mysqli_query($conn, $cmd))
		setcookie("message","Product added to database.<br>", time() + (86400 * 30), "/");
	else
		setcookie("message","Can't add to database.<br>;", time() + (86400 * 30), "/");

	$tmp_name = $_FILES["picture"]["tmp_name"];
	if (is_uploaded_file($tmp_name)){//$_POST['picture'] != null) {
		$last_id = mysqli_insert_id($conn);
		$namefile = "product_pics/prod".$last_id;
		move_uploaded_file($tmp_name, $namefile);
		$cmd = "update products set pic_add = '%s' where id = '%d';";
		$cmd = sprintf($cmd, $namefile, $last_id);
		mysqli_query($conn, $cmd);
	}
	else
		setcookie("message","nao ta reconhecendo imagem", time() + (86400 * 30), "/");


	mysqli_close($conn);
	//echo $_FILES["picture"]["tmp_name"]."<br>".$namefile;
	header("location: new_product.php");
?>