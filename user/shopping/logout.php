<?php
	session_start();
	unset($_SESSION['cart']);
	unset($_SESSION['customer']);
	session_start();
    session_unset();
	session_write_close();
	$url = "../../login.php";
	header("Location: $url");

?> 