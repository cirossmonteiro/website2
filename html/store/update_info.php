<?php
	if (isset($_COOKIE['usid'])) {
		if (!$_COOKIE['admin'])
			exit();
 	}
	else
		exit();

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require "/var/www/access.php";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	} 
	else
		echo "Connected to db<br>";

	$data = json_decode($_POST['data'],true);

	$cmd = "update products set name = '%s', description = '%s', price = %f, stock = %d where id = %d";
	$cmd = sprintf($cmd, $data['name'], $data['description'], $data['price'], $data['stock'], $data['id']);
	if(mysqli_query($conn,$cmd))
		echo "Updated.";
	else
		echo "error: ".mysqli_error($conn);
	mysqli_close($conn);

?>