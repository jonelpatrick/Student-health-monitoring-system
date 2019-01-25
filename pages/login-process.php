
<?php
	 require '../connection/dbconnect.php';
	
session_start(); // Starting Session

$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
		header("location: login.php?msg=error");
	}
	else
	{
		// Define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];
			$log_as =$_POST['privilege'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter

		// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($mysqli,$username);
			$password = mysqli_real_escape_string($mysqli,$password);



		// SQL query to fetch information of registerd users and finds user match.
			if($log_as=='CSSDO' || $log_as=='DSWD' || $log_as=='Administrator' || $log_as=='Parent'){
			$query = mysqli_query($mysqli,"SELECT tbl_admin.id aid,password,privilege,firstname,image_path aimage from tbl_admin inner join tbl_account on tbl_admin.account_id=tbl_account.id where username='$username' AND tbl_account.deleted=0");

				if (mysqli_num_rows($query) > 0) {
					$dbpassword= "";
					$dbprivilege= "";
					$dbfirstname= "";
					$login_id = "";
					 while($rows = mysqli_fetch_assoc($query)) {
					 	$dbpassword = $rows['password'];
					 	$dbprivilege= $rows['privilege'];
					 	$dbfirstname= $rows['firstname'];	
					 	$login_id = $rows['aid'];
					 	$image = $rows['aimage'];

					 }	
					 if($dbprivilege == $log_as){
					 	if($dbpassword == $password){
						 	$_SESSION['privilege']=$log_as; 
						 	$_SESSION['login_user']=$username; 
						 	$_SESSION['firstname']=$dbfirstname; 
						 	$_SESSION['login_id'] = $login_id;
						 	$_SESSION['image'] = $image;

						 	if($log_as == 'Student'){
						 		header("location: dashboard.php");		
						 	}else{
						 		header("location: dashboard.php");	
						 	}
						 	
						 }else{
						 	header("location: login.php?msg=error".$dbprivilege);
						 }
					 }else{
					 	header("location: login.php?msg=error");
					 }
					
						
				}else{
					 header("location: login.php?msg=error");
				}
				
			}else{
				$query = mysqli_query($mysqli,"SELECT tbl_student.id sid,password,firstname,image_path aimage from tbl_student inner join tbl_account on tbl_student.account_id=tbl_account.id where username='$username'  AND tbl_account.deleted=0");

				if (mysqli_num_rows($query) > 0) {
					$dbpassword= "";
					$dbfirstname = "";
					$login_id = "";
					 while($rows = mysqli_fetch_assoc($query)) {
					 	$dbpassword = $rows['password'];
					 	$dbfirstname= $rows['firstname'];
					 	$login_id = $rows['sid'];
					 	$image = $rows['aimage'];
					 }	
					 
					 if($dbpassword == $password){	
					 	$_SESSION['privilege']=$log_as; 				 	
					 	$_SESSION['login_user']=$username; 
					 	$_SESSION['firstname']=$dbfirstname; 
					 	$_SESSION['login_id'] = $login_id;
					 	$_SESSION['image'] = $image;
					 	
					 	if($log_as == 'Student'){
					 		header("location: dashboard.php");		
					 	}else{
					 		header("location: dashboard.php");	
					 	}
					 	
					 }else{
					 	header("location: login.php?msg=error");
					 }
						
				}else{
					 header("location: login.php?msg=error");
				}
			}				
			
	}
}

?>