<?php
session_start();
$mysqli = mysqli_connect("us-cdbr-east-04.cleardb.com","bd0f0b0d31a624","ab3b2b6a","heroku_e4df9ee799f1a28");

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $code = rand(1000,100000);
    $sql = "INSERT INTO files (name, email,username,password,code)
    VALUES ( '$name','$email','$username','$password','$code')";
    mysqli_query($mysqli, $sql);
    header('location:\localserver/index.php');
}
?>