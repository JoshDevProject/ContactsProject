<?php

include 'user_functions.php';

//start the session
session_start();

//initialize the access to not a user
$_SESSION['access'] = "not_a_user";

//Store username and password from post data
$username = $_POST["username"];
$password = $_POST["password"];

//start the login procedure using the username and password
user_login($username, $password);

?>