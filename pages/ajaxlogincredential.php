<?php

	require '../connection/dbconnect.php';

$accountid = $_POST['accountid'];

if(isset($accountid)){

	$sql = "SELECT * FROM tbl_account WHERE id='$accountid'";
	$username="";
	$password="";
    $result = mysqli_query($mysqli,$sql);

    if (mysqli_num_rows($result) > 0) {                                     

        while($row = mysqli_fetch_assoc($result)) {
        	$username = $row['username'];
        	$password = $row['password'];
        }
       
        
        echo ' LOGIN CREDENTIAL : <br><br/>';
         echo '<div class="form-group">'; 
         echo '<input  type="text" class="form-control" id="username" name="username" placeholder="Username" required value="'.$username.'">';
         echo '</div>';
         echo '<div class="form-group">';
         echo '<input  type="text" class="form-control" id="password" name="password" placeholder="Password" required value="'.$password.'">';
         echo '</div>';      
    }
}


?>