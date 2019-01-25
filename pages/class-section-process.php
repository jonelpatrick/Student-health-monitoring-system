<?php
require '../connection/dbconnect.php';


if(isset($_POST['submitSave'])){

	$section = $_POST['section'];

	$sql = "INSERT INTO tbl_section (section) VALUES ('$section')";

	if (mysqli_query($mysqli,$sql)) {
		
		   // echo "New record created successfully";
			header("location: class-section.php?msg=success");	

	} else {
		
	    header("location: class-section.php?msg=error");
	}

}

if(isset($_POST['submitUpdate'])){

	$id = $_POST['sectionId'];
	$section = $_POST['section'];

	$sql = "UPDATE tbl_section SET section='$section' WHERE id = '$id'";

	if (mysqli_query($mysqli,$sql)) {
		
		   // echo "New record created successfully";
			header("location: class-section.php?msg=success");	

	} else {
		
	    header("location: class-section.php?msg=error");
	}

}


if(!empty($_GET['action'])){

	$id = $_GET['id'];

	$sql = "DELETE FROM tbl_section Where id='$id'";
	
	if (mysqli_query($mysqli,$sql)) {
		
		   // echo "New record created successfully";
			header("location: class-section.php?msg=success");	

	} else {
		
	    header("location: class-section.php?msg=error");
	}

}else{
	echo "id is empty";
}
?>