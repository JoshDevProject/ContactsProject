<html>
<head>
    <title>Login Project | Sign Up Page</title>
    <link rel="stylesheet" href="includes/style.css" type="text/css">
</head>
<body>    
    <div class="login_wrapper" align="center">
        <form method="post" action="includes/signup.php">
            <label>First Name:</label>
            <input type="text" name="firstname"><br>
            <label>Last Name:</label>
            <input type="text" name="lastname"><br>
            <label>Email:</label>
            <input type="text" name="email"><br>
            <label>Username:</label>
            <input type="text" name="username"><br>
            <label>Password:</label>
            <input type="password" name="password"><br>
            <input type="submit" class="submit" value="Sign Up">
        </form>
    </div>
    <br><br><br><br>
</body>
</html>
<?php

include 'includes/database_functions.php';

//connect to the mysql db
$dbc = mysqli_connect(DBConfig::$host, DBConfig::$username, DBConfig::$password, DBConfig::$name) or die ("Error connecting to MySQL server: " . mysqli_connect_error());

echo '<table border="1">
    <tr>
        <td><a href="contact.php">login_id</a><br></td>
        <td><a href="contact.php">username</a><br></td>
        <td><a href="contact.php">password</a><br></td>
        <td><a href="contact.php">firstname</a><br></td>
        <td><a href="contact.php">lastname</a><br></td>
        <td><a href="contact.php">email</a><br></td>
    </tr>
    <tr>
        <td>login_id</td>
        <td>username</td>
        <td>password</td>
        <td>firstname</td>
        <td>lastname</td>
        <td>email</td>
     </tr>';
    //</table>';

    //retrieve the assigned login_id for the newly created user
    $query = "SELECT * FROM " . DBConfig::$userTable;
    $result = mysqli_query($dbc, $query) or die ("Error querying database: Retrieving login_id: " . mysqli_error());

    $rows = mysqli_num_rows($result);
    
    echo $rows;
    
    for ($x = 0; $x < $rows; $x++)
    {
        $xlogin_id  = mysql_result($result, $x, "login_id");
        $xusername  = mysql_result($result, $x, "username");
        $xpassword  = mysql_result($result, $x, "password");
        $xfirstname = mysql_result($result, $x, "firstname");
        $xlastname  = mysql_result($result, $x, "lastname");
        $xemail     = mysql_result($result, $x, "email");
        
        echo '<tr><td>' . $xlogin_id  . '</td>
                  <td>' . $xusername  . '</td>
                  <td>' . $xpassword  . '</td>
                  <td>' . $xfirstname . '</td>
                  <td>' . $xlastname  . '</td>
                  <td>' . $xemail     . '</td><tr>';
    }

    echo '</table>'
?>

</html>