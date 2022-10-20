<?php
session_start();
$users = $_SESSION['Auth']->message;
function logout(){
/*
    Check if the existing user has a session
    if it does
    destroy the session and redirect to login page
*/
}
echo "<h2>Loging out $users[0] </h2> <h4>you will be redirected to the home page</h4>";
session_destroy();
sleep(1);
echo "<h3>Redirecting...</h3>";
header('Refresh:3; URL=../index.php');
