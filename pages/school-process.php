<?php
require '../connection/dbconnect.php';
	 define("UPLOAD_DIR", "./images/");

 if(isset($_POST['submitUpdate'])){
 	$school_name = $_POST['school-name'];
 	$address = $_POST['address'];
     	//upload image
     	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
			
			header("location: school.php?msg=error");
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

		  
		$sql = "UPDATE tbl_school SET school_name='$school_name',address='$address',image_path='$name' WHERE id=1";

		if (mysqli_query($mysqli,$sql)) {
			
			header("location: school.php?msg=success");	

		} else {
			
		    header("location: school.php?msg=error");
		}
 	  }//end upload image
	} //end btn save
?>