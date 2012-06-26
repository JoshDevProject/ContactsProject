<?php

//if unique user is located, start session
//problem is this runs regardless of whether or not a unique user is found. If I just type gibberish in the login page, $_SESSION['logged_in'] still gets set to yes
function user_login ($username,$password) 
{
    if (authenticate($username,$password)) 
    {        
        header("location: 1.php");
    }
    else 
    {
        echo "Wrong Username or Password.<br>";
    }
}

//returns true if the username/password combination are found in the database
//also sets the session access level from the users info
function authenticate ($username,$password) 
{  
    //form a connection with the database
    $dbc = mysqli_connect('localhost','josh','password','login_project')or die("Error connecting to MySQL server." . mysqli_connect_error());
    //$dbc = connect_to_mysqldb();
    
    //create a query to search the database by username and password
    $query = "SELECT * FROM users WHERE username='$username' and password='$password'";
    
    //run the query on the database
    $result = mysqli_query($dbc, $query) or die("Error querying database");
    
    //get the first row from the query
    $row = mysqli_fetch_assoc($result);
    
    //if a user exists (if multiple exist, log in the first one)
    if (mysqli_num_rows($result) > 0)
    {
        //set the session access level from the user
        $_SESSION['access_level'] = $row['access_level'];
    }
    else
        //otherwise, set session access as "not_a_user"
        $_SESSION['access_level'] = "not_a_user";
    
    //keep count of matching records
    $count = mysqli_num_rows($result);
    
    return $count;
}




//check for appropriate access level. grant access or redirect to fail
function check_access_level ($level) 
{ 
    if ($_SESSION['access_level']  == $level) 
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
    return $_SESSION['access_level'];
}

?>
