<?php 
	require '../connection/dbconnect.php';	
	session_start(); // Starting Session

	$postId = $_POST['postId'];
	$login_user_id = $_SESSION['login_id'];

		 $sql = "SELECT id,user_id uid,user_type utype FROM tbl_comment WHERE post_id='$postId' GROUP BY user_id ORDER BY id DESC";
         $result = mysqli_query($mysqli,$sql);

        if (mysqli_num_rows($result) > 0) {                                     

            while($row = mysqli_fetch_assoc($result)) {
            	$user_id = $row['uid'];
            	$user_type = $row['utype'];
            	/*Student or else Parent and etc */
            	if($user_type == 'Student'){ //student table

            		$sql2 = "SELECT tbl_comment.id cid,tbl_comment.user_id cusid,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname,tbl_student.image_path simage,tbl_comment.comment ccoment,tbl_comment.date_created cdate FROM tbl_comment INNER JOIN tbl_student ON tbl_comment.user_id=tbl_student.id WHERE tbl_comment.user_id='$user_id' AND tbl_comment.post_id = '$postId' ORDER BY tbl_comment.id DESC";

            		  $result2 = mysqli_query($mysqli,$sql2);

            		   if (mysqli_num_rows($result2) > 0) {   

            		   		 while($row2 = mysqli_fetch_assoc($result2)) {
            		   		 	$comment_id = $row2['cid'];
            		   		 	$user_id = $row2['cusid'];
            		   		 	$fname = $row2['sfname'];
            		   		 	$mname = $row2['smname'];
            		   		 	$lname = $row2['slname'];
            		   		 	$image = $row2['simage'];
            		   		 	$comment = $row2['ccoment'];
            		   		 	$date = $row2['cdate'];
            		   		 	$name = $fname.' '.$mname.' '.$lname;
?>
								<div style="padding: 15px;">

								<div class="mycol-2 radio-inline">
									<img src="./images/<?php echo $image; ?>" class="avatar" />
								</div>
								<div class="mycol-3 radio-inline">
									<input type="hidden" id="innerPostId" value="<?php echo $postId; ?>">
									<input type="hidden" id="innerCommentId" value="<?php echo $comment_id; ?>">									
									<h4><?php echo $name; ?></h4>
									<label id="comment-text<?php echo $comment_id; ?>"><?php echo $comment; ?></label>
									<label><i class="comment-date"><?php echo $date; ?></i></label>
									<?php

									if($login_user_id == $user_id){
									?>

									<div class="align-right">
										<button class="comment-section-link" onclick="showEditComment(<?php echo $comment_id; ?>);">EDIT</button><button class="comment-section-link" onclick="showConfirmDelete(<?php echo $comment_id; ?>);">DELETE</button>
									</div>

									<?php	
									}

									?>
									
								</div>
							
								</div>
<?php
            		   		 	
            		   		 }

            		   }else{
            		   	echo "Something went wrong inside student query";
            		   }

            	}else{ //admin table

            		$sql2 = "SELECT tbl_comment.id cid,tbl_comment.user_id cusid,tbl_admin.firstname afname,tbl_admin.middlename amname,tbl_admin.lastname alname,tbl_admin.image_path aimage,tbl_comment.comment ccoment,tbl_comment.date_created cdate FROM tbl_comment INNER JOIN tbl_admin ON tbl_comment.user_id=tbl_admin.id WHERE tbl_comment.user_id='$user_id' AND tbl_comment.post_id = '$postId' ORDER BY tbl_comment.id DESC";

            		 $result2 = mysqli_query($mysqli,$sql2);

            		   if (mysqli_num_rows($result2) > 0) {   

            		   		 while($row2 = mysqli_fetch_assoc($result2)) {
            		   		 	$comment_id = $row2['cid'];
            		   		 	$user_id = $row2['cusid'];
            		   		 	$fname = $row2['afname'];
            		   		 	$mname = $row2['amname'];
            		   		 	$lname = $row2['alname'];
            		   		 	$image = $row2['aimage'];
            		   		 	$comment = $row2['ccoment'];
            		   		 	$date = $row2['cdate'];
            		   		 	$name = $fname.' '.$mname.' '.$lname;

?>
								<div style="padding: 15px;">

								<div class="mycol-2 radio-inline">
									<img src="./images/<?php echo $image; ?>" class="avatar" />
								</div>
								<div class="mycol-3 radio-inline">
									<input type="hidden" id="innerPostId" value="<?php echo $postId; ?>">
									<input type="hidden" id="innerCommentId" value="<?php echo $comment_id; ?>">									
									<h4><?php echo $name; ?></h4>
									<label id="comment-text<?php echo $comment_id; ?>"><?php echo $comment; ?></label>
									<label><i class="comment-date"><?php echo $date; ?></i></label>
									<?php

									if($login_user_id == $user_id){
									?>

									<div class="align-right">
										<button class="comment-section-link" onclick="showEditComment(<?php echo $comment_id; ?>);">EDIT</button><button class="comment-section-link" onclick="showConfirmDelete(<?php echo $comment_id; ?>);">DELETE</button>
									</div>

									<?php	
									}

									?>
									
								</div>
							
								</div>
<?php
            		   		 }

            		   }else{
            		   	echo "Something went wrong inside student query";
            		   }
            	}
            }
        }else{
        	echo '<div style="width:100%;text-align:center;"><span class="text-center"> No Comment Available.</span></div>';
        }

?>
