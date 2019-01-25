<?php
	require '../connection/dbconnect.php';
	 define("UPLOAD_DIR", "./images/");

	$firstname =$_POST['firstname'];
	$middlename=$_POST['middlename'];
	$lastname=$_POST['lastname'];
	$optionsRadioGender=$_POST['optionsRadioGender'];
	$age=$_POST['age'];
	$birthday=$_POST['birthday'];
	$citizenship=$_POST['citizenship'];
	$religion=$_POST['religion'];
	$classsection=$_POST['classsection'];
	$address=$_POST['address'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$image_path='noimage.png';
	$weightl = $_POST['student_weight'];
	$heightl = $_POST['student_height'];

	$account_id=0;

		
	$sql = "SELECT max(id) mid FROM tbl_account";
    $result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {	                                    

        while($row = mysqli_fetch_assoc($result)) {
        	$max = $row['mid'];
        	$account_id = $max + 1;
        }
    }

     if(isset($_POST['submitSave'])){
     	//upload image
     	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
			
			header("location: student.php?msg=error");
		}else{			
				$myFile = $_FILES["image"];

		    if ($myFile["error"] !== UPLOAD_ERR_OK) {
		        echo "<p>An error occurred.</p>";
		        exit;
		    }

		    // ensure a safe filename
		    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

		    // don't overwrite an existing file
		    $i = 0;
		    $parts = pathinfo($name);
		    while (file_exists(UPLOAD_DIR . $name)) {
		        $i++;
		        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		    }

		    // preserve file from temporary directory
		    $success = move_uploaded_file($myFile["tmp_name"],
		        UPLOAD_DIR . $name);
		    if (!$success) { 
		        echo "<p>Unable to save file.</p>";
		     //   exit;
		    }

		    // set proper permissions on the new file
		    chmod(UPLOAD_DIR . $name, 0644);

           $primary_image="";

		  
		$sql2 = "INSERT INTO `tbl_student`(`firstname`, `middlename`, `lastname`,gender, `age`,`birthday`, `citizenship`, `religion`, `address`, class_section_id, account_id, `image_path`,student_height,student_weight) VALUES ('$firstname','$middlename','$lastname','$optionsRadioGender','$age','$birthday','$citizenship','$religion','$address','$classsection','$account_id','$name','$heightl','$weightl')";

		if (mysqli_query($mysqli,$sql2)) {
			$sqlaccount="INSERT INTO tbl_account (id,username,password) VALUES ('$account_id','$username','$password')";
			if (!mysqli_query($mysqli,$sqlaccount)) {
				header("location: student.php?msg=error");
			}
		   // echo "New record created successfully";
			header("location: student.php?msg=success");	

		} else {
			
		    header("location: student.php?msg=error");
		}
 	  }//end upload image
	} //end btn save
	else if(isset($_POST['submitUpdate'])){
		$id=$_POST['student-id'];
		$account_id = $_POST['account-id'];

		//upload image
     	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){ //if no image     

			$sqlupdate = "UPDATE tbl_student SET firstname='$firstname',middlename='$middlename',lastname='$lastname',gender='$gender',age='$age',birthday='$birthday',citizenship='$citizenship',religion='$religion',address='$address',class_section_id='$classsection',student_height='$heightl',student_weight='$weightl'  WHERE id='$id'";

			if (mysqli_query($mysqli,$sqlupdate)) {
				$sqlaccount="UPDATE tbl_account SET username='$username',password='$password' WHERE id='$account_id'";

				if (!mysqli_query($mysqli,$sqlaccount)) {
					header("location: student.php?msg=error");
				}
			   // echo "New record created successfully";
				header("location: student.php?msg=success");	

			} else {
				
			    header("location: student.php?msg=error");
			}
		}else{		// if there is image	
				$myFile = $_FILES["image"];

		    if ($myFile["error"] !== UPLOAD_ERR_OK) {
		        echo "<p>An error occurred.</p>";
		        exit;
		    }

		    // ensure a safe filename
		    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

		    // don't overwrite an existing file
		    $i = 0;
		    $parts = pathinfo($name);
		    while (file_exists(UPLOAD_DIR . $name)) {
		        $i++;
		        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		    }

		    // preserve file from temporary directory
		    $success = move_uploaded_file($myFile["tmp_name"],
		        UPLOAD_DIR . $name);
		    if (!$success) { 
		        echo "<p>Unable to save file.</p>";
		     //   exit;
		    }

		    // set proper permissions on the new file
		    chmod(UPLOAD_DIR . $name, 0644);

           $primary_image="";

		  
			$sqlupdate = "UPDATE tbl_student SET firstname='$firstname',middlename='$middlename',lastname='$lastname',gender='$gender',age='$age',birthday='$birthday',citizenship='$citizenship',religion='$religion',address='$address',class_section='$classsection',image_path='$name',student_height='$heightl',student_weight='$weightl'  WHERE id='$id'";

			if (mysqli_query($mysqli,$sqlupdate)) {
				$sqlaccount="UPDATE tbl_account SET username='$username',password='$password' WHERE id='$account_id'";

				if (!mysqli_query($mysqli,$sqlaccount)) {
					header("location: student.php?msg=error");
				}
			   // echo "New record created successfully";
				header("location: student.php?msg=success");	

			} else {
				
			    header("location: student.php?msg=error");
			}
 	  }//end upload image

	}
	else if(isset($_POST['submitDelete'])){
		$id=$_POST['student-id'];
		$account_id = $_POST['account-id'];

		$sqlupdate = "UPDATE tbl_student SET deleted=1 WHERE id='$id'";

		if (mysqli_query($mysqli,$sqlupdate)) {
			$sqlaccount="UPDATE tbl_account SET deleted=1 WHERE id='$account_id'";
			
			if (!mysqli_query($mysqli,$sqlaccount)) {
				header("location: student.php?msg=error");
			}
		   // echo "New record created successfully";
			header("location: student.php?msg=success");	

		} else {
			
		    header("location: student.php?msg=error");
		}

	}
	
	else{
		echo "Something went wrong.";
	}

?>