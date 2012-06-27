<?php

include 'database_functions.php';

//authenticates and redirects the user
function user_login ($username,$password) 
{
    //start the session
    session_start();
    
    //authenticate the user
    if (authenticate($username,$password)) 
    {        
        //redirect to 1.php
        header("location: 1.php");
    }
    else 
    {
        //display error message
        echo "Wrong Username or Password.<br>";
    }
}

//returns true if the username/password combination are found in the database
//also sets the session access level from the users info
function authenticate ($username,$password) 
{  
    //form a connection with the database
    $dbc = mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name) or die ("Error connecting to MySQL server: " . mysqli_connect_error());
    
    //create a query to search the database by username and password
    $query = "SELECT * FROM " . DBConfig::$userTable . " WHERE username='$username' and password='$password'";
    $result = mysqli_query($dbc, $query) or die("Error querying database");
    
    //get the number of users the username and password
    $num_of_users = mysqli_num_rows($result);
    
    //if a user exists (if multiple exist, log in the first one)
    //set the permission of the session from the permissions table
    if ($num_of_users > 0)
    {                
        //get an array from the result
        $info = mysqli_fetch_assoc($result);
        
        //get the login id from the array
        $login_id = $info['login_id'];
        
        //query the permissions table to get the access level from the login_id
        $query = "SELECT * FROM " . DBConfig::$permissionsTable . " Where login_id='$login_id'";
        $result = mysqli_query($dbc, $query) or die("Error querying database");
        
        //get an array from the results
        $info = mysqli_fetch_assoc($result);

        //set the session access level from the login_id
        $_SESSION['access'] = $info['access'];
        
        echo $_SESSION['access'];
        
        return true;
    }
    else
    {
        //otherwise, set session access as "not_a_user"
        $_SESSION['access'] = "not_a_user";
        return false;
    }
}

//returns the access level
function get_access_level ()
{
    echo $_SESSION['access'];
}

?>
