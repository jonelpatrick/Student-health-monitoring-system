<?php
require '../connection/dbconnect.php';

if(!empty($_GET['id'])){

	$selectedId = $_GET['id'];

	 $username ="";
	 $password = "";
	 $account_id ="";

	 $sql_admin = "SELECT * FROM tbl_admin WHERE id='$selectedId' AND deleted=0";

    $result_admin = mysqli_query($mysqli,$sql_admin);

    if (mysqli_num_rows($result_admin) > 0) {     

        while($row = mysqli_fetch_assoc($result_admin)) {

            $firstname = $row['firstname'];
            $middlename = $row['middlename'];
            $lastname = $row['lastname'];
            $gender = $row['gender'];
            $age = $row['age'];
            $birthday = $row['birthday'];
            $citizenship = $row['citizenship'];
            $religion = $row['religion'];
            $address = $row['address'];
            $occupation = $row['occupation'];
            $privilege = $row['privilege'];
            $account_id = $row['account_id'];
            $image_path = $row['image_path'];            
                        
        }
    }

    $sql_account = "SELECT * FROM tbl_account WHERE id = '$account_id'";
	$result_account = mysqli_query($mysqli,$sql_account);

    if (mysqli_num_rows($result_account) > 0) {   

    	  while($row2 = mysqli_fetch_assoc($result_account)) {
    	  	$id = $row2['id'];
    	  	$username = $row2['username'];
    	  	$password = $row2['password'];
    	  }
    }  
}
?>
<div class="col-lg-12">
  
     <input type="hidden" name="selectedId"  value="<?php echo $selectedId; ?>"> 
     <input type="hidden" name="account-id" value="<?php echo $account_id; ?>"> 

	<div class="col-lg-3">
	     <div class="img-box">
          <img src="./images/<?php echo $image_path; ?>" style="text-align: center;border:1px solid #333;">
             <input type="file" name="image"  /> 
        </div>
        <br/>
         <div class="form-group">                                   
	            <input value="<?php echo $firstname; ?>" type="text" class="form-control" name="firstname" placeholder="First Name" required>                                       
	       </div>
	       <div class="form-group">                                   
	        <input  type="text" value="<?php echo $middlename; ?>" class="form-control" name="middlename" placeholder="Middle Name" required>                                       
	       </div>
	      <div class="form-group">                                   
	        <input  type="text" value="<?php echo $lastname; ?>" class="form-control" name="lastname" placeholder="Last Name" required>                                       
	     </div>
	      <div class="form-group" >
            <label  style="margin-bottom: 1em;">Gender : &nbsp;<br/></label>
            <label class="radio-inline" style="margin-bottom: 1em;">
            <?php 
            	$radioMale ='';
            	$radioFemale = '';
             if($gender == 1){
		          	$radioMale = 'checked';
		          	$radioFemale = '';
	          
		        }else if($gender == 0){
		      
		      		$radioMale = '';
	          		$radioFemale = 'checked';
		        }    
            ?>
                <input type="radio" name="optionsRadioGender"  value="1" <?php echo $radioMale; ?> >Male
            </label>
            <label class="radio-inline" style="margin-bottom: 1em;">
                <input type="radio" name="optionsRadioGender" value="0" <?php echo $radioFemale; ?> >Female
            </label>
                
          </div>
            <div id="logincredential2">                
                LOGIN CREDENTIAL : <br><br/>                              
              
                <div class="form-group">                                   
                   <input  type="text" class="form-control"  name="username" placeholder="Username" value="<?php echo $username; ?>" required>                                       
                  </div>
                 <div class="form-group">                                   
                 <input  type="text" class="form-control"  name="password" placeholder="Password" value="<?php echo $password; ?>" required>                                       
                </div>
              </div>

	</div>
	<div class="col-lg-3">
		 <div class="form-group">
            <input  type="text" value="<?php echo $age; ?>" class="form-control" name="age" placeholder="Age" required>
          </div>
           <div class="form-group" style="width: 90%;">   
             <div id="datetimepicker5" class="input-append date">  

             <input  type="text" value="<?php echo $birthday; ?>"  class="form-control" name="birthday" placeholder="Birthday" required>  
             <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
              </span>
             </div>                                   
            </div>

         
            <div class="form-group">                                   
                <input  type="text" value="<?php echo $citizenship; ?>" class="form-control" name="citizenship" placeholder="Citizenship" required>                                       
            </div>
             <div class="form-group">                                   
                <input  type="text" value="<?php echo $religion; ?>" class="form-control" name="religion" placeholder="Religion" required>                                       
            </div>
             <div class="form-group">

             	<input  type="text" value="<?php echo $occupation; ?>" class="form-control" name="occupation" placeholder="occupation" required>
             </div>
             <div class="form-group">
                <label>Address</label>
                <textarea name="address"  class="form-control" rows="7"><?php echo $address; ?></textarea>
             </div>

	</div>
	
	<div class="col-lg-6" >

	<p style="text-align: center;"><i>List of Child linked</i></p>
		<div id="childlist" >
		  <table width="50%" class="table table-striped table-bordered table-hover">
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
              $sql = "SELECT tbl_family.id fid,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname FROM `tbl_family` INNER join tbl_student on tbl_family.student_id=tbl_student.id WHERE parent_id = '$selectedId'";
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
          </div>
	
	
	<p style="text-align: center;"><i>List of Pupil</i></p>
		<input type="hidden" id="selectedParent" value="<?php echo $selectedId; ?>">
	          <table width="50%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fname</th>
                        <th>Mname</th>
                        <th>Lastname</th>
                        <th>Class Section</th>
                     </tr>  
                </thead>
                <tbody>
                 <?php
                  $sql = "SELECT tbl_student.id id,firstname,middlename,lastname,tbl_section.section section FROM tbl_student inner join tbl_section on tbl_student.class_section_id = tbl_section.id where tbl_student.deleted=0 ORDER BY tbl_student.id desc";
                  $result = mysqli_query($mysqli,$sql);

                  if (mysqli_num_rows($result) > 0) {                                     

                      while($row = mysqli_fetch_assoc($result)) {
                        echo '<tr onclick="javascript:addStudentToParent(this);">';
                        echo '<td>'.$row['id'].'</td>';
                        echo '<td>'.$row['firstname'].'</td>';
                        echo '<td>'.$row['middlename'].'</td>';
                        echo '<td>'.$row['lastname'].'</td>';
                        echo '<td>'.$row['section'].'</td>';                                                        
                        echo '</tr>';
                      }
                    }
                  ?>
                </tbody>
              </table>
	</div>

