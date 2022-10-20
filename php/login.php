<?php
session_start();
require_once 'checkUser.php';
if(isset($_POST['submit'])){
    
    $email = $_POST['email'];//finish this line
    $password = $_POST['password'];//finish this

    loginUser($email, $password);

}

function loginUser(string $email, string $password){
    /*
    Finish this function to check if username and password 
    from file match that which is passed from the form
    */

    $auth = (object)checkUserLogin([$email,$password]);
    if($auth->Auth) {
        $_SESSION['Auth'] = $auth;
        header('location: ../dashboard.php');
    }else {
        echo "<script>alert(\"$auth->message\")</script>";
        echo "<h3>Redirecting...</h3>";
        header("Refresh:1; URL=../forms/login.html");
    }

}