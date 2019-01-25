<?php
	require '../connection/dbconnect.php';
$parentidl = $_POST['parentid'];
	if(isset($_POST['childid'])){
		//save or link child and parent to tbl_family
		$childidl = $_POST['childid'];
		

		$sql = "INSERT INTO tbl_family (parent_id,student_id)VALUES('$parentidl','$childidl')";
		if (mysqli_query($mysqli,$sql)) {
			
                                                      
		}else{
			echo "Something went wrong.";
		}
	}
	if(isset($_POST['action'])){
		
		$confirmfamilyIdl=$_POST['confirmfamilyId'];
		$sql = "UPDATE tbl_family set deleted=1 WHERE id='$confirmfamilyIdl'";
		if (mysqli_query($mysqli,$sql)) {
			
                                                      
		}else{
			echo "Something went wrong.";
		}

	}
	echo '<table width="100%" class="table table-striped table-bordered table-hover">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>ID</th>';
	echo '<th>Fname</th>';
	echo '<th>Mname</th>';
	echo '<th>Lastname</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '';

      $sql = "SELECT tbl_family.id fid,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname,tbl_student.class_section sclass FROM `tbl_family` INNER join tbl_student on tbl_family.student_id=tbl_student.id WHERE parent_id = '$parentidl' and tbl_family.deleted=0 ";
      $result = mysqli_query($mysqli,$sql);

      if (mysqli_num_rows($result) > 0) {                                     

          while($row = mysqli_fetch_assoc($result)) {
            echo '<tr data-toggle="modal" data-target="#confirmModal" onclick="javascript:showConfirmRemove(this);">';
            echo '<td>'.$row['fid'].'</td>';
            echo '<td>'.$row['sfname'].'</td>';
            echo '<td>'.$row['smname'].'</td>';
            echo '<td>'.$row['slname'].'</td>';
            echo '<td>'.$row['sclass'].'</td>';                                    
            echo '</tr>';
          }
        }
    echo '</tbody>';                  
    echo '</table>';
?>