<?php
require('../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/admin_functions.php');
is_logged();

if($_SESSION['logged'] == true) {
	$addressArray = $addressFunctions->getAddressesForUser($res['ID'], $db);
	$paymentArray = $paymentFunctions->getPaymentOptionsForUser($res['ID'], $db);
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
    <title>Tofoo Order Page</title>
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
                    <a class="nav-link active" href="order.php">Order</a>
                </li>
                <?php if($_SESSION['role'] == 1):?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin View</a>
                    </li>
                <?php endif;?>
            </ul>
            <?php if($_SESSION['logged'] == true):?>
                <li class="navbar-nav mb-2 mb-md-0">
                    <a class="nav-link" href="profile.php?id=<?=$res['ID']?>">Profile</a>
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
    <div class="bg-light p-5 rounded" style="height: 100%;">
        <h1 >Order Now</h1>
        <?php if($_SESSION['logged'] == true):?>
            <?php if(count($addressArray) > 0 and count($paymentArray) > 0):?>
                <form method="POST">
                    <div  class="form-floating">
                        <button style="float: right; height: 55px" class="w-10 btn btn-lg btn-primary" value="next" name="next" type="submit">Next</button>
                        <select style="width:90%;" name="type" class="form-control" id="type" placeholder="Type">
                            <?php
                            for($i = 0; $i < count($typeArray); $i++) {
                                displayTypes($typeArray[$i], $typeArray[$i]['ID'], true, "order");
                            }
                            ?>
                        </select>
                        <label for="type">Type</label>
                    </div>
                </form>
            <?php endif;?>
			<?php if(count($addressArray) == 0 or count($paymentArray) == 0):?>
				<h3>Please make sure you have at least one payment option and one address created</h3>
			<?php endif;?>
        <?php endif;?>
        <?php if($_SESSION['logged'] == false):?>
            <h3>Please <a href="Authentication/sign-in.php">sign in</a> to order. Don't have an account? Sign-up <a href="Authentication/sign-up.php">here</a> today!</h3>
        <?php endif;?>
        <?php if(isset($_POST['next'])) header('Location:Orders/order_restaurant_select.php?typeID='.$_POST['type']);?>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
