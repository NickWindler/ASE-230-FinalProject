<?php
require('../../Functions/auth_functions.php');
require('../../Functions/admin_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:../index.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Create Restaurant</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Style/sign-in.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Create Restaurant</h1>
        <div class="form-floating">
            <select name="type" class="form-control" id="type" placeholder="Type">
                <?php
                for($i = 0; $i < count($typeArray); $i++) {
                    displayTypes($typeArray[$i], $typeArray[$i]['ID'], true, "create");
                }
                ?>
            </select>
            <label for="type">Type</label>
        </div>
        <div class="form-floating">
            <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Name" maxlength="74" required>
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" name="street" class="form-control" id="street" placeholder="Street" maxlength="74" required>
            <label for="street">Street</label>
        </div>
        <div class="form-floating">
            <input type="text" name="city" class="form-control" id="city" placeholder="City" maxlength="59" required>
            <label for="city">City</label>
        </div>
        <div class="form-floating">
            <input style="text-transform:uppercase;" type="text" name="state" class="form-control" id="state" placeholder="State" maxlength="2" required>
            <label for="state">State</label>
        </div>
        <div class="form-floating">
            <input type="number" name="zip" class="form-control" id="zip" placeholder="zip" min="10000" max="99999" required>
            <label for="zip">Zip</label>
        </div>
        <div class="form-floating">
            <input type="number" step="0.1" name="rating" class="form-control" id="rating" placeholder="rating" maxlength="3" min="0" max="5" required>
            <label for="rating">Rating (Example: 3.5)</label>
        </div>
        <div class="form-floating">
            <input type="text" name="url" class="form-control" id="url" placeholder="url" maxlength="250" required>
            <label for="url">Image URL</label>
        </div>
        <button style="margin-top:10px;" class="w-100 btn btn-lg btn-primary" value="submit" name="submit" type="submit">Submit</button>
    </form>
    <?php
    if(isset($_POST['submit']))
        $restaurantFunctions->createRestaurant($_POST['type'], $_POST['name'], $_POST['street'], $_POST['city'], $_POST['zip'], $_POST['state'], $_POST['rating'], $_POST['url'], $db);
    ?>
</main>
</body>
</html>