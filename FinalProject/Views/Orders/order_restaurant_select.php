<?php
require('../../Functions/auth_functions.php');
require('../../Functions/admin_functions.php');
is_logged();

$restaurantArray = $restaurantFunctions->getRestaurantsByType($_GET['typeID'], $db);
if(isset($_POST['restaurant'])) {
    for($i = 0; $i < count($restaurantArray); $i++) {
        if($restaurantArray[$i]['ID'] == $_POST['restaurant'])
            $rName = $restaurantArray[$i]['name'];
    }
}

if(isset($_POST['next'])) {
    if(isset($_SESSION['cart']))
        unset($_SESSION['cart']);
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
    <title>Tofoo Order Restaurant Select</title>
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
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
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
<main class="container" >
    <div class="bg-light p-5 rounded" style="height: 100%;">
        <h1 >Order Now</h1>
        <form method="POST">
            <div  class="form-floating">
                <select name="restaurant" class="form-control" id="restaurant" placeholder="Restaurant">
                    <?php
                    for($i = 0; $i < count($restaurantArray); $i++) {
                        displayRestaurants($restaurantArray[$i], $restaurantArray[$i]['ID']);
                    }
                    ?>
                </select>
                <label for="restaurant">Restaurant</label>
                <div style="margin-top: 10px;">
                    <button style="float: right;" class="w-10 btn btn-lg btn-primary" value="next" name="next" type="submit">Next</button>
                    <button style="float: left;" class="w-10 btn btn-lg btn-primary" value="previous" name="previous" type="submit">Previous</button>
                </div>
            </div>
        </form>
        <?php if(isset($_POST['next'])) header('Location:order_meal_select.php?typeID='.$_GET['typeID'].'&rID='.$_POST['restaurant'].'&rName='.$rName);?>
        <?php if(isset($_POST['previous'])) header('Location:../order.php');?>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
