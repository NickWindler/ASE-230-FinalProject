<?php
require('../../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/profile_functions.php');
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
    <title>Tofoo Create Address</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Style/sign-in.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Create Address</h1>
        <div class="form-floating">
            <input type="text" name="street" class="form-control" id="floatingInput" placeholder="Street" required>
            <label for="floatingInput">Street</label>
        </div>
        <div class="form-floating">
            <input type="text" name="city" class="form-control" id="city" placeholder="City" required>
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
        <textarea style="height=100px; margin-top:5px;" maxlength="499" name="delivery_instructions" class="form-control" id="delivery_instructions" placeholder="Delivery Instructions"></textarea>
        <div class="form-floating">
            <input style="height:25px; width: 25px; margin-top: 10px" type="checkbox" name="is_primary" id="is_primary">
            <label style="margin-top: -10px;" for="is_primary">Primary Address</label>
        </div>
        <button style="margin-top:10px;" class="w-100 btn btn-lg btn-primary" value="submit" name="submit" type="submit">Submit</button>
    </form>
    <?php
    if(isset($_POST['submit'])) {
        if(isset($_POST['is_primary']))
            $_POST['is_primary'] = 1;
        else
            $_POST['is_primary'] = 0;
        $addressFunctions->createAddress($res['ID'], $_POST['is_primary'], $_POST['street'], $_POST['city'], $_POST['zip'], $_POST['state'], $_POST['delivery_instructions'], $db);
    }
    ?>
</main>
</body>
</html>