<?
$email = $_GET['email'];
$db='smarthea_mp2';
$connection = new mysqli('localhost','smarthea_Parth','Parth@19499',$db) or die("connection failed");
//ajax experimental profile pic logic starts
	    $ajaxQ="SELECT img_path FROM doctordetails WHERE email='".$email."'";
	    if(mysqli_query($connection,$ajaxQ)){
	        
	    }
	//ajax experimental profile pic logic starts
?>