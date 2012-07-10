<?php

//make sure a function was picked for processing data
if (isset($_POST['processor']))
{
    //calls the function associated with the processor
    switch($_POST['processor'])
    {
        case 'add_user':
            DB::add_user($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password']);
            echo $_POST['firstname'] . ' ' . $_POST['lastname'] . ' has been added to the database.';
            break;
        case 'display_database':
            DB::HTMLTableDisplay($_POST['sortBy']);
            break;
        default:
            echo "No matching processor for: " . $_POST['processor'];
    }
}
else echo "No function assigned for processing.";

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
    
    static function HTMLTableDisplay($sortBy)
    {
        echo '<table class="user_table" border="1">
            <tr>
                <td><div id=login_id">login_id<br></div></td>
                <td><div id="username">username<br></div></td>
                <td>password<br></td>
                <td>firstname<br></td>
                <td>lastname<br></td>
                <td>email<br></td>
                <td>Del<br></td>
            </tr>';
        
        //check to see if there is a sorting method, sort by login_id by default
        if (!isset($sortBy))
            $sortBy = "login_id";
        
        $result = DB::query_database("SELECT * FROM " . DBConfig::$userTable . " ORDER BY " . $sortBy);
    
        //print out total amount of contacts
        $rows = mysqli_num_rows($result);
        //echo 'Contacts: ' . $rows;

        //loop through all the contacts in the user db
        for($i = 1; $info = mysqli_fetch_assoc($result); $i++)
        {
            $xlogin_id  = $info['login_id'];
            $xusername  = $info['username'];
            $xpassword  = $info['password'];
            $xfirstname = $info['firstname'];
            $xlastname  = $info['lastname'];
            $xemail     = $info['email'];
        
        echo '<tr name=row'. $i .'>
                  <td>' . $xlogin_id  . '</td>
                  <td>' . $xusername  . '</td>
                  <td>' . $xpassword  . '</td>
                  <td>' . $xfirstname . '</td>
                  <td>' . $xlastname  . '</td>
                  <td>' . $xemail     . '</td>
                  <td name=delete>X</td>';
    }
        
        //end the table
        echo '</table>';
    }
}

?>
