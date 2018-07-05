<?php
	
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	echo "Under development3<br><br>";*/

	$root = substr($_SERVER["DOCUMENT_ROOT"],0,-4);
	require $root."access.php";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		echo "error: ".mysqli_connect_error();
		exit();
	} 


	$cmd = "select id from users where email = '%s';";
	$cmd = sprintf($cmd,$_POST['email']);

	if ($res1 = mysqli_query($conn,$cmd)) {
		if (mysqli_num_rows($res1) == 1) {
			$cmd = "select id, utype from users where email = '%s' and hashpw = '%s';";
			$cmd = sprintf($cmd,$_POST['email'], $_POST['passw']);
			if ($res2 = mysqli_query($conn,$cmd)) {
				if (mysqli_num_rows($res2) == 1){
					$row = mysqli_fetch_assoc($res2);
					$row2 = json_encode($row);
					echo "2".$row2; // email AND password are correct
				}
				else
					echo "1"; // only email is correct
			}
			else
				echo "error: ".mysqli_error($conn);
		}
		else
			echo "0"; // email not registered
	}
	else
		echo "error: ".mysqli_error($conn);

?>