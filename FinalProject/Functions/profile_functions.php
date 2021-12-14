<?php
require('address_functions.php');
require('payment_functions.php');
require('order_functions.php');
require('user_functions.php');
require('C:\xampp\htdocs\FinalProject\DB\db_connect.php');
session_start();

if(count($_SESSION) > 1) {
	$stmt = $db->query('SELECT ID FROM users WHERE email = "' . $_SESSION['email'] . '"');
	$res = $stmt->fetch();
}

$addressFunctions = new addressFunctions();
$paymentFunctions = new paymentFunctions();
$orderFunctions = new orderFunctions();


$userFunctions = new userFunctions();
$userArray = $userFunctions->getUsers($db);
?>