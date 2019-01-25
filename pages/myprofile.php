<?php
  include '../template/header.php';

  $user_id = $_SESSION['login_id'];
  $privilege = $_SESSION['privilege'];
  
  if($privilege == "Student"){
  
  	$sql = "SELECT * FROM tbl_student WHERE id = '$user_id' AND deleted=0;";
  	$result = mysqli_query($mysqli,$sql);
  	 if (mysqli_num_rows($result) > 0) {                                     

      while($row = mysqli_fetch_assoc($result)) {

      	$student_id = $row['id'];
      	$firstname = $row['firstname'];
      	$middlename = $row['middlename'];
      	$lastname = $row['lastname'];
      	
      	$age = $row['age'];
      	$birthday = $row['birthday'];
      	$citizenship = $row['citizenship'];
      	$religion = $row['religion'];
      	$address = $row['address'];
      	$class_section = $row['class_section'];
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
  }else{

  	$sql = "SELECT * FROM tbl_admin WHERE id = '$user_id' AND deleted=0;";
  	$result = mysqli_query($mysqli,$sql);
  	 if (mysqli_num_rows($result) > 0) {                                     

      while($row = mysqli_fetch_assoc($result)) {

      	$student_id = $row['id'];
      	$firstname = $row['firstname'];
      	$middlename = $row['middlename'];
      	$lastname = $row['lastname'];      	
      	$age = $row['age'];
      	$birthday = $row['birthday'];
      	$citizenship = $row['citizenship'];
      	$religion = $row['religion'];
      	$address = $row['address'];
      	$occupation = $row['occupation'];
      	$privilege = $row['privilege'];
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
  	$class_section = $occupation;
  }
?>
 <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
	    	   <div class="panel panel-default">
	           	 <h1 class="page-header"> <i class="fa fa-slideshare"></i> My Profile</h1>	           	 
	           </div>
	           <div class="panel-body">
	           		<div class="col-lg-3" style="border: 1px solid rgba(0,0,0,0.5); border-radius:4px;">
	           			<img src="./images/<?php echo $image_path; ?>" style = "width: 100%;">
	           		</div>
	           		<div class="col-lg-9" style="padding-left: 5%;">
	           				<div class="form-group">
		           				<h1 style="font-size: 50px;"><?php echo $name; ?></h1>	
		           			</div>
		           			<hr/>
	           			<div class="col-lg-6">
		           			
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
	           			</div>
	           			<?php if($privilege == "Student"){ ?>
	           				<div class="form-group">
		           				<span>Class Section :<b> <?php echo $class_section; ?></b></span>
		           			</div>
		           		<?php }else{ ?>
		           			<div class="form-group">
		           				<span>Occupation :<b> <?php echo $class_section; ?></b></span>
		           			</div>
		           		<?php } ?>
		           			<div class="form-group">
		           				<span>Address :<b> <?php echo $address; ?></b></span>
		           			</div>
		           				
	           		</div>
	           </div>
            </div>
<?php if($privilege == "Student"){ ?>
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
<?php }else if ($privilege == "Parent"){ ?>
		  <div class="col-lg-12">
            	 <div class="panel panel-default">
            	 <div class="panel-heading">
	           	 <h2 class="page-header" style="color: #5bb75b;"> <i class="fa fa-medkit" ></i> Parent Child</h2>	 
	           	 </div>
	           	 <div class="panel-body">
	           	 	 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	           	 	 	 <thead>
	           	 	 	 	<th>ID</th>
	           	 	 	 	<th>Firstname</th>
	           	 	 	 	<th>Middlename</th>
	           	 	 	 	<th>Lastname</th>
	           	 	 	 	<th>Gender</th>
	           	 	 	 	<th>Class Section</th>
	           	 	 	 </thead>
	           	 	 	 <tbody>
	           	 	 	 <?php 
	           	 	 	 	
	           	 	 	 	$sql = "SELECT student_id,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname,gender,tbl_section.section FROM tbl_family INNER JOIN tbl_student on tbl_family.student_id = tbl_student.id INNER JOIN tbl_section on tbl_student.class_section_id=tbl_section.id WHERE parent_id = '$user_id'";
	           	 	 	 	
						  	$result = mysqli_query($mysqli,$sql);
						  	 if (mysqli_num_rows($result) > 0) {                                     

							      while($row = mysqli_fetch_assoc($result)) {

							      	echo '<tr onclick="showChildModal('.$row['student_id'].')">';
							      	echo '<td>'.$row['student_id'].'</td>';
							      	echo '<td>'.$row['sfname'].'</td>';
							      	echo '<td>'.$row['smname'].'</td>';
							      	echo '<td>'.$row['slname'].'</td>';
							      	echo '<td>'.$row['gender'].'</td>';
							      	echo '<td>'.$row['class_section'].'</td>';
							      	echo '</tr>';

							      }
							  }
	           	 	 	 ?>
	           	 	 	 </tbody>

	           	 	 </table>    
	           	 	 </div>      	 
	           </div>   
            </div>
<?php } ?>
        </div>

          <div class="modal fade" id="childModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelChild" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabelChild">Child Personal & Health Detail <span id="liquidationDate" style="color:orange;"></span></h4>                                                
                    </div>               
                    <div class="modal-body child-modal-body">

                         
                    </div><!--modal body -->
                    <div class="modal-footer">  
                        
                         <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>                         
                                                                                        
                    </div>
                   

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- modal -->
 </div>
<script type="text/javascript">

	function showChildModal(studentId){
		 
		 $('.child-modal-body').load('childmodal-process.php?id=' + studentId,function(){
             
           $('#childModal').modal({show:true});                  

        });
	}
	
	
</script>
<?php
  include '../template/footer.php';
?>