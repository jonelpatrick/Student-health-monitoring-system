<?php
	require '../connection/dbconnect.php';
	 define("UPLOAD_DIR", "./images/");
	
	$firstname=$_POST['firstname'];
	$middlename=$_POST['middlename'];
	$lastname=$_POST['lastname'];
	$age=$_POST['age'];
	$gender=$_POST['optionsRadioGender'];
	$birthday=$_POST['birthday'];
	$citizenship=$_POST['citizenship'];
	$religion=$_POST['religion'];
	$address=$_POST['address'];
	$occupation=$_POST['occupation'];
	$privilege='DSWD';
	$account_id=0;
	$image_path='noimage.png';


	$username=$_POST['username'];
	$password=$_POST['password'];

	/*get the account Id*/
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
			
			header("location: administrator.php?msg=error");
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

		  
		$sql2 = "INSERT INTO `tbl_admin`(`firstname`, `middlename`, `lastname`, `age`, `gender`, `birthday`, `citizenship`, `religion`, `address`, `occupation`, `privilege`, `account_id`, `image_path`) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$birthday','$citizenship','$religion','$address','$occupation','$privilege','$account_id','$name')";

		if (mysqli_query($mysqli,$sql2)) {
			$sqlaccount="INSERT INTO tbl_account (id,username,password) VALUES ('$account_id','$username','$password')";
			if (!mysqli_query($mysqli,$sqlaccount)) {
				header("location: administrator.php?msg=error");
			}
		   // echo "New record created successfully";
			header("location: administrator.php?msg=success");	

		} else {
			
		    header("location: administrator.php?msg=error");
		}
 	  }//end upload image

	}
	else if(isset($_POST['submitUpdate'])){

		$id=$_POST['selectedId'];
		$account_id = $_POST['account-id'];

		//upload image
     	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){ //if no image     		
			$sqlupdate = "UPDATE tbl_admin SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',birthday='$birthday',citizenship='$citizenship',religion='$religion',address='$address',occupation='$occupation',privilege='$privilege' WHERE id='$id'";

			if (mysqli_query($mysqli,$sqlupdate)) {
				$sqlaccount="UPDATE tbl_account SET username='$username',password='$password' WHERE id='$account_id'";

				if (!mysqli_query($mysqli,$sqlaccount)) {
					header("location: administrator.php?msg=error");
				}
			   // echo "New record created successfully";
				header("location: administrator.php?msg=success");	

			} else {
				
			    header("location: administrator.php?msg=error");
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

		  
			$sqlupdate = "UPDATE tbl_admin SET firstname='$firstname',middlename='$middlename',lastname='$lastname',age='$age',gender='$gender',birthday='$birthday',citizenship='$citizenship',religion='$religion',address='$address',occupation='$occupation',privilege='$privilege',image_path='$name' WHERE id='$id'";

			if (mysqli_query($mysqli,$sqlupdate)) {
				$sqlaccount="UPDATE tbl_account SET username='$username',password='$password' WHERE id='$account_id'";

				if (!mysqli_query($mysqli,$sqlaccount)) {
					header("location: administrator.php?msg=error");
				}
			   // echo "New record created successfully";
				header("location: administrator.php?msg=success");	

			} else {
				
			    header("location: administrator.php?msg=error");
			}
 	  }//end upload image
	}
	else if(isset($_POST['submitDelete'])){
		$id=$_POST['selectedId'];
		$account_id = $_POST['account-id'];
		$sqlupdate = "UPDATE tbl_admin SET deleted=1 WHERE id='$id'";

		if (mysqli_query($mysqli,$sqlupdate)) {
			$sqlaccount="UPDATE tbl_account SET deleted=1 WHERE id='$account_id'";
			
			if (!mysqli_query($mysqli,$sqlaccount)) {
				header("location: administrator.php?msg=error");
			}
		   // echo "New record created successfully";
			header("location: administrator.php?msg=success");	

		} else {
			
		    header("location: administrator.php?msg=error");
		}

	}
	
	else{
		echo "Something went wrong.";
	}
?>