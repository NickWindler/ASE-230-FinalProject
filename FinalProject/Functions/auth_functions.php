<?php

function signin($email, $password, $db) {
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $stmt->execute([$email, $password]);
    $res = $stmt->fetch();
    if($res){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = $res['role'];
        header("Location:../index.php");
    }
    else
        echo 'Invalid Credentials';
}

function signup($email, $fName, $lName, $phone, $password, $db) {
    $stmt = $db->prepare('INSERT INTO users (first_name, last_name, email, password, phone, role) VALUES (?, ?, ?, ?, ?, 0)');
    $stmt->execute([$fName, $lName, $email, $password, $phone]);
    $stmt->fetch();
    echo "<script>window.location.href='sign-in.php';
		 alert('Your account has been created')</script>";
}

function is_logged(){
    if(isset($_SESSION['email']) and isset($_SESSION['password']))
        $_SESSION['logged'] = true;
    else
        $_SESSION['logged'] = false;
}


?>