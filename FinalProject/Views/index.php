<?php
require('../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/profile_functions.php');
is_logged();

$stmt = $db->query('SELECT *, types.name AS type_name FROM types JOIN restaurants ON types.ID = restaurants.type_id ORDER BY restaurants.ID DESC limit 3');
$restaurants = [];
while ($row = $stmt->fetch())
    array_push($restaurants, $row);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Order Services Home</title>
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
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
        <h1>New Locations Available!</h1>
        <?php for($i = 0; $i < count($restaurants); $i++):?>
        <div style="width: 100%; height: 200px;">
            <img src="<?=$restaurants[$i]['image_url']?>" height="200px" width="200px" style="float: left; padding-right: 10px">
            <h2><a style="text-decoration: none; color: black;" href="Orders/order_meal_select.php?typeID=<?=$restaurants[$i]['type_id']?>&rID=<?=$restaurants[$i]['ID']?>&rName=<?= $restaurants[$i]['name']?>"><?= $restaurants[$i]['name']?></a></h2>
            <h5>Location:</h5>
            <p style="margin-top:-10px;"><?=$restaurants[$i]['street']?></p>
            <p style="margin-top:-20px;"><?=$restaurants[$i]['city']?>, <?=$restaurants[$i]['state']?> <?=$restaurants[$i]['zip']?></p>
            <h5>Additional Info:</h5>
            <p style="margin-top:-10px;">Type: <?=$restaurants[$i]['type_name']?></p>
            <p style="margin-top:-20px;">Rating: <?=$restaurants[$i]['rating']?> Stars</p>
            <div>
                <?php endfor;?>
            </div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
