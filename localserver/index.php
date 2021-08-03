<?php
include_once('login.db.php');
$mysqli = mysqli_connect("us-cdbr-east-04.cleardb.com","bd0f0b0d31a624","ab3b2b6a","heroku_e4df9ee799f1a28");

$username = $_SESSION['username'];
$sql = "SELECT * FROM files WHERE username='$username'";
$result = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_assoc($result);
$code = $row['code'];
if(isset($_POST['logout'])){
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header('Location: /localserver/login.php');
die;
}
#  File Upload Code
if(isset($_FILES['file'])){
    $errors= array();
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
    move_uploaded_file($file_tmp,"uploads/".$file_name);
    echo "Success";
    $image = $_FILES["file"]["name"]; 
    $img = "uploads/".$image;
    $date = date("Y/m/d") ;
    $sql = "INSERT INTO register (name,size,uploadeddate, uploadedby)
    VALUES ( '$file_name','$file_size','$date','$code')";
    mysqli_query($mysqli, $sql);
    }
if(isset($_POST['login'])){
    header('Location: /localserver/login.php');
}
if(isset($_POST['register'])){
    header('location: \localserver/register.php');
}
?>
<html>
    <head>
        <title>Local Server</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body> 
        <?php  
        if(!$_SESSION['username']){
        ?>
         <div class="buttons">
            <form method="post">
                <button name="login">Login</button>
                <button name="register">Register</button>
            </form>
        </div>
        <?php
        }else{
        ?>
        <div class="buttons">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" value="Upload Image" />
                <button name="logout">logout</button>
            </form>
        </div>
        <?php
        }
        ?>
        <div class="sortby">
            <label>Sort By</label>
            <select>
                <option>None</option>
                <option>Last uploaded</option>
                <option>Size</option>
            </select>
        </div>
        <div class="searchbar">
            <?php echo $code; ?>
            <input type="search" name="search" placeholder="Search by......">
        </div>
        <?php
      $mysqli = mysqli_connect("us-cdbr-east-04.cleardb.com","bd0f0b0d31a624","ab3b2b6a","heroku_e4df9ee799f1a28");
		$data = "SELECT * FROM register WHERE  uploadedby = '$code'";
		$result = mysqli_query($mysqli,$data);
        ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Date Uploaded</th>
                <th>Uploaded By</th>
                <th>Download</th>
            </tr>
            <?php
		        while ($row = mysqli_fetch_assoc($result)):
	        ?>
            <tr>
                <td><?php  echo $row['name']?></td>
                <td><?php echo $row['size'] ?></td>
                <td><?php   echo $row['uploadeddate']?></td>
                <td><?php echo "me"; ?></td>
                <td> <a href="uploads/"<?php echo $row['name'];?> download>Download </a></td>
            </tr>
            <?php
        endwhile;
        ?>
        </table>
    </body>
</html>