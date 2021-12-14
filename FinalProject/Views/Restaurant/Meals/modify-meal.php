<?php
require('../../../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/Functions/admin_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:../index.php");

$stmt = $db->prepare('SELECT * FROM meals WHERE ID = ?');
$stmt->execute([$_GET['id']]);
$meal = $stmt->fetch();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Modify Meal</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../Style/sign-in.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Modify Meal</h1>
        <div class="form-floating">
            <input type="text" name="name" class="form-control" id="floatingInput" value="<?=$meal['name']?>" placeholder="Name" maxlength="74" required>
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
            <input type="number" step="0.01" name="price" class="form-control" id="price" value="<?=$meal['price']?>" placeholder="price" min="0" max="100.00" required>
            <label for="price">Price (Example: 19.99)</label>
        </div>
        <textarea style="height=100px; margin-top:1px;" maxlength="249" name="description" class="form-control" id="description" placeholder="Description" required><?=$meal['description']?></textarea>
        <div class="form-floating">
            <input type="text" name="url" class="form-control" id="url" value="<?=$meal['image_url']?>" placeholder="url" maxlength="250" required>
            <label for="url">Image URL</label>
        </div>
        <button style="margin-top:10px;" class="w-100 btn btn-lg btn-primary" value="submit" name="submit" type="submit">Submit</button>
        <button style="margin-top:10px;" class="w-100 btn btn-lg btn-primary" value="delete" name="delete" type="submit">Delete</button>
    </form>
    <?php
    if(isset($_POST['submit']))
        $mealFunctions->modifyMeal($_GET['id'], $_GET['rID'], $_POST['name'], $_POST['price'], $_POST['description'], $_POST['url'], $_GET['rName'], $db);
    if(isset($_POST['delete']))
        $mealFunctions->deleteMeal($_GET['id'], $_GET['rID'], $_GET['rName'], $db);
    ?>
</main>
</body>
</html>