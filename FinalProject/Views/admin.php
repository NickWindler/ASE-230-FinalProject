<?php
require('../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/admin_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:index.php");

if(isset($_POST['search_restaurant'])) {
    $_POST['restaurant'] = 'set';
    $restaurantArray = $restaurantFunctions->searchRestaurant($_POST['restaurant_name'], $db);
}

if(isset($_POST['search_user'])) {
    $_POST['users'] = 'set';
    $userArray = $userFunctions->searchUser($_POST['user_name'], $db);
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
    <title>Tofoo Order Services Admin View</title>
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
                        <a class="nav-link active" href="admin.php">Admin View</a>
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
    <div class="bg-light p-5 rounded" style="height: 750px;">
        <h1>Admin View</h1>
        <form method="POST">
            <button style="margin-top:10px;" class="btn btn-lg btn-primary" value="restaurant" name="restaurant" type="submit">View Restaurants</button>
            <button style="margin-top:10px;" class="btn btn-lg btn-primary" value="users" name="users" type="submit">View Users</button>
        </form>
        <?php if(isset($_POST['restaurant'])):?>
            <ul style="display: inline;">
                <li style="display: inline-block; margin-left: -30px; margin-top:10px;"><h3>Restaurants</h3></li>
                <li style="display: inline;"><a style="text-decoration: none; color: black;" href="Restaurant/create-restaurant.php"> - (Add)</a></li>
                <form style="display: inline; margin-left:10px;" method="POST">
                    <li style="display: inline;"><input type="text" name="restaurant_name" placeholder="Enter Restaurant"></li>
                    <li style="display: inline;"><button type="submit" name="search_restaurant" class="btn btn-primary">Search</button></li>
                </form>
            </ul>
            <div style="height: 500px; width: 700px; overflow-y: auto;">
                <?php for($i = 0; $i < count($restaurantArray); $i++):?>
                    <a style="text-decoration: none; color: black;" href="Restaurant/modify-restaurant.php?id=<?=$restaurantArray[$i]['ID']?>"><?=$restaurantArray[$i]['name']?>: <?=$restaurantArray[$i]['street']?>, <?=$restaurantArray[$i]['city']?>, <?=$restaurantArray[$i]['state']?> <?=$restaurantArray[$i]['zip']?></a>
                    <a href="Restaurant/Meals/meals.php?id=<?=$restaurantArray[$i]['ID']?>&name=<?=$restaurantArray[$i]['name']?>">(Menu)</a>
                    <br>
                <?php endfor;?>
            </div>
        <?php endif;?>
        <?php if(isset($_POST['users'])):?>
            <ul style="display: inline;">
                <li style="display: inline-block; margin-left: -30px; margin-top:10px;"><h3>Users</h3></li>
                <form style="display: inline; margin-left:10px;" method="POST">
                    <li style="display: inline;"><input type="text" name="user_name" placeholder="Enter Name"></li>
                    <li style="display: inline;"><button type="submit" name="search_user" class="btn btn-primary">Search</button></li>
                </form>
            </ul>
            <br>
            <div style="height: 125px; width: 700px; overflow-y: auto;">
                <?php for($i = 0; $i < count($userArray); $i++):?>
                    <a style="text-decoration: none; color: black;" href="profile.php?id=<?=$userArray[$i]['ID']?>">
                        <?=$userArray[$i]['first_name']?> <?=$userArray[$i]['last_name']?>: <?=$userArray[$i]['email']?>, <?=$userArray[$i]['phone']?></a>
                    <br>
                <?php endfor;?>
            </div>
        <?php endif;?>
    </div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>