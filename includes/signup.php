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
$query = "INSERT into " . DBConfig::$userTable . " (firstname,lastname,email,username,password) VALUES ('$firstname','$lastname','$email','$username','$password')";
$result = query_database($query);

//retrieve the assigned login_id for the newly created user
$query = "SELECT * FROM " . DBConfig::$userTable . " where firstname='$username'";
$result = query_database($query);

//store the result in an assoc array
$info = mysqli_fetch_assoc($result);

//get the auto-incremented login_id from the array
$login_id = $info['login_id'];
$access = '1';

//insert the new user in the permissions table
$query = "INSERT into " . DBConfig::$permissionsTable . " (login_id,access) VALUES ('$login_id','$access')";
$result = query_database($query);

//redirect to contact.php
header('Location:../contact.php');

?>