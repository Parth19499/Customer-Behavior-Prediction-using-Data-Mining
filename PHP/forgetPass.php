<?php
/*session_start();
$db = 'smarthea_mp2';
$id= 'a';
$connection = new mysqli('localhost','smarthea_Parth','Parth@19499',$db) or die("connection failed");
$subemail=$_POST['subemail'];
$_SESSION["YOEMAIL"]=$subemail;
	$sql="select * from userdetails where email='".$subemail."'";
	$query=mysqli_query($connection,$sql);
	$result=mysqli_num_rows($query);
	echo "$result<br>";
	if($result == 0){
		print '<script type="text/javascript">';
		print 'alert("User does not exists.")';
		print '</script>';
		print '<script type="text/javascript">location.href = "signup.html";</script>';
	}
	else if(mysqli_query($connection,$sql) && $result==1){
		echo "user exists";
		print '<script type="text/javascript">showMe()</script>';
		$randno=strval(rand(0,999999));
		$length=strlen($randno);
		if($length<6){
			while (strlen($randno)<6) {
				$randno="0"+$randno;
			}
		}
		$update="UPDATE userdetails set otp_validate='".$randno."' WHERE email='".$subemail."'";
		if(mysqli_query($connection,$update)){
			echo "rand no up success";
		}
		else{
			echo "something went wrong!!!";
		}
		$getidq="SELECT id from userdetails where email='".$subemail."'";
		$suc=mysqli_query($connection,$getidq);
		while($res=mysqli_fetch_array($suc)){
            $id=$res['id'];
        }
		$subject="OTP";
		$msg="Here is your otp: ".$randno;
		$header="From: no-reply@mantichost.com";
		mail($subemail, $subject, $msg,$header);
		print '<script type="text/javascript">location.href = "../otpValidate.html";</script>';
		//echo 'prompt("Enter otp")';
// 			$val="SELECT * FROM userdetails WHERE otp_validate='".$otpR."'";
// 			$resu=mysqli_num_rows(mysqli_query($connection,$val));
// 			if($resu == 1){
// 			    echo "otp matched";
// 			    $clsotp="UPDATE userdetails set otp_validate='' WHERE email='".$subemail."'";
//     			mysqli_query($connection,$clsotp);
//     			print '<script type="text/javascript">location.href = "resetPass.html?id='.$id.'";</script>';
// 			}
// 			else{
// 			    echo "something went wrong";
// 			}
			
	}
	$connection->close();*/
	//Experimental Logic!!!
session_start();
$db = 'smarthea_mp2';
$Tname="userdetails";
$connection = new mysqli('localhost','smarthea_Parth','Parth@19499',$db) or die("connection failed");
$subemail=$_POST['subemail'];
$_SESSION["YOEMAIL"]=$subemail;
// echo $_SESSION["YOEMAIL"];
// echo ".<br>";
// echo $_SESSION["Utype"];
// echo "<br>";
// switch ($_SESSION["Utype"]) {
// 	case 'user':
// 		$Tname="userdetails";
// 		break;
// 	case 'patient':
// 		$Tname="patientdetails";
// 	default:
// 		$Tname="doctordetails";
// 		break;
// }
    function Utype(){
        $connection = new mysqli('localhost','smarthea_Parth','Parth@19499','smarthea_mp2') or die("connection failed");
        $finddb="select * from userdetails where email='".$GLOBALS['subemail']."'";
    	$query=mysqli_query($connection,$finddb);
    	if(mysqli_query($connection,$finddb)){
    	    echo "sccess";
    	}
    	else{
    	    echo "error";
    	}
    	$result=mysqli_num_rows($query);
		if(mysqli_query($connection,$finddb) && $result==1){
		    $Tname="userdetails";
		    return $Tname;
		}
		else{
		    $finddb="select * from patientdetails where email='".$GLOBALS['subemail']."'";
            $query=mysqli_query($connection,$finddb);
    		$result=mysqli_num_rows($query);
    		if(mysqli_query($connection,$finddb) && $result==1){
		        $Tname="patientdetails";
		        return $Tname;
		    }
		    else{
		        $finddb="select * from doctordetails where email='".$GLOBALS['subemail']."'";
                $query=mysqli_query($connection,$finddb);
        		$result=mysqli_num_rows($query);
        		if(mysqli_query($connection,$finddb) && $result==1){
    		        $Tname="doctordetails";
    		        return $Tname;
    		    }
    		    else{
    		        echo "User does not exists.<br>";
    		        return 0;
    		    }
		    }
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
	    $connection = new mysqli('localhost','smarthea_Parth','Parth@19499','smarthea_mp2') or die("connection failed");
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
	    $connection = new mysqli('localhost','smarthea_Parth','Parth@19499','smarthea_mp2') or die("connection failed");
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
// 	$sql="select * from userdetails where email='".$subemail."'";
// 	$query=mysqli_query($connection,$sql);
// 	$result=mysqli_num_rows($query);
// 	if($result == 0){
// 		print '<script type="text/javascript">';
// 		print 'alert("User does not exists.")';
// 		print '</script>';
// 		print '<script type="text/javascript">location.href = "signup.html";</script>';
// 	}
// 	else if(mysqli_query($connection,$sql) && $result==1){
// 		echo "user exists";
// 		print '<script type="text/javascript">showMe()</script>';
// 		$randno=strval(rand(0,999999));
// 		$length=strlen($randno);
// 		if($length<6){
// 			while (strlen($randno)<6) {
// 				$randno="0"+$randno;
// 			}
// 		}
// 		$update="UPDATE userdetails set otp_validate='".$randno."' WHERE email='".$subemail."'";
// 		if(mysqli_query($connection,$update)){
// 			echo "rand no up success";
// 		}
// 		else{
// 			echo "something went wrong!!!";
// 		}
// 		$getidq="SELECT id from userdetails where email='".$subemail."'";
// 		$suc=mysqli_query($connection,$getidq);
// 		while($res=mysqli_fetch_array($suc)){
//             $id=$res['id'];
//         }
// 		$subject="OTP";
// 		$msg="Here is your otp: ".$randno;
// 		$header="From: no-reply@mantichost.com";
// 		mail($subemail, $subject, $msg,$header);
// 		print '<script type="text/javascript">location.href = "otpValidate.html";</script>';
// 		//echo 'prompt("Enter otp")';
// // 			$val="SELECT * FROM userdetails WHERE otp_validate='".$otpR."'";
// // 			$resu=mysqli_num_rows(mysqli_query($connection,$val));
// // 			if($resu == 1){
// // 			    echo "otp matched";
// // 			    $clsotp="UPDATE userdetails set otp_validate='' WHERE email='".$subemail."'";
// //     			mysqli_query($connection,$clsotp);
// //     			print '<script type="text/javascript">location.href = "resetPass.html?id='.$id.'";</script>';
// // 			}
// // 			else{
// // 			    echo "something went wrong";
// // 			}
			
// 	}
	$connection->close();
?>