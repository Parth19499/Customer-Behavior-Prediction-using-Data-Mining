<?php
session_start();
    $db='smarthea_mp2';
    $id=$_POST['id'];
//$myPDO = new PDO('mysql:host=localhost;dbname=smathea_mp2', 'smathea_Parth', 'Parth@19499');
$connection = new mysqli('localhost','root','',$db) or die("connection failed");
$npass=$_POST['npass'];
$ncpass=$_POST['ncpass'];
echo $_SESSION["YOEMAIL"];
echo "<br>";
if($npass != $ncpass){
    print '<script type="text/javascript">';
    print 'alert("Password does not match!!!")';
    print '</script>';
    print '<script type="text/javascript">location.href = "../resetPass.html";</script>';
}
else {
    $hashed_npass=md5($npass);
    $update="UPDATE `".$_SESSION["uty"]."` SET password='".$hashed_npass."' WHERE email='".$_SESSION["YOEMAIL"]."'";
    $result=mysqli_query($connection,$update);
    if(mysqli_query($connection,$update)){
        echo "Done";
    }
    else {
        echo "Something went wrong";
        
    }
}
session_destroy();
?>