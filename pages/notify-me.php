<?php 
require '../connection/dbconnect.php';
session_start();

$id = $_POST['id'];

$sql = "UPDATE tbl_notification SET status = 1 WHERE id = '$id'";

if (mysqli_query($mysqli,$sql)) {

} else {
	echo "Error";
	exit();
    
}

?>
 <?php
 $login_id = $_SESSION['login_id'];
$login_type = $_SESSION['privilege'];

$sql_count_notif = "SELECT COUNT(*) FROM tbl_notification WHERE user_id = '$login_id' AND status=0 AND user_type='$login_type' AND posted_by != '$login_id'";
$rs_notif =  mysqli_query($mysqli,$sql_count_notif);

 $result_notif = mysqli_fetch_array($rs_notif);
 $number_of_notif = $result_notif[0];

if($number_of_notif > 0){
    echo '<span class="notif-number">'.$number_of_notif.'</span>';
}

?>   

             