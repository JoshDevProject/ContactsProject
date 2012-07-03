<?php

class DBConfig
{
    //database authentication info
    public static $host = 'localhost';
    public static $username = 'josh';
    public static $password = 'password';
    public static $name = 'login_project';
    
    //tables within the database
    public static $userTable = 'users';
    public static $permissionsTable = 'perms';
}

class DB
{
    //queries the database
    static function query_database($query)
    {
        $dbc = mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name) or die ("Error connecting to MySQL server: " . mysqli_connect_error());
        $result = mysqli_query($dbc, $query);
        mysqli_close($dbc);
    
        return $result;    
    }
    
    //adds a user to the database
    static function add_user($firstname, $lastname, $email, $username, $password)
    {
        DB::query_database("INSERT into " . DBConfig::$userTable . " (firstname,lastname,email,username,password) VALUES ('$firstname','$lastname','$email','$username','$password')");
        
        //retrieve the assigned login_id for the newly created user
        $result = DB::query_database("SELECT * FROM " . DBConfig::$userTable . " where username='$username'");

        //store the result in an assoc array
        $info = mysqli_fetch_assoc($result);

        //get the auto-incremented login_id from the array
        $login_id = $info['login_id'];

        //define access for the new user
        $access = '1';

        //insert the new user in the permissions table
        $result = DB::query_database("INSERT into " . DBConfig::$permissionsTable . " (login_id,access) VALUES ('$login_id','$access')");

    }
}

?>
