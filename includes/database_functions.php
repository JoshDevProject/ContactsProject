<?php

class DBConfig
{
    public static $host = 'localhost';
    public static $username = 'josh';
    public static $password = 'password';
    public static $name = 'login_project';
    
    public static $userTable = 'users';
    public static $permissionsTable = 'permissions';
}

//queries the user table
function query_database($query)
{
    $dbc = mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name) or die ("Error connecting to MySQL server: " . mysqli_connect_error());
    $result = mysqli_query($dbc, $query);
    mysqli_close($dbc);
    
    return $result;    
}

?>
