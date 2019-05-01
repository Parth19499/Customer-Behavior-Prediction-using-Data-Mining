<?php
$email=$_POST['email'];
$pass=md5($_POST['pass']);
$db='smarthea_mp2';
$connection = new mysqli('localhost','root','',$db) or die("connection failed");
    $sql="select * from userdetails where email='".$email."'";
	$query=mysqli_query($connection,$sql);
	$result=mysqli_num_rows($query);
	$passwo="asdf";
	if($result == 0){
		print '<script type="text/javascript">';
		print 'alert("User does not exists, Please Signup")';
		print '</script>';
		print '<script type="text/javascript">location.href = "../signup_new.html";</script>';
	}
	else{
	    $mquery="SELECT password from userdetails WHERE email='".$email."'";
		$password=mysqli_query($connection,$mquery);
		//$password = $connection->query($mquery);
		//$passwo = getdbvalue("SELECT password FROM userdetails WHERE email='".$email."'", $is);
        // $res=mysql_query($mquery);
        // $password=mysql_fetch_array($res,MYSQL_BOTH);
        while($res=mysqli_fetch_array($password)){
            $passwo=$res['password'];
        }
		if($pass!=$passwo){
			print '<script type="text/javascript">';
			print 'alert("Invalid Credentials")';
			print '</script>';
			print '<script type="text/javascript">location.href = "../login.html";</script>';
		}
		else{
		    session_start();
		    $_SESSION["validate_session"]=$email;
			print '<script type="text/javascript">location.href = "../home.php";</script>';
            echo $_SESSION["validate_session"];
		}
	}
?>