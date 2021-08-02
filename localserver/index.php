<?php
include_once('login.db.php');
if(!$_SESSION['username']){
    header('location:\localserver/login.php');
}

$mysqli = new mysqli("localhost","root","","localserver");
$username = $_SESSION['username'];
$sql = "SELECT * FROM register WHERE username='$username'";
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
    $sql = "INSERT INTO file (name,size,uploadeddate, uploadedby)
    VALUES ( '$file_name','$file_size','$date','$code')";
    mysqli_query($mysqli, $sql);
    }
?>
<html>
    <head>
        <title>Local Server</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body> 
        <div class="buttons">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" value="Upload Image" />
                <button name="logout">logout</button>
            </form>
        </div>
        <div class="sortby">
            <label>Sort By</label>
            <select>
                <option>None</option>
                <option>Last uploaded</option>
                <option>Size</option>
            </select>
        </div>
        <div class="searchbar">
            <input type="search" name="search" placeholder="Search by......">
        </div>
        <?php
        $mysqli = new mysqli("localhost","root","","localserver");
		$data = "SELECT * FROM file";
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
                <td><?php echo $row['uploadedby']?></td>
                <td> <a href="uploads/es.pdf" download>Download </a></td>
            </tr>
            <?php
        endwhile;
        ?>
        </table>
    </body>
</html>