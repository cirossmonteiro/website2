<html>
	<head>
		<link rel="stylesheet" type="text/css" href="catarina.css">
  		<title>Freed Soul - Online Store</title>
	</head>
	<body>
		<?php
			if (!isset($_COOKIE['usid'])) {
				echo "You need to login before you check out.<br>";
				echo "<a href = \"index.php\">Login</a><br>";
				echo "<a href = \"register.php\">Create account</a><br>";
			}
		?>
	</body>
</html>