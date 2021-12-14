<?php
require('../../Functions/auth_functions.php');
require('../../Functions/admin_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:index.php");

$price = 0;
$page = 0;
date_default_timezone_set('America/New_York');
$currentTime = date('Y-m-d h:i:s',time());

$cart = $_SESSION['cart'];
$addressArray = $addressFunctions->getAddressesForUser($res['ID'], $db);
$paymentArray = $paymentFunctions->getPaymentOptionsForUser($res['ID'], $db);

if(isset($_POST['checkout'])) {
    $orderFunctions->createOrder($res['ID'], $currentTime, $_SESSION['cart'], $db);
    $page = 1;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Finalize Order</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Style/index.css" rel="stylesheet">
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
                    <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../order.php">Order</a>
                </li>
                <?php if($_SESSION['role'] == 1):?>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin.php">Admin View</a>
                    </li>
                <?php endif;?>
            </ul>
            <?php if($_SESSION['logged'] == true):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link" href="../profile.php?id=<?=$res['ID']?>">Profile</a>
                </li>
            <?php endif;?>
            <?php if($_SESSION['logged'] == false):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link" href="../Authentication/sign-in.php">Sign In</a>
                </li>
            <?php endif;?>
            <?php if($_SESSION['logged'] == true):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link" href="../Authentication/sign-out.php">Sign Out</a>
                </li>
            <?php endif;?>
        </div>
    </div>
</nav>
<body class="text-center">
<main class="form-signin">
    <?php if($page == 0):?>
        <h1>Order Details</h1><br>
        <h3>Meals</h3>
        <div style="height: 80px; margin: auto; overflow-y: auto;">
            <?php for($i = 0; $i < count($cart); $i++):?>
                <h6><?=$cart[$i][0]?> - $<?=$cart[$i][1]?></h6>
                <?php $price = $price + $cart[$i][1]?>
            <?php endfor;?>
        </div><br>
        <h3>Order Address</h3>
        <form method="POST">
            <div style="height: 80px; width: 30%; margin: auto; overflow-y: auto; border: solid 2px black">
                <?php for($i = 0; $i < count($addressArray); $i++):?>
                    <div style="float: left;">
                        <?php if($addressArray[$i]['is_primary'] == 1):?>
                            <input style="margin-left: 5px;" type="radio" id="address<?=$i?>" name="address" value="<?=$addressArray[$i]['ID']?>" checked>
                        <?php endif;?>
                        <?php if($addressArray[$i]['is_primary'] == 0):?>
                            <input style="margin-left: 5px;" type="radio" id="address<?=$i?>" name="address" value="<?=$addressArray[$i]['ID']?>">
                        <?php endif;?>
                        <label style="margin-bottom: -20px;" for="address<?=$i?>">Address <?=($i + 1)?>: <?=$addressArray[$i]['street']?>, <?=$addressArray[$i]['city']?>, <?=$addressArray[$i]['state']?> <?=$addressArray[$i]['zip']?></p>
                    </div>
                <?php endfor;?>
            </div><br>
            <h3>Payment Method</h3>
            <div style="height: 80px; width: 16.1%; margin: auto; overflow-y: auto; border: solid 2px black">
                <?php for($i = 0; $i < count($paymentArray); $i++):?>
                    <div style="float: left;">
                        <input style="margin-left: 5px;" type="radio" id="payment<?=$i?>" name="payment" value="<?=$paymentArray[$i]['ID']?>">
                        <label for="payment<?=$i?>">Payment Option <?=($i + 1)?>: Card Ending in <?=substr($paymentArray[$i]['card_number'],-4)?></label>
                    </div>
                <?php endfor;?>
            </div><br><br>
            <h3 style="margin-top">Total: $<?=$price?></h3><br><br>
            <button class="w-10 btn btn-lg btn-primary" value="checkout" name="checkout" type="submit">Checkout</button>
        </form>
    <?php endif;?>
    <?php if($page == 1):?>
    <br><br><h1>Order has been Placed!</h1>
    <h5>Visit the <a href="../profile.php?id=<?=$res['ID']?>">profile</a> tab to track its current status</h2>
        <?php endif;?>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>