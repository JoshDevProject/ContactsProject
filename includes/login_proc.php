<?php

include 'user_functions.php';

//start the session
session_start();

//Store username and password from post data
$username = $_POST["username"];
$password = $_POST["password"];

//start the login procedure using the username and password
user_login($username, $password);

//if ($_SESSION['logged_in']=yes) {
//    echo "win!<br>";
//    echo $_SESSION['logged_in'] . "<br>";
//    echo $_SESSION['access_level'];
//}
//else 
//{
//    echo "lame";
//}

?>