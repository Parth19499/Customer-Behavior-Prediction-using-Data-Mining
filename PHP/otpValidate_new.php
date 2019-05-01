<?php
	session_start();
	$db='smarthea_mp2';
	$otp=$_POST['otpVal'];
	$resend=$_POST['submit'];
	$temp="yo";
	$connection = new mysqli('localhost','root','',$db) or die("connection failed");
	if($resend != "resend")
	{
	$otpcheck="SELECT email from `".$_SESSION["uty"]."` WHERE otp_validate='".$otp."'";
	if($res=mysqli_query($connection,$otpcheck)){
			while ($row=mysqli_fetch_row($res)) {
				$temp=$row[0];
			}
			 mysqli_free_result($res);
	}
	if($temp == $_SESSION["YOEMAIL"]){
		$clsotp="UPDATE `".$_SESSION["uty"]."` set otp_validate='' WHERE email='".$_SESSION["YOEMAIL"]."'";
 		mysqli_query($connection,$clsotp);
    	print '<script type="text/javascript">location.href = "../resetPass.html";</script>';
	}
	else{
		print '<script type="text/javascript">';
		print 'alert("something went wrong")';
		print '</script>';
	}
	}
	else
	{
	    $randno=strval(rand(0,999999));
		$length=strlen($randno);
		if($length<6){
			while (strlen($randno)<6) {
				$randno="0"+$randno;
			}
		}
		$update="UPDATE userdetails set otp_validate='".$randno."' WHERE email='".$_SESSION["YOEMAIL"]."'";
		if(mysqli_query($connection,$update)){
			echo "rand no up success";
		}
		else{
			echo "something went wrong!!!";
		}
		$getidq="SELECT id from userdetails where email='".$_SESSION["YOEMAIL"]."'";
		$suc=mysqli_query($connection,$getidq);
		while($res=mysqli_fetch_array($suc)){
            $id=$res['id'];
        }
		$subject="OTP";
		$msg="Here is your otp: ".$randno;
		$header="From: no-reply@mantichost.com";
		mail($_SESSION["YOEMAIL"], $subject, $msg,$header);
		print '<script type="text/javascript">location.href = "../otpValidate.html";</script>';
	}
	$connection->close();
?>