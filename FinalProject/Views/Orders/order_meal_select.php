<?php
require('../../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/admin_functions.php');

$meals = $mealFunctions->getMealsForRestaurant($_GET['rID'], $db);
$addressArray = $addressFunctions->getAddressesForUser($res['ID'], $db);
$paymentArray = $paymentFunctions->getPaymentOptionsForUser($res['ID'], $db);

$cart = [];
if(isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];

if(isset($_POST['previous']))
    header('Location:order_restaurant_select.php?typeID='.$_GET['typeID']);

if(isset($_POST['next']) && isset($_SESSION['cart']))
    if(count($_SESSION['cart']) > 0)
        header('Location:finalize_order.php');
    else
        echo "<h1 style='text-align: center;  color: red'>You must order at least one item before continuing</h1>";
if(isset($_POST['next']) && !isset($_SESSION['cart']))
    echo "<h1 style='text-align: center; color: red'>You must order at least one item before continuing</h1>";

if(count($addressArray) == 0 or count($paymentArray) == 0)
	header('Location:../order.php')
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Order Page</title>
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
                        <a class="nav-link" href="admin.php">Admin View</a>
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

<main class="container" >
    <div class="bg-light p-5 rounded" style="height: 875px;">
        <h1 style="text-align: center;"><?=$_GET['rName']?> Meals</h1>
        <h1 style="display: inline; margin-left: -365px;">Meals</h1>
        <h1 style="display: inline; margin-left: 550px;">Cart</h1>
        <div style="margin-top: 64px; width: 48%; float: left;">
            <div style="border: 1px solid black; height: 600px; overflow-y: auto;">
                <?php for($i = 0; $i < count($meals); $i++):?>
                    <div style="width: 100% height: 150px; margin-left: .01px; border: 1px solid black;">
                        <img src="<?=$meals[$i]['image_url']?>" height="150px" width="150px" style="float: left;">
                        <div style="margin-left: 160px">
                            <h3 style="min-height: 10px"><?=$meals[$i]['name']?></h3>
                            <p style="margin-top: -10px; height: 10px"><strong>Price: $<?=$meals[$i]['price']?></strong></p>
                            <p style="margin-top: -5px; height: 57px"><?=$meals[$i]['description']?></p>
                            <a href="../../Functions/manage_cart.php?name=<?=$meals[$i]['name']?>&price=<?=$meals[$i]['price']?>&typeID=<?=$_GET['typeID']?>&rID=<?=$_GET['rID']?>&function=add&rName=<?=$_GET['rName']?>&mealID=<?=$meals[$i]['ID']?>" style="height: 10px" >Add to Cart</a>
                        </div>
                    </div>
                <?php endfor;?>
            </div>
        </div>
        <div style="margin-top: 15px; width: 48%; float: right;">
            <div style="border: 1px solid black; height: 600px; overflow-y: auto;">
                <?php for($i = 0; $i < count($cart); $i++):?>
                    <div style="margin-left: 5px;">
                        <a style="float: right; margin-right: 10px;" href="../../Functions/manage_cart.php?index=<?=$i?>&typeID=<?=$_GET['typeID']?>&rID=<?=$_GET['rID']?>&function=remove&rName=<?=$_GET['rName']?>&mealID=<?=$meals[$i]['ID']?>">Remove from Cart</a>
                        <h3><?=$cart[$i][0]?></h3>
                        <p style="margin-top: -10px;"><strong>Price: $<?=$cart[$i][1]?></strong></p>
                    </div>
                <?php endfor;?>
            </div>
        </div>
        <form method="POST">
            <div style="margin-top: 650px;">
                <button style="float: right;" class="w-10 btn btn-lg btn-primary" value="next" name="next" type="submit">Next</button>
                <button style="float: left;" class="w-10 btn btn-lg btn-primary" value="previous" name="previous" type="submit">Previous</button>
            </div>
        </form>
    </div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>
</html>
