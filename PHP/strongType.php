<?php
$email = $_GET['email'];
$db='smarthea_mp2';
$connection = new mysqli('localhost','smarthea_Parth','Parth@19499',$db) or die("connection failed");
$query="SELECT email FROM strongDB WHERE email='".$email."'";
// if($run=mysqli_query($connection,$query)){
// 	while($rows=mysqli_fetch_rows($run)){
// 		$check=$rows[0];
// 	}
// 	 mysqli_free_result($run);
// }
$run=mysqli_query($connection,$query);
$result=mysqli_num_rows($run);
if($result==1){
	echo"$email.<br>";
}
else{
	echo "fail";
}
$connection->close();
?>