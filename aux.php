<?php
	require "/var/www/access.php";

	function reg_query($query) {
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn)
			return 0;
		//$cmd = "insert "

	}
?>