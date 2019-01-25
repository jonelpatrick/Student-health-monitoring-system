<?php
	require '../connection/dbconnect.php';
	 define("UPLOAD_DIR", "./images/");
	 session_start();

    if(isset($_POST['submitReminder'])){

    	$remindertext = $_POST['remindertext'];
		$image_path = 'noimage.png';
    	$date_created = date("Y-m-d");
    	$user_id = $_SESSION['login_id'];

    	$remindertext = mysql_real_escape_string($remindertext);
    	

     	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){ //if no image 

			$sql = "INSERT INTO tbl_reminder (date_created,reminder,image_path,user_id) VALUES('$date_created','$remindertext','$image_path','$user_id')";

			if (mysqli_query($mysqli,$sql)) {				
				
			   // echo "New record created successfully";
				header("location: reminder.php?msg=success");	

			} else {
				
			    header("location: reminder.php?msg=error");
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

		  	$sql = "INSERT INTO tbl_reminder (date_created,reminder,image_path,user_id) VALUES('$date_created','$remindertext','$name','$user_id')";

			if (mysqli_query($mysqli,$sql)) {				
				
			   // echo "New record created successfully";
				header("location: reminder.php?msg=success");	


			} else {
				
			    header("location: reminder.php?msg=error");
			}

		}
	}else if(isset($_POST['submitReminderUpdate'])){

		$id = $_POST['reminderId'];
		$reminder = $_POST['reminderText'];
		$reminder = mysql_real_escape_string($reminder);

		if(getimagesize($_FILES['image']['tmp_name'])==FALSE){ //if no image 


			$sql = "UPDATE tbl_reminder SET reminder='$reminder' WHERE id = '$id'";

			if (mysqli_query($mysqli,$sql)) {				
				
			   // echo "New record created successfully";
				header("location: reminder.php?msg=success");	

			} else {
				
			    header("location: reminder.php?msg=error");
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

		  	$sql = "UPDATE tbl_reminder SET reminder='$reminder',image_path='$name' WHERE id = $id";

			if (mysqli_query($mysqli,$sql)) {				
				
			   // echo "New record created successfully";
				header("location: reminder.php?msg=success");	

			} else {
				
			    header("location: reminder.php?msg=error");
			}

		}


	}else if(isset($_POST['submitReminderDelete'])){
		$id = $_POST['reminderId'];

		$sql = "DELETE FROM tbl_reminder WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {				
			
		   // echo "New record created successfully";
			header("location: reminder.php?msg=success");	

		} else {
			
		    header("location: reminder.php?msg=error");
		}		

	}
?>