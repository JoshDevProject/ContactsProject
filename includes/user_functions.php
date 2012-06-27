<?php

include 'database_functions.php';

//if unique user is located, start session
//problem is this runs regardless of whether or not a unique user is found. If I just type gibberish in the login page, $_SESSION['logged_in'] still gets set to yes
function user_login ($username,$password) 
{
    if (authenticate($username,$password)) 
    {        
        echo $_SESSION['access'];
        //header("location: 1.php");
    }
    else 
    {
        echo "Wrong Username or Password.<br>";
    }
}

//returns number of users with the username/password given
//also sets the session access level from the users info
function authenticate ($username,$password) 
{  
    //form a connection with the database
    $dbc = mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name) or die ("Error connecting to MySQL server: " . mysqli_connect_error());
    
    //create a query to search the database by username and password
    $query = "SELECT * FROM users WHERE username='$username' and password='$password'";
    $result = mysqli_query($dbc, $query) or die("Error querying database");
    
    $info = mysqli_fetch_assoc($result);
    
    //get the number of users the username and password
    $num_of_users = mysqli_num_rows($result);
    
    //if a user exists (if multiple users exist, log in the first one)
    if ($num_of_users > 0)
    {
        //set the session access level from the user
        $_SESSION['access'] = $info['access'];
    }
    else
    {
        //otherwise, set session access as "not_a_user"
        $_SESSION['access'] = "not_a_user";
    }
    
    return $num_of_users;
}

//check for appropriate access level. grant access or redirect to fail
function check_access_level ($level) 
{ 
    if ($_SESSION['access']  == $level) 
    {
        echo "You Win!";
    }
    else 
    {
        header ('location: ../fail.html');
    }
}

//returns the access level
function get_access_level ()
{
    return $_SESSION['access'];
}

?>
