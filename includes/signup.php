<?php

include 'database_functions.php';

//start the session
session_start();

//provide 0 access until user is logged in
$_SESSION['access'] = '0';

//retrieve user information from signup.html
$firstname =    $_POST['firstname'];
$lastname =     $_POST['lastname'];
$email =        $_POST['email'];
$username =     $_POST['username'];
$password =     $_POST['password'];

//add the user to the user table
//$result = query_database("INSERT into " . DBConfig::$userTable . " (firstname,lastname,email,username,password) VALUES ('$firstname','$lastname','$email','$username','$password')");

$result = DB::add_user($firstname, $lastname, $email, $username, $password);

//redirect to contact.php
header('Location:../contact.php');

?>