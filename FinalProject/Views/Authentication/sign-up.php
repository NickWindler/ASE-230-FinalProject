<?php
require('../../../root.php');
require(ROOT.'/FinalProject/Functions/auth_functions.php');
require(ROOT.'/FinalProject/DB/db_connect.php');
session_start();
is_logged();

if($_SESSION['logged'] == true)
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
    <title>Tofoo Order Services Sign-Up</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Style/signup.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal">Register your account</h1>
        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Email Address</label>
        </div>
        <div class="form-floating">
            <input type="text" name="fName" class="form-control" id="fName" placeholder="First Name" required>
            <label for="fName">First Name</label>
        </div>
        <div class="form-floating">
            <input type="text" name="lName" class="form-control" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="form-floating">
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone Number" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="12">
            <label for="phone">Phone (Format: 123-456-7890)</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input type="password" name="rtPass" class="form-control" id="rtPass" placeholder="Re-Type Password" required>
            <label for="rtPass">Re-Type Password</label>
        </div>
        <?php
        if(isset($_POST['submit'])) {
			$stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
			$stmt->execute([$_POST['email']]);
			$isValidEmail = $stmt->fetch();
			if(!empty($isValidEmail)) {
				echo 'Email is already in use';
			}
			else {
				if($_POST['password'] == $_POST['rtPass']) {
					if(strlen($_POST['password'])>=8 and strlen($_POST['password'])<=16) {
						signup($_POST['email'], $_POST['fName'], $_POST['lName'], $_POST['phone'], $_POST['password'], $db);
					}
					else
						echo 'Password needs to be between 8 - 16 characters';
				}
				else
					echo 'Passwords did not match';
			}
        }
        ?>
        <button class="w-100 btn btn-lg btn-primary" value="submit" name="submit" type="submit">Register</button>
    </form>
</main>
</body>
</html>
