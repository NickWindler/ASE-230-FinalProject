<?php
	session_start();
	unset($_SESSION['email']);
	unset($_SESSION['password']);
	unset($_SESSION['role']);
	$_SESSION['logged'] = false;
	session_destroy();
	header("Location:../index.php");
?>