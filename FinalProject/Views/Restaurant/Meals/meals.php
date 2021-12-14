<?php
require('../../../Functions/auth_functions.php');
require('../../../Functions/admin_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:../index.php");

$mealArray = $mealFunctions->getMealsForRestaurant($_GET['id'], $db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo <?=$_GET['name']?> Meals</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Style/index.css" rel="stylesheet">
</head>
<body class="text-center">
<main>
    <div style="height: 850px; width: 700px; border: 2px solid black; overflow-y: auto; margin: auto;">
        <h1 style="text-align: center;"><?=$_GET['name']?> Meals</h1>
        <?php for($i = 0; $i < count($mealArray); $i++):?>
            <div style="width: 100% height: 150px; padding-left: 10px;">
                <img src="<?=$mealArray[$i]['image_url']?>" height="150px" width="150px" style="float: left;">
                <div style="margin-left: 160px">
                    <a style="text-decoration: none; color: black;" href="modify-meal.php?id=<?=$mealArray[$i]['ID']?>&rID=<?=$_GET['id']?>&rName=<?=$_GET['name']?>"><h3><?=$mealArray[$i]['name']?></h3></a>
                    <p>Price: $<?=$mealArray[$i]['price']?></p>
                    <p><?=$mealArray[$i]['description']?></p><br><br>
                </div>
            </div>
        <?php endfor;?>
    </div>
    <div style="display: in-line; padding-top: 10px;">
        <a style="margin-left: 600px; font-size: 20px;" href="../../admin.php">Back to Admin View</a>
        <a style="margin-left: 427px; font-size: 20px;" href="create-meal.php?id=<?=$_GET['id']?>&rName=<?=$_GET['name']?>">Create Meal</a>
    </div>
</main>
</body>
</html>