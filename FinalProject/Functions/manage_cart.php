<?php
session_start();
if($_GET['function'] == 'add')
    $_SESSION['cart'][] = [$_GET['name'], $_GET['price'], $_GET['mealID']];
if($_GET['function'] == 'remove')
    array_splice($_SESSION['cart'], $_GET['index'], 1);
header('Location:../Views/Orders/order_meal_select.php?typeID='.$_GET['typeID'].'&rID='.$_GET['rID'].'&rName='.$_GET['rName']);
?>