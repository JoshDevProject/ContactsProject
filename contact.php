<html>
<head>
    <title>Login Project | Contact Page</title>
    <link rel="stylesheet" href="includes/style.css" type="text/css">
</head>
<body>    
    <h1>OMFG SUM LYNKZ</h1>
    <a href="signup.html">Sign Up</a><br>
    <a href="login.html">Login</a><br>
    <a href="contact.php">Contact</a><br>
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

//start the table
echo '<table border="1">
    <tr>
        <td><a href="contact.php?sortby=login_id">login_id</a><br></td>
        <td><a href="contact.php?sortby=username">username</a><br></td>
        <td><a href="contact.php?sortby=password">password</a><br></td>
        <td><a href="contact.php?sortby=firstname">firstname</a><br></td>
        <td><a href="contact.php?sortby=lastname">lastname</a><br></td>
        <td><a href="contact.php?sortby=email">email</a><br></td>
    </tr>';

    //check to see if there is a sorting method, sort by login_id by default
    if (!empty($_GET))
        $sort_method = $_GET['sortby'];
    else
        $sort_method = 'login_id';

    $result = query_database("SELECT * FROM " . DBConfig::$userTable . " ORDER BY " . $sort_method);
    
    //print out total amount of contacts
    $rows = mysqli_num_rows($result);
    echo 'Contacts: ' . $rows;
    
    //loop through all the contacts in the user db
    while($info = mysqli_fetch_assoc($result))
    {
        $xlogin_id  = $info['login_id'];
        $xusername  = $info['username']; 
        $xpassword  = $info['password'];
        $xfirstname = $info['firstname'];
        $xlastname  = $info['lastname'];
        $xemail     = $info['email'];
        
        echo '<tr><td>' . $xlogin_id  . '</td>
                  <td>' . $xusername  . '</td>
                  <td>' . $xpassword  . '</td>
                  <td>' . $xfirstname . '</td>
                  <td>' . $xlastname  . '</td>
                  <td>' . $xemail     . '</td><tr>';
    }

    //end the table
    echo '</table>'
?>

</html>