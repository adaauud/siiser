<?php
session_start();
$mysqli = new mysqli("localhost","root","","localserver");

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $code = rand(1000,100000);
    $sql = "INSERT INTO register (name, email,username,password,code)
    VALUES ( '$name','$email','$username','$password','$code')";
    mysqli_query($mysqli, $sql);
    header('location:\localserver/index.html');
}
?>