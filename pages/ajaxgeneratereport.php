<?php
require '../connection/dbconnect.php';
	

	//echo $dateEmpty."<br/>".$fromDate."<br/>".$toDate."<br/>".$healthClass;
	//if(isset($dateEmpty['dateEmpty'])){

		$dateEmpty = $_POST['dateEmpty'];
		$fromDate = $_POST['fromDate'];
		$toDate = $_POST['toDate'];
		$healthClass = $_POST['healthClass'];

		echo '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">';
		echo '<thead>';
		echo ' <tr>';
		echo '<th>ID</th>';
		echo '<th>Date of Check</th>';
		echo '<th>First Name</th>';
		echo '<th>Middle Name</th>';
		echo ' <th>Last Name</th>';
		echo ' <th>Age</th>';
		echo  ' <th>Gender</th>';
		echo '<th>Section</th>';
		echo '<th>Classification</th>';
		echo '</tr>';
		echo ' </thead>';
		echo '<tbody>';
		          

		if($dateEmpty==0){

			if($healthClass == 'all'){
				 $sql = "SELECT tbl_health_profile.id hfid,tbl_health_profile.date_check_up hfdate,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname,tbl_student.age sage,tbl_student.gender sgender,tbl_section.section ssection,tbl_health_profile.classification hfclass FROM `tbl_health_profile` INNER JOIN tbl_student on tbl_health_profile.student_id=tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id";	                                
			}else{
				$sql = "SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up hfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_section.section ssection, tbl_health_profile.classification hfclass FROM  `tbl_health_profile` INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id WHERE tbl_health_profile.classification='$healthClass'";	
			}
			    $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) {	                                    

                    while($row = mysqli_fetch_assoc($result)) {
                    $gender="";
                    if($row['sgender']==1){
                      $gender="Male";
                    }else{
                      $gender="Female";
                    }
                    	  echo '<tr>';
                      	  echo '<td>'.$row['hfid'].'</td>';
                    	  echo '<td>'.$row['hfdate'].'</td>';
                    	  echo '<td>'.$row['sfname'].'</td>';
                    	  echo '<td>'.$row['smname'].'</td>';
                    	  echo '<td>'.$row['slname'].'</td>';
                    	  echo '<td>'.$row['sage'].'</td>';
                    	  echo '<td>'.$gender.'</td>';
                    	  echo '<td>'.$row['ssection'].'</td>';
                    	  echo '<td>'.$row['hfclass'].'</td>';	                                    	  
                    	  echo "</tr>";
                    }
                }
			  

		}else{

				if($healthClass == 'all'){
				 $sql = "SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up hfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_section.section ssection, tbl_health_profile.classification hfclass FROM  `tbl_health_profile` INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id WHERE tbl_health_profile.date_check_up BETWEEN '$fromDate' AND '$toDate'  ";	                                
			}else{
				 $sql = "SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up hfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_section.section ssection, tbl_health_profile.classification hfclass FROM  `tbl_health_profile` INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id WHERE tbl_health_profile.date_check_up BETWEEN '$fromDate' AND '$toDate' AND tbl_health_profile.classification='$healthClass'";
			}
			    $result = mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($result) > 0) {	                                    

                    while($row = mysqli_fetch_assoc($result)) {
                    $gender="";
                    if($row['sgender']==1){
                      $gender="Male";
                    }else{
                      $gender="Female";
                    }
                    	  echo '<tr>';
                      	  echo '<td>'.$row['hfid'].'</td>';
                    	  echo '<td>'.$row['hfdate'].'</td>';
                    	  echo '<td>'.$row['sfname'].'</td>';
                    	  echo '<td>'.$row['smname'].'</td>';
                    	  echo '<td>'.$row['slname'].'</td>';
                    	  echo '<td>'.$row['sage'].'</td>';
                    	  echo '<td>'.$gender.'</td>';
                    	  echo '<td>'.$row['ssection'].'</td>';
                    	  echo '<td>'.$row['hfclass'].'</td>';	                                    	  
                    	  echo "</tr>";
                    }
                }
			  

		}

		echo '</tbody>';
		echo '</table>';

		
	//}//end isset

?>