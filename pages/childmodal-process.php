<?php
	require '../connection/dbconnect.php';

	if(isset($_GET['id'])){

		$student_id = $_GET['id'];
		$sql = "SELECT tbl_student.id sid,firstname,middlename,lastname,age,birthday,citizenship,religion,address,tbl_section.section ssection,account_id,image_path,gender FROM tbl_student INNER JOIN tbl_section on tbl_student.class_section_id=tbl_section.id WHERE tbl_student.id = '$student_id'";
	  	$result = mysqli_query($mysqli,$sql);

	  	 if (mysqli_num_rows($result) > 0) {                                     

	      while($row = mysqli_fetch_assoc($result)) {

	      	$student_id = $row['sid'];
	      	$firstname = $row['firstname'];
	      	$middlename = $row['middlename'];
	      	$lastname = $row['lastname'];
	      	
	      	$age = $row['age'];
	      	$birthday = $row['birthday'];
	      	$citizenship = $row['citizenship'];
	      	$religion = $row['religion'];
	      	$address = $row['address'];
	      	$class_section = $row['ssection'];
	      	$account_id = $row['account_id'];
	      	$image_path = $row['image_path'];

	      	$name = $firstname. ' '.$middlename.' '.$lastname;
	      	 if($row['gender']==1){
	          $gender="Male";
	        }else{
	          $gender="Female";
	        }
	      }
	  	}
?>
	  	<div class="panel-body">
       		<div class="col-lg-6" style="border: 1px solid rgba(0,0,0,0.5); border-radius:4px;">
       			<img src="./images/<?php echo $image_path; ?>" style = "width: 100%;">
       		</div>
       		<div class="col-lg-6" style="padding-left: 5%;">
       				<div class="form-group">
           				<h3 ><?php echo $name; ?></h1>	
           			</div>

           			<div class="form-group">
           				<span>Gender :<b> <?php echo $gender; ?></b></span>
           			</div>
           			<div class="form-group">
           				<span>Age :<b> <?php echo $age; ?></b></span>
           			</div>
           			<div class="form-group">
           				<span>Birthday :<b> <?php echo $birthday; ?></b></span>
           			</div>
           			<div class="form-group">
           				<span>Citizenship :<b> <?php echo $citizenship; ?></b></span>
           			</div>
           			<div class="form-group">
           				<span>Religion :<b> <?php echo $religion; ?></b></span>
           			</div>
       			
       			
       				<div class="form-group">
           				<span>Class Section :<b> <?php echo $class_section; ?></b></span>
           			</div>
           		
           			<div class="form-group">
           				<span>Address :<b> <?php echo $address; ?></b></span>
           			</div>
           				
       		</div>
	    </div>

	         <div class="col-lg-12">
            	 <div class="panel panel-default">
            	 <div class="panel-heading">
	           	 <h2 class="page-header" style="color: #5bb75b;"> <i class="fa fa-medkit" ></i> Health History</h2>	 
	           	 </div>
	           	 <div class="panel-body">
	           	 	 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	           	 	 	 <thead>
	           	 	 	 	<th>ID</th>
	           	 	 	 	<th>Date of check up</th>
	           	 	 	 	<th>Weight</th>
	           	 	 	 	<th>Height</th>
	           	 	 	 	<th>BMI</th>
	           	 	 	 	<th>Classify as</th>
	           	 	 	 </thead>
	           	 	 	 <tbody>
	           	 	 	 <?php 
	           	 	 	 	$sql = "SELECT * FROM tbl_health_profile WHERE student_id = '$student_id' ";
						  	$result = mysqli_query($mysqli,$sql);
						  	 if (mysqli_num_rows($result) > 0) {                                     

							      while($row = mysqli_fetch_assoc($result)) {
							      	echo '<tr>';
							      	echo '<td>'.$row['id'].'</td>';
							      	echo '<td>'.$row['date_check_up'].'</td>';
							      	echo '<td>'.$row['weight'].'</td>';
							      	echo '<td>'.$row['height'].'</td>';
							      	echo '<td>'.$row['bmi'].'</td>';
							      	echo '<td>'.$row['classification'].'</td>';
							      	echo '</tr>';
							      }
							  }
	           	 	 	 ?>
	           	 	 	 </tbody>

	           	 	 </table>    
	           	 	 </div>      	 
	           </div>   
            </div>
            
	         <?php

	}
?>