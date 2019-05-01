<?php
$email=$_POST['email'];
$pass=md5($_POST['pass']);
$db='smarthea_mp2';
//$myPDO = new PDO('mysql:host=localhost;dbname=smathea_mp2', 'smathea_Parth', 'Parth@19499');
$connection = new mysqli('localhost','smarthea_Parth','Parth@19499',$db) or die("connection failed");
// $con = mysql_connect('localhost','smarthea_Parth','Parth@19499');
// $dba=mysql_select_db('smarthea_mp2',$con);
// if (!$con) {
//     die('Could not connect: ' . mysql_error());
// }
// if (!mysql_select_db('smarthea_mp2')) {
//     die('Could not select database: ' . mysql_error());
// }
    $sql="select * from userdetails where email='".$email."'";
	$query=mysqli_query($connection,$sql);
	$result=mysqli_num_rows($query);
	$passwo="asdf";
	if($result == 0){
		print '<script type="text/javascript">';
		print 'alert("User does not exists, Please Signup")';
		print '</script>';
		print '<script type="text/javascript">location.href = "../signup.html";</script>';
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
			print '<script type="text/javascript">location.href = "../index.html";</script>';
		}
		else{
		    session_start();
		    $_SESSION["validate_session"]=$email;
			print '<script type="text/javascript">location.href = "../../Main/index.php";</script>';
            print '<script type="text/javascript">alert("Login Successful");</script>';
		}
	}
	
// 	function getdbvalue() {
//       global $pdo;
//       $args = func_get_args();
//       $sql  = array_shift($args);
//       $stm  = $pdo->prepare($sql);
//       $stm->execute($args);
//       return $stm->fetchColumn();
// }
?>