<?php

//Experimental Logic!!!
session_start();
$db = 'smarthea_mp2';
$Tname="userdetails";
$connection = new mysqli('localhost','root','',$db) or die("connection failed");
$subemail=$_POST['subemail'];
$_SESSION["YOEMAIL"]=$subemail;
    function Utype(){
        $connection = new mysqli('remotemysql.com','1ZMOoaSYsb','iHv3osBp46',$db) or die("connection failed");
        $finddb="select * from userdetails where email='".$GLOBALS['subemail']."'";
    	$query=mysqli_query($connection,$finddb);
    	if(mysqli_query($connection,$finddb)){
    	    echo "success";
    	}
    	else{
    	    echo "error";
    	}
    	$result=mysqli_num_rows($query);
		if(mysqli_query($connection,$finddb) && $result==1){
		    $Tname="userdetails";
		    return $Tname;
		}
    }
	function forgetPass($Tname){
			if(Uexists($Tname) == 1){
				$randno=otpGen();
				if(otpUpdation($Tname,$randno) == 1){
					sendEmail($randno);
				}
			}
			echo "massive Success";
	}
	function Uexists($Tname){
	    $connection = new mysqli('remotemysql.com','1ZMOoaSYsb','iHv3osBp46',$db) or die("connection failed");
		$sql="select * from `".$Tname."` where email='".$GLOBALS['subemail']."'";
		$query=mysqli_query($connection,$sql);
		$result=mysqli_num_rows($query);
		if($result == 0){
		    echo "Uexists does not Success.<br>";
			return 0;
		}
		else if(mysqli_query($connection,$sql) && $result==1){
			return 1;
		}
	}

	function otpGen(){
		$randn=strval(rand(0,999999));
		$length=strlen($randn);
		if($length<6){
			while (strlen($randno)<6) {
				$randn="0"+$randn;
			}
		}
		echo "otpGen Success.<br>";
		return $randn;
	}
	function otpUpdation($Tname,$randno){
	    $connection = new mysqli('remotemysql.com','1ZMOoaSYsb','iHv3osBp46',$db) or die("connection failed");
		$update="UPDATE `".$Tname."` set otp_validate='".$randno."' WHERE email='".$GLOBALS['subemail']."'";
		if(mysqli_query($connection,$update)){
			echo "otpUpdation Success.<br>";
			return 1;
		}
		else{
			return 0;
		}
	}
	function sendEmail($randno){
	    echo "in mail.<br>";
		$subject="OTP";
		$msg="Here is your otp: ".$randno;
		$header="From: no-reply@mantichost.com";
		mail($GLOBALS['subemail'], $subject, $msg,$header);
		print '<script type="text/javascript">location.href = "../otpValidate.html";</script>';
	}
	$Tname=Utype();
	$_SESSION["uty"]=$Tname;
	echo "$Tname.<br>";
	forgetPass($Tname);

	$connection->close();
?>