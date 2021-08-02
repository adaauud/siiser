<?php
include_once('login.db.php')
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form class="login" method="post">
            <h1><center>Login Here</center></h1>
            <label>Username: </label>
            <input class="txtbox" type="text" name="username" placeholder="Enter username">
            <label>Password: </label>
            <input class="txtbox" type="text" name="password" placeholder="Enter password"><br>
            <input class="loginbtn" type="submit" name="login">
        </form>
    </body>
</html>