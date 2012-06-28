<?php

include 'database_functions.php';

//start the session
session_start();

//retrieve user information from signup.html
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST ['email'];
$username = $_POST['username'];
$password = $_POST['password'];

//add the user to the user table
$result = query_database("INSERT into " . DBConfig::$userTable . " (firstname,lastname,email,username,password) VALUES ('$firstname','$lastname','$email','$username','$password')");

//retrieve the assigned login_id for the newly created user
$result = query_database("SELECT * FROM " . DBConfig::$userTable . " where firstname='$username'");

//store the result in an assoc array
$info = mysqli_fetch_assoc($result);

//get the auto-incremented login_id from the array
$login_id = $info['login_id'];

//define access for the new user
$access = '1';

//insert the new user in the permissions table
$result = query_database("INSERT into " . DBConfig::$permissionsTable . " (login_id,access) VALUES ('$login_id','$access')");

//redirect to contact.php
header('Location:../contact.php');

?>