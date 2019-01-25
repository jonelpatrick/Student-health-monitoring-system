<?php
	require '../connection/dbconnect.php';
	 define("UPLOAD_DIR", "./images/");
	 session_start();

    if(isset($_POST['submitPost'])){

    	$title = $_POST['postTitle'];
    	$description = $_POST['postText'];
		$image_path = 'noimage.png';
    	$date_created = date("Y-m-d");
    	$user_id = $_SESSION['login_id'];

    	$title = mysqli_real_escape_string($mysqli,$title);
    	$description = mysqli_real_escape_string($mysqli,$description);

     	if(getimagesize($_FILES['image']['tmp_name'])==FALSE){ //if no image 

			$sql = "INSERT INTO tbl_post (date_created,title,description,image_path,user_id) VALUES('$date_created','$title','$description','$image_path','$user_id')";

			if (mysqli_query($mysqli,$sql)) {
				//remove header so that it will read until end
							  
			} else {
				
			    header("location: post-page.php?msg=error");
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

		  	$sql = "INSERT INTO tbl_post (date_created,title,description,image_path,user_id) VALUES('$date_created','$title','$description','$name','$user_id')";


			if (mysqli_query($mysqli,$sql)) {				
				//remove header so that it will read until end		

			} else {
				exit();
			    header("location: post-page.php?msg=error");
			}

		}
	//if latest post create notification
	$sql_latest_post = "SELECT max(id) FROM tbl_post";
    $rs =  mysqli_query($mysqli,$sql_latest_post);

     $result2 = mysqli_fetch_array($rs);
     $latest_post = $result2[0];
     
     //select all user student available
    $sql_student = "SELECT id FROM tbl_student WHERE deleted=0";
    $result_student = mysqli_query($mysqli,$sql_student);

        if (mysqli_num_rows($result_student) > 0) {                                     

            while($row_student = mysqli_fetch_assoc($result_student)){
            	$student_id = $row_student['id'];
            	$user_type = "Student";
            	$sql_notification = "INSERT INTO tbl_notification (post_id,user_id,user_type,posted_by) VALUES ('$latest_post','$student_id','$user_type','$user_id')";
            	if (mysqli_query($mysqli,$sql_notification)) {				
				//remove header so that it will read until end		

				} else {
					echo "Error";
					exit();
				    
				}
            }
        }else{ echo "Something went wrong"; exit;}

     //select all user admin,parent,cssdo,dswd available
    $sql_admin = "SELECT id,privilege FROM tbl_admin WHERE deleted=0";
    $result_admin = mysqli_query($mysqli,$sql_admin);

        if (mysqli_num_rows($result_admin) > 0) {                                     

            while($row_admin = mysqli_fetch_assoc($result_admin)){
            	$admin_id = $row_admin['id'];
            	$user_type2 = $row_admin['privilege'];

            	$sql_notification2 = "INSERT INTO tbl_notification (post_id,user_id,user_type,posted_by) VALUES ('$latest_post','$admin_id','$user_type2','$user_id')";
            	if (mysqli_query($mysqli,$sql_notification2)) {				
				//remove header so that it will read until end		

				} else {
					echo "Error";
					exit();
				    
				}
            }
        }else{ echo "Something went wrong"; exit;}

     header("location: post-page.php?msg=success");

	}else if(isset($_POST['submitPostUpdate'])){

		$id = $_POST['postId'];
		$title = $_POST['posttitle'];
		$description = $_POST['postText'];

		$title = mysql_real_escape_string($title);
    	$description = mysql_real_escape_string($description);

		if(getimagesize($_FILES['image']['tmp_name'])==FALSE){ //if no image 


			$sql = "UPDATE tbl_post SET title='$title',description='$description' WHERE id = '$id'";

			if (mysqli_query($mysqli,$sql)) {				
				
			   // echo "New record created successfully";
				header("location: post-page.php?msg=success");	

			} else {
				
			    header("location: post-page.php?msg=error");
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

		  $sql = "UPDATE tbl_post SET title='$title',description='$description',image_path='$name' WHERE id = '$id'";

			if (mysqli_query($mysqli,$sql)) {				
				
			   // echo "New record created successfully";
				header("location: post-page.php?msg=success");	

			} else {
				
			    header("location: post-page.php?msg=error");
			}

		}


	}else if(isset($_POST['submitPostDelete'])){
		$id = $_POST['postId'];

		$sql = "DELETE FROM tbl_post WHERE id = '$id'";

		if (mysqli_query($mysqli,$sql)) {				
			
		   // echo "New record created successfully";
			header("location: post-page.php?msg=success");	

		} else {
			
		    header("location: post-page.php?msg=error");
		}		

	}


?>