<?php 
	require '../connection/dbconnect.php';	
	session_start(); // Starting Session

	$mode = $_POST['mode'];

	if(isset($mode)){
		if($mode == "insert"){
		$postId = $_POST['postId'];
		$comment = $_POST['xcomment'];
		$userId = $_SESSION['login_id'];
		$userType = $_SESSION['privilege'];
		$date_created = date("Y-m-d");


		$sql = "INSERT INTO tbl_comment (post_id,user_id,date_created,comment,user_type) VALUES ('$postId','$userId','$date_created','$comment','$userType')";

			if (mysqli_query($mysqli,$sql)) {					  

			} else {
				echo "Something went wrong";
			    exit();
			}

		}else if($mode == "edit"){

		}else if($mode == 'delete'){

		}
	}else if(isset($_POST['submitDelete'])){

		$id = $_POST['commentId'];

		$sql = "DELETE FROM tbl_comment WHERE id='$id'";
		if (mysqli_query($mysqli,$sql)) {					  
			 header("location: dashboard.php?msg=success");
		} else {
			echo "Something went wrong";
		    exit();
		}

	}else if(isset($_POST['submitEdit'])){

		$id = $_POST['commentId'];
		$comment = $_POST['comment-edit-modal'];

		$sql = "UPDATE tbl_comment SET comment='$comment' WHERE id='$id'";

		if (mysqli_query($mysqli,$sql)) {					  
			 header("location: dashboard.php?msg=success");
		} else {
			echo "Something went wrong";
		    exit();
		}		
	}
	
	
?>
 <!-- comment section -->
<?php
$sqlcount = "SELECT COUNT(*) FROM tbl_comment WHERE post_id = '$postId'";
$rs =  mysqli_query($mysqli,$sqlcount);

 $result2 = mysqli_fetch_array($rs);
 $noOfComment = $result2[0];
 
?>
<div class="col-sm-12">
    <div class="panel panel-default" style="background: #f5f5f5;">
        <div id="commentSection<?php echo $postId; ?>">
        <button onclick="showAllComment(<?php echo $postId; ?>);" class="comment-section-btn">view all comment  <i class="fa fa-comments"> <?php echo $noOfComment; ?></i></button><br/>
            <div id="commentInner<?php echo $postId; ?>">
                
            </div>
        </div>      
    </div>                                              
</div>
<!-- comment section -->
