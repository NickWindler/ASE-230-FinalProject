<?php
require('../../Functions/auth_functions.php');
require('../../Functions/profile_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:../index.php");

$price = 0;
$orderDetails = $orderFunctions->getOrderDetails($_GET['id'], $db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Order Details</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Style/sign-in.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <h1 class="h3 mb-3 fw-normal">Order Details: <?=$orderDetails[0]['restaurant_name']?></h1>
    <ul style="display: inline;">
        <li style="display: inline;"><strong>Meals: </strong></li>
        <?php for($i = 0; $i < count($orderDetails); $i++):?>
            <?php $price = $price + $orderDetails[$i]['price']?>
            <li style="display: inline;"><?=$orderDetails[$i]['name']?>, </li>
        <?php endfor;?>
    </ul>
    <br><br>
    <p><strong>Date: </strong><?=substr($orderDetails[0]['date'], 0, 10)?></p>
    <p><strong>Total: </strong>$<?=$price?></p>
    <p><strong>Status: </strong>
        <?php if($orderDetails[0]['status'] == 0):?>
            In Transit
        <?php endif;?>
        <?php if($orderDetails[0]['status'] == 1):?>
            Delivered
        <?php endif;?></p>
    <a href="../profile.php?id=<?=$res['ID']?>"><strong>Back to Profile</strong></a>
</main>
</body>
</html>