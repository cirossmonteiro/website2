<html><body><?php
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

	echo "ultrafast\n";
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$url = $_POST['ultraurl'];
	$output = shell_exec("python3 scrapweb.py ".$url);
	$prods = json_decode($output,true);
	/*foreach ($prods as $pr) {
		echo $pr."<br><br>";
	}
	exit();*/


	require "/var/www/access.php";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	} 
	else
		echo "Connected to db<br>";

	set_time_limit(0);
	foreach($prods as $prod) {
		$cmd = "insert into products (name) values ('fast');";
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
		echo "exec: ".curl_exec($ch)."<br>";
		if(curl_error($ch)) {
    		echo 'error:' . curl_error($ch)."<br>";
    		echo $prod."<br>";
    	}
		curl_close($ch);
	}
	mysqli_close($conn);
	header("location: new_product.php");

?></body></html>