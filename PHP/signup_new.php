<?php
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$dob = htmlentities($_POST['dob']);
	$hashed_pass = md5($pass);
	$items = $_POST['items'];
	$db = 'smarthea_mp2';
	$connection = new mysqli('localhost','root','',$db) or die("connection failed");
    $sql="INSERT INTO userdetails VALUES ('".$name."','".$email."','".$hashed_pass."','".$dob."','','".$items."')";
    if(mysqli_query($connection,$sql)){
	    echo "success!!!";
	    print '<script type="text/javascript">';
	    print 'alert("'.$items.'")';
	    print '</script>';
	    print '<script type="text/javascript">location.href = "../login.html";</script>';
    }
    else{
	    echo "user already exists!!!";
    }
	$connection->close();
?>