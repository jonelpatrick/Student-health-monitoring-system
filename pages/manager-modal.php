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

	<div class="col-lg-6">
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
	<div class="col-lg-6">
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

    
  
 
</script>