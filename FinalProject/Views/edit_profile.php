<?php
require('../Functions/auth_functions.php');
require('../Functions/profile_functions.php');
is_logged();

if($_SESSION['logged'] == false)
    header("Location:../index.php");

$stmt = $db->query('SELECT * FROM users WHERE ID = ' . $_GET['id']);
$user = $stmt->fetch();
$stmt = $db->query('SELECT * FROM users WHERE email = "' . $_SESSION['email'] . '"');
$loggedUser = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tofoo Edit Profile</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../Style/signup.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Edit Profile</h1>
        <div class="form-floating">
            <input type="email" name="email" class="form-control" value="<?=$user['email']?>" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email Address</label>
        </div>
        <div class="form-floating">
            <input type="text" name="fName" class="form-control" value="<?=$user['first_name']?>" id="fName" placeholder="First Name" required>
            <label for="fName">First Name</label>
        </div>
        <div class="form-floating">
            <input type="text" name="lName" class="form-control" value="<?=$user['last_name']?>" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="form-floating">
            <input type="tel" name="phone" class="form-control" value="<?=$user['phone']?>" id="phone" placeholder="Phone Number" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="12">
            <label for="phone">Phone (Format: 123-456-7890)</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" value="<?=$user['password']?>" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <?php if($loggedUser['ID'] == $_GET['id']):?>
            <div class="form-floating">
                <input type="password" name="rtPass" class="form-control" id="rtPass" placeholder="Re-Type Password" required>
                <label for="rtPass">Re-Type Password</label>
            </div>
        <?php endif;?>
        <?php if($loggedUser['ID'] != $_GET['id']):?>
            <div class="form-floating">
                <input type="password" name="rtPass" class="form-control" value="<?=$user['password']?>" id="rtPass" placeholder="Re-Type Password" required>
                <label for="rtPass">Re-Type Password</label>
            </div>
        <?php endif;?>
        <?php
        if(isset($_POST['submit'])) {
            if($_POST['password'] == $_POST['rtPass']) {
                if(strlen($_POST['password'])>=8 and strlen($_POST['password'])<=16) {
                    $userFunctions->modifyUser($_GET['id'], $_POST['fName'], $_POST['lName'], $_POST['email'], $_POST['password'], $_POST['phone'], $loggedUser['ID'], $db);
                }
                else
                    echo 'Password needs to be between 8 - 16 characters';
            }
            else
                echo 'Passwords did not match';
        }
        if(isset($_POST['delete']))
            $userFunctions->deleteUser($_GET['id'], $db);

        ?>
        <button class="w-100 btn btn-lg btn-primary" value="submit" name="submit" type="submit">Submit</button>
        <button style="margin-top:10px;" class="w-100 btn btn-lg btn-primary" value="delete" name="delete" type="submit">Delete Account</button>
    </form>
</main>
</body>
</html>
