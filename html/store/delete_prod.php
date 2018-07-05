<?php
	if (isset($_COOKIE['usid'])) {
		if (!$_COOKIE['admin'])
			exit();
 	}
	else
		exit();

	require "/var/www/access.php";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	} 
	/*else
		echo "Connected to db<br>";*/

	$id = $_POST['id'];
	$cmd = "delete from products where id = %d;";
	$cmd = sprintf($cmd,$id);
	if(mysqli_query($conn,$cmd)) {
		unlink("product_pics/prod".$id);
		echo "Deleted.";
	}
	else
		echo "error: ".mysqli_error($conn);
	mysqli_close($conn);
?>