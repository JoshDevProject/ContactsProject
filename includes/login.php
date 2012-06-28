<?php

include 'user_functions.php';

//start the session
session_start();

//provide 0 access until user is logged in
$_SESSION['access'] = '0';

//Store username and password from post data
$username = $_POST["username"];
$password = $_POST["password"];

//start the login procedure using the username and password
user_login($username, $password);

?>