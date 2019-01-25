<?php
	require '../connection/dbconnect.php';

	$type = $_POST['type'];
	$parent = $_POST['parent'];
	$pupil = $_POST['pupil'];

	if($type == "remove"){
		//family id = pupil
		$sql_remove = "DELETE FROM tbl_family WHERE id = $pupil";

		if (mysqli_query($mysqli,$sql_remove)) {

		}else{
			echo "Something went wrong";
		}

	}else if($type == "add"){

		$sql_insert ="INSERT into tbl_family (parent_id,student_id) VALUES ('$parent','$pupil')";
		if (mysqli_query($mysqli,$sql_insert)) {

		}else{
			echo "Something went wrong";
		}
	}
	
?>

 <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fname</th>
            <th>Mname</th>
            <th>Lastname</th>
            
         </tr>  
    </thead>
    <tbody>
     <?php
      $sql = "SELECT tbl_family.id fid,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname FROM `tbl_family` INNER join tbl_student on tbl_family.student_id=tbl_student.id WHERE parent_id = '$parent'";
      $result = mysqli_query($mysqli,$sql);

      if (mysqli_num_rows($result) > 0) {                                     

          while($row = mysqli_fetch_assoc($result)) {
              echo '<tr onclick="javascript:removeChildFromParent(this);">';
            echo '<td>'.$row['fid'].'</td>';
            echo '<td>'.$row['sfname'].'</td>';
            echo '<td>'.$row['smname'].'</td>';
            echo '<td>'.$row['slname'].'</td>';
                                           
            echo '</tr>';
          }
        }
      ?>
    </tbody>
  </table>