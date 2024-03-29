<?php

include 'database_functions.php';

//authenticates and redirects the user
function user_login ($username,$password) 
{    
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
    //create a query to search the database by username and password
    $result = DB::query_database("SELECT * FROM " . DBConfig::$userTable . " WHERE username='$username' and password='$password'");
    
    //if a user exists (if multiple exist, log in the first one)
    //set the permission of the session from the permissions table
    if (mysqli_num_rows($result) > 0)
    {                
        //get an array from the result
        $info = mysqli_fetch_assoc($result);
        
        //get the login id from the array
        $login_id = $info['login_id'];
        
        //query the permissions table to get the access level from the login_id
        $result = DB::query_database("SELECT * FROM " . DBConfig::$permissionsTable . " Where login_id='$login_id'");
        
        //get an array from the results
        $info = mysqli_fetch_assoc($result);

        //set the session access level from the login_id
        $_SESSION['access'] = $info['access'];
        
        return true;
    }
    else
    {
        //otherwise, set session access as 0
        $_SESSION['access'] = 0;
        
        return false;
    }
}

//returns the access level
function get_access_level()
{
    echo $_SESSION['access'];
}

?>
