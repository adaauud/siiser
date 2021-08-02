<?php
include_once('register.db.php')
?>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form class="login" method="post">
            <h1><center>Register Here</center></h1>
            <label>Full Name: </label>
            <input class="txtbox" type="text" name="name" placeholder="Enter full name">
            <label>Email: </label>
            <input class="txtbox" type="email" name="email" placeholder="Enter email"><br>
            <label>Username: </label>
            <input class="txtbox" type="text" name="username" placeholder="Enter username">
            <label>Password: </label>
            <input class="txtbox" type="text" name="password" placeholder="Enter password"><br>
            <input class="loginbtn" type="submit" name="register">
        </form>
    </body>
</html>