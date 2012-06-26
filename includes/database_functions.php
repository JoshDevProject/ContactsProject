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


//connects to the mysql db
function connect_to_mysqldb()
{    
    return mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name);
}

?>
