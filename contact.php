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



echo '<table border="1">
    <tr>
        <td><a href="contact.php">login_id</a><br></td>
        <td><a href="contact.php">username</a><br></td>
        <td><a href="contact.php">password</a><br></td>
        <td><a href="contact.php">firstname</a><br></td>
        <td><a href="contact.php">lastname</a><br></td>
        <td><a href="contact.php">email</a><br></td>
    </tr>
    <tr><td>login_id</td><td>username</td><td>password</td><td>firstname</td><td>lastname</td><td>email</td></tr>
    </table> ';
?>

</html>