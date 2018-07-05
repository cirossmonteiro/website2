<?php

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

	$prods = explode("\n",$_POST['fast_links']);

	set_time_limit(0);
	foreach($prods as $prod) {
		$cmd = "insert into products (name) values ('no_name');";
		if(mysqli_query($conn, $cmd));
			echo "new in DB\n";
		$last_id = mysqli_insert_id($conn);
		$namefile = "/var/www/html/store/product_pics/prod".$last_id;
		//file_put_contents($namefile,fopen($prod,'r'));
		$prod = str_replace("\r", '', $prod);
		$options = array(
			CURLOPT_FILE	=>	fopen($namefile,"w"),
			CURLOPT_TIMEOUT	=>	10,
			CURLOPT_URL	=> $prod
			);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		echo "exec: ".curl_exec($ch)."\n";
		if(curl_error($ch))
    		echo 'error:' . curl_error($ch);
		curl_close($ch);
	}
	mysqli_close($conn);
	//echo $_FILES["picture"]["tmp_name"]."<br>".$namefile;
	//header("location: new_product.php");

?>