<?php
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$name=$_POST['name'];
	$dob=htmlentities($_POST['dob']);
	$hashed_pass = md5($pass);
	$ru=$_POST['ru'];
	$disease=$_POST['disease'];
	$db = 'smarthea_mp2';
	$connection = new mysqli('localhost','smarthea_Parth','Parth@19499',$db) or die("connection failed");
	if($ru == "user"){
	    $sql="INSERT INTO userdetails VALUES ('".$name."','".$email."','".$hashed_pass."','".$dob."','')";
	    if(mysqli_query($connection,$sql)){
		    echo "success!!!";
		    print '<script type="text/javascript">';
		    print 'alert("The data is inserted!!!")';
		    print '</script>';
		    print '<script type="text/javascript">location.href = "../index.html";</script>';
	    }
	    else{
		    echo "user already exists!!!";
	    }
	}
	else if($ru == "patient"){
	    $sql="INSERT INTO patientdetails VALUES('".$name."','".$email."','".$hashed_pass."','".$disease."','')";
	    if(mysqli_query($connection,$sql)){
	        echo "success!!!";
		    print '<script type="text/javascript">';
		    print 'alert("The data is inserted!!!")';
		    print '</script>';
		    print '<script type="text/javascript">location.href = "../index.html";</script>';
	    }
	    else{
	        echo "patient already exists!!!";
	    }
	}
	else if($ru == "doctor"){
	    //Starting of yo
	    if(isset($_POST['btn_upload'])){
                $filetmp = $_FILES["file_img"]["tmp_name"];
                $filename = $_FILES["file_img"]["name"];
                $filetype = $_FILES["file_img"]["type"];
                $filepath = "../images/dq/".$filename;
                if(move_uploaded_file($filetmp,$filepath)){
                    echo "img up success!!!<br>";
                }
                else{
                    echo "Error";
                }
                //$sql = "INSERT INTO doctordetails VALUES ('$filename','$filepath','$filetype')";
                //$result = mysqli_query($connection,$sql);
                $sql="INSERT INTO doctordetails VALUES('".$name."','".$email."','".$hashed_pass."','".$filename."','".$filepath."','".$filetype."','')";
    	        if(mysqli_query($connection,$sql)){
        	        echo "success!!!";
        		    print '<script type="text/javascript">';
        		    print 'alert("The data is inserted!!!")';
        		    print '</script>';
        		    print '<script type="text/javascript">location.href = "../index.html";</script>';
    	        }
    	        else{
    	            echo "doctor already exists!!!";
    	        }
        }
	    //Ending of yo
	}
	$connection->close();
?>