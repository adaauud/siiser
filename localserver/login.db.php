<?php
session_start();
$conn = mysqli_connect("localhost","root","","localserver");
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = "SELECT * FROM register WHERE username='$username' AND password = '$password'";
	$result = mysqli_query($conn,$data);
    $row = mysqli_fetch_assoc($result);
    if($row['username'] == $username && $row['password'] == $password){
        header('location: \localserver/index.php');
        $sql = "SELECT * FROM register WHERE username='$username' AND password = '$password'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
    }else{
        echo "Password or username is wrong! Check again!";
    }
}

?>