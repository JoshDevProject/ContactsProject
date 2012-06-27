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

//connect to the mysql db
$dbc = mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name) or die ("Error connecting to MySQL server: " . mysqli_connect_error());
//$dbc = connect_to_mysqldb() or die ("Error connecting to MySQL server. " . mysqli_connect_error());

//insert the new user in the users table
$query = "INSERT into " . DBConfig::$userTable . " (firstname,lastname,email,username,password) VALUES ('$firstname','$lastname','$email','$username','$password')";
$result = mysqli_query($dbc, $query) or die ("Error querying database: Inserting new user: " . mysqli_error());

//retrieve the assigned login_id for the newly created user
$query = "SELECT * FROM " . DBConfig::$userTable . " where firstname='$username'";
$result = mysqli_query($dbc, $query) or die ("Error querying database: Retrieving login_id: " . mysqli_error());

//store the result in an array
$info = mysqli_fetch_assoc($result);

$login_id = $info['login_id'];
$access = '1';

//insert the new user in the permissions table
$query = "INSERT into " . DBConfig::$permissionsTable . " (login_id,access) VALUES ('$login_id','$access')";
$result = mysqli_query($dbc, $query) or die ("Error querying database: Inserting new permissions: " . mysqli_error());

//close off access to the db
mysqli_close($dbc);

//redirect to index.html
header('Location:../index.html');

?>