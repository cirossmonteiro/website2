<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require "/var/www/access.php";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	} 

	$cmd = "insert into conn () values ();";
	$res = mysqli_query($conn, $cmd);

	$cmd = "select name, price from products where id = ".$_GET['id'].";";
	$res = mysqli_query($conn, $cmd);
	if ($res) {
		if ($row = mysqli_fetch_array($res))
			echo json_encode($row);
	}
	else
		echo $cmd;
?>