</div>

      <!--date time picker -->
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
    <!-- Date time picker -->

    <script>	
    $(document).ready(function() {
    
            $('#datetimepicker5').datetimepicker({
            format: 'yyyy-MM-dd',
            language: 'en'
        });
          // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    
    });

    
    function addStudentToParent(row){
	  
	  	var x=row.cells;
	  	var parent = document.getElementById('selectedParent').value;
	  	var type = "add";

	  	var pupil = x[0].innerHTML;
	      $.ajax({
	      type: 'post',
	      url: 'childlist-table.php',
	      data: {	       
	       pupil:pupil,
	       parent:parent,
	       type:type,
	      },
	      success: function (response) {
	       // We get the element having id of display_info and put the response inside it
	       $( '#childlist' ).html(response);
	      }
	      });
	      
	}
   function removeChildFromParent(row){

    	
    	var x=row.cells;

	  	var parent = document.getElementById('selectedParent').value;
	  	var type = "remove";
	  	var pupil = x[0].innerHTML; //family ID

	      $.ajax({
	      type: 'post',
	      url: 'childlist-table.php',
	      data: {	       
	       pupil:pupil,
	       parent:parent,
	       type:type,
	      },
	      success: function (response) {
	       // We get the element having id of display_info and put the response inside it
	       $( '#childlist' ).html(response);
	      }
	      });
    }

 
</script>