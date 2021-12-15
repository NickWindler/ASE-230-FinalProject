<?php
require('../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/profile_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:index.php");

$stmt = $db->prepare('SELECT * FROM users WHERE ID = ?');
$stmt->execute([$_GET['id']]);
$row = $stmt->fetch();

$addressArray = $addressFunctions->getAddressesForUser($row['ID'], $db);
$paymentArray = $paymentFunctions->getPaymentOptionsForUser($row['ID'], $db);
$orderArray = $orderFunctions->getOrdersForUser($row['ID'], $db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Order Services Profile</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../Style/index.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tofoo Order Services</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Order</a>
                </li>
                <?php if($_SESSION['role'] == 1):?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin View</a>
                    </li>
                <?php endif;?>
            </ul>
            <?php if($_SESSION['logged'] == true):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link active" href="profile.php?id=<?=$res['ID']?>">Profile</a>
                </li>
            <?php endif;?>
            <?php if($_SESSION['logged'] == false):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link" href="Authentication/sign-in.php">Sign In</a>
                </li>
            <?php endif;?>
            <?php if($_SESSION['logged'] == true):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link" href="Authentication/sign-out.php">Sign Out</a>
                </li>
            <?php endif;?>
        </div>
    </div>
</nav>
<main class="container" >
    <div class="bg-light p-5 rounded" style="height: 750px;">
        <h1 style="float:left">Hello <?= $row['first_name']?>!</h1>
        <h3><a href="edit_profile.php?id=<?= $row['ID']?>" style="float: right">Edit Profile</a></h3><br><br><br>
        <div>
            <div>
                <ul style="display: inline;">
                    <li style="display: inline-block; margin-left: -30px;"><h3>Addresses</h3></li>
                    <li style="display: inline;"><a style="text-decoration: none; color: black;" href="Address/create-address.php?user_id=<?=$_GET['id']?>"> - (Add)</a></li>
                </ul>
            </div>
            <div style="height: 125px; width: 700px; overflow-y: auto;">
                <?php for($i = 0; $i < count($addressArray); $i++):?>
                    <?php if($addressArray[$i]['is_primary'] == 1):?>
                        <a style="text-decoration: none; color: black;" href="Address/modify-address.php?primary=<?=$addressArray[$i]['is_primary']?>&street=<?=$addressArray[$i]['street']?>&city=<?=$addressArray[$i]['city']?>&zip=<?=$addressArray[$i]['zip']?>&state=<?=$addressArray[$i]['state']?>&delivery=<?=$addressArray[$i]['delivery_instructions']?>&id=<?=$addressArray[$i]['ID']?>&user_id=<?=$addressArray[$i]['user_id']?>">
                            Address <?=($i + 1)?> (Primary Address): <?=$addressArray[$i]['street']?>, <?=$addressArray[$i]['city']?>, <?=$addressArray[$i]['state']?> <?=$addressArray[$i]['zip']?></a>
                    <?php endif;?>
                    <?php if($addressArray[$i]['is_primary'] == 0):?>
                        <a style="text-decoration: none; color: black;" href="Address/modify-address.php?primary=<?=$addressArray[$i]['is_primary']?>&street=<?=$addressArray[$i]['street']?>&city=<?=$addressArray[$i]['city']?>&zip=<?=$addressArray[$i]['zip']?>&state=<?=$addressArray[$i]['state']?>&delivery=<?=$addressArray[$i]['delivery_instructions']?>&id=<?=$addressArray[$i]['ID']?>&user_id=<?=$addressArray[$i]['user_id']?>">
                            Address <?=($i + 1)?>: <?=$addressArray[$i]['street']?>, <?=$addressArray[$i]['city']?>, <?=$addressArray[$i]['state']?> <?=$addressArray[$i]['zip']?></a>
                    <?php endif;?>
                    <br>
                <?php endfor;?>
            </div>
        </div>
        <div style="margin-top:25px;">
            <div>
                <ul style="display: inline;">
                    <li style="display: inline-block; margin-left: -30px;"><h3>Payment</h3></li>
                    <li style="display: inline;"><a style="text-decoration: none; color: black;" href="Payment/create_payment.php?user_id=<?=$row['ID']?>"> - (Add)</a></li>
                </ul>
                <br>
                <div style="height: 125px; width: 700px; overflow-y: auto;">
                    <?php for($i = 0; $i < count($paymentArray); $i++):?>
                        <a style="text-decoration: none; color: black;" href="Payment/modify_payment.php?id=<?=$paymentArray[$i]['ID']?>">
                            Payment Option <?=($i + 1)?>: Card Ending in <?=substr($paymentArray[$i]['card_number'],-4)?></a>
                        <br>
                    <?php endfor;?>
                </div>
            </div>
        </div>
        <div style="margin-top:25px;">
            <h3>Orders</h3>
            <?php if(count($orderArray) == 0):?>
                <h6>You have yet to order anything... Order <a href="order.php">here</a> now!</h6>
            <?php endif;?>
            <?php if(count($orderArray) > 0):?>
                <div style="height: 125px; width: 700px; overflow-y: auto;">
                    <?php for($i = 0; $i < count($orderArray); $i++):?>
                        <?php if($orderArray[$i]['status'] == 0):?>
                            <a style="text-decoration: none; color: black;" href="Orders/order_details.php?id=<?=$orderArray[$i]['ID']?>">
                                Order <?=($i + 1)?>: In Transit</a>
                        <?php endif;?>
                        <?php if($orderArray[$i]['status'] == 1):?>
                            <a style="text-decoration: none; color: black;" href="Orders/order_details.php?id=<?=$orderArray[$i]['ID']?>">
                                Order <?=($i + 1)?>: Delivered></a>
                        <?php endif;?>
                        <br>
                    <?php endfor;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>