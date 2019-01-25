<?php
	require '../connection/dbconnect.php';

	
	$firstname=$_POST['firstname'];
	$middlename=$_POST['middlename'];
	$lastname=$_POST['lastname'];
	$age=$_POST['age'];
	$gender=$_POST['optionsRadiosInline'];
	$birthday=$_POST['birthday'];
	$citizenship=$_POST['citizenship'];
	$religion=$_POST['religion'];
	$address=$_POST['address'];
	$occupation=$_POST['occupation'];
	$privilege='Manager';
	$account_id=0;
	$image_path='noimage.png';

	/*get the account Id*/
	$sql = "SELECT max(id) mid FROM tbl_admin";
    $result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {	                                    

        while($row = mysqli_fetch_assoc($result)) {
        	$max = $row['mid'];
        	$account_id = $max;
        }
    }

    if(isset($_POST['submitSave'])){

		$sql2 = "INSERT INTO `tbl_admin`(`firstname`, `middlename`, `lastname`, `age`, `gender`, `birthday`, `citizenship`, `religion`, `address`, `occupation`, `privilege`, `account_id`, `image_path`) VALUES ('$firstname','$middlename','$lastname','$age','$gender','$birthday','$citizenship','$religion','$address','$occupation','$privilege','$account_id','$image_path')";

		if (mysqli_query($mysqli,$sql)) {
					
		   // echo "New record created successfully";
			header("location: manager.php?msg=success");	

		} else {
			
		    header("location: manager.php?msg=error");
		}

	}
	else if(isset($_POST['submitUpdate'])){

	}
	else if(isset($_POST['submitDelete'])){

	}
	else{
		echo "Something went wrong.";
	}
?>