<?php
	 require '../connection/dbconnect.php';

if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	$account_id = $_POST['account_id'];

	$sql = "UPDATE tbl_account SET username = '$username', password = '$password' WHERE id = '$account_id' ";
	if (mysqli_query($mysqli,$sql)) {
		
		header("location: accountSetting.php?msg=success");
	}else{
		header("location: accountSetting.php?msg=error");
	}

}
?>