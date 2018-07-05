<?php
	unset($_COOKIE['usid']);
	setcookie('usid', null, -1, '/');
	unset($_COOKIE['admin']);
	setcookie('admin', null, -1, '/');
	header("location: index.php");
?>