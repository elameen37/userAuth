<?php
session_start();
require_once 'checkUser.php';
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    registerUser($username, $email, $password);

}
//save data into the file
function registerUser($username, $email, $password){
    $newUser = (object)getUserRegistered([$username, $email, $password]);

    if($newUser->Auth) {
        $_SESSION['Auth'] = $newUser;
        header('location: ../dashboard.php');
    }else {
        echo "<script>alert(\"$newUser->message\")</script>";// echo "OKAY";
        echo "<h3>Redirecting...</h3>";
        header('Refresh:1; URL=../forms/register.html');
    }

}

