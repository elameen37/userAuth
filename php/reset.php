<?php
require_once 'checkUser.php';
if(isset($_POST['submit'])){
    $email = $_POST['email'];//complete this;
    $newpassword = $_POST['password'];//complete this;

    resetPassword($email, $newpassword);
}

function resetPassword($email, $password){
    //open file and check if the username exist inside
    //if it does, replace the password

    $auth = (object)updateUser([$email, $password]);
    if($auth->Auth) {
        $_SESSION['Auth'] = $auth;
        echo "<h3>Password reset <br>New Password: $password</h3>";
        echo "<br><br><h3>Login with new password...</h3>";
        header('Refresh:3; URL=../forms/login.html');
    }else {
        echo "<script>alert(\"$auth->message\")</script>";
        echo "<h3>Redirecting...</h3>";
        header("Refresh:1; URL=../forms/resetpassword.html");
    }
